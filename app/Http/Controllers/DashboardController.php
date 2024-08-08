<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Department;
use App\Models\Document;
use App\Models\Employee;
use App\Models\Faculty;
use App\Models\PD_Committee;
use App\Models\PDC_Archive;
use App\Models\Plan;
use App\Models\Scholarship;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Lab;
use App\Models\LabTools;
use App\Models\PostGraduatedPrograms;
use App\Models\Student;
use App\Models\InternationalPublishment;
use App\Models\ReasearchLab;
use App\Models\LabEquipment;
use App\Models\ResearchProject;
use Mpdf\Tag\Main;

class DashboardController extends Controller
{



    // pdc
    public function PDCDashboard(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $masters = Scholarship::selectRaw('YEAR(sent_date) as year, edu_maqta ,COUNT(*) as count')
            ->where('edu_maqta', '=', 'ماستری')
            ->whereBetween(DB::raw('YEAR(created_at)'), ['2020', '2028'])
            ->groupBy('year', 'edu_maqta')
            ->get();
        $doctors = Scholarship::selectRaw('YEAR(sent_date) as year, edu_maqta ,COUNT(*) as count')
            ->where('edu_maqta', '=', 'دوکتورا')
            ->whereBetween(DB::raw('YEAR(created_at)'), ['2020', '2028'])
            ->groupBy('year', 'edu_maqta')
            ->get();
        $data = array(
            'masters' => $masters,
            'doctors' => $doctors
        );

        return response()->json($data);
    }

    public function countPDCWholeData()
    {
        $data = [];
        $currentUser = Auth::user();
        $total_teacher = Scholarship::all()->count();
        $total_file = PDC_Archive::all()->count();
        $total_commits = PD_Committee::all()->count();
        $total_employees = Employee::where('user_id', $currentUser->id)->count();
        if ($currentUser->user_type == 'fifth_department') {
            $totalSendDocs = Document::where('type', 'صادره')->where('dep_id', $currentUser->dep_id)->get()->count();
            $totalRecDocs = Document::where('type', 'وارده')->where('dep_id', $currentUser->dep_id)->get()->count();
        } else if ($currentUser->user_type == 'faculty_user') {
            $totalSendDocs = Document::where('type', 'صادره')->where('faculty_id', $currentUser->faculty_id)->get()->count();
            $totalRecDocs = Document::where('type', 'وارده')->where('faculty_id', $currentUser->faculty_id)->get()->count();
        } else if ($currentUser->user_type == 'department_user') {
            $totalSendDocs = Document::where('type', 'صادره')->where('department_user', $currentUser->department_id)->get()->count();
            $totalRecDocs = Document::where('type', 'وارده')->where('department_user', $currentUser->department_id)->get()->count();
        }

        $data = array(
            'total_teacher' => $total_teacher,
            'total_file' => $total_file,
            'total_committee' => $total_commits,
            'total_send_docs' => $totalSendDocs,
            'total_rec_docs' => $totalRecDocs,
            'total_employees' => $total_employees,
        );
        return $data;
    }

    public function tableView()
    {
        $year = request('year', date('Y') - 621);
        $plans_now_year = Plan::selectRaw('YEAR(date) as year, subject, document_path')
            ->where(DB::raw('YEAR(date)'), '=', $year)
            ->get();
        $commit = PD_Committee::whereYear('date', $year)
            ->where(DB::raw('YEAR(date)'), '=', $year)
            ->leftJoin('p_d_c_teacher_in_commitees', 'p_d__committees.id', '=', 'p_d_c_teacher_in_commitees.commit_id')
            ->select('p_d__committees.name', 'p_d__committees.date', 'p_d__committees.attachment_path', DB::raw('count(p_d_c_teacher_in_commitees.id) as members_count'))
            ->groupBy('p_d__committees.id', 'p_d__committees.name', 'p_d__committees.date', 'p_d__committees.attachment_path')
            ->get();

        return ['new_plan' => $plans_now_year, 'committee' => $commit];
    }
    // teacher department
    public function getTotalData()
    {
        $total_send_docs = '';
        $total_rec_docs = '';
        $currentUser = Auth::user();
        $faculty = Faculty::get()->count();
        $departments = Department::get()->count();
        $total_teachers = Teacher::get()->count();
        $total_male_teacher = Teacher::where('gender', 'مرد')->get()->count();
        $total_female_teacher = Teacher::where('gender', 'زن')->get()->count();
        $total_master_teacher = Teacher::where('education_degree', 'ماستر')->get()->count();
        $total_doctor_teacher = Teacher::where('education_degree', 'داکتر')->get()->count();
        $total_bachelor_teacher = Teacher::where('education_degree', 'لیسانس')->get()->count();
        $total_employees = Employee::where('user_id', $currentUser->user_id)->get()->count();
        if ($currentUser->user_type == 'fifth_department') {
            $total_send_docs = Document::where('dep_id', $currentUser->dep_id)->where('type', 'صادره')->get()->count();
            $total_rec_docs = Document::where('dep_id', $currentUser->dep_id)->where('type', 'وارده')->get()->count();
        }

        return [
            'faculty' => $faculty,
            'departments' => $departments,
            'total_teachers' => $total_teachers,
            'total_male_teacher' => $total_male_teacher,
            'total_female_teacher' => $total_female_teacher,
            'total_master_teacher' => $total_master_teacher,
            'total_doctor_teacher' => $total_doctor_teacher,
            'total_bachelor_teacher' => $total_bachelor_teacher,
            'total_employees' => $total_employees,
            'total_send_docs' => $total_send_docs,
            'total_rec_docs' => $total_rec_docs,
        ];
    }



    // post graduated


    // post graduated
    public function getPostTotalData()
    {
        $total_send_docs = '';
        $total_rec_docs = '';
        $currentUser = Auth::user();
        $total_lab = Lab::get()->count();
        $total_equipments = LabTools::get()->count();
        $total_programs = PostGraduatedPrograms::get()->count();
        $total_students = Student::get()->count();
        $total_graduated_students = Student::where('status', '2')->get()->count();
        $total_current_students = Student::where('status', '1')->get()->count();
        $total_teachers = Teacher::get()->count();
        $total_male_teacher = Teacher::where('gender', 'مرد')->get()->count();
        $total_female_teacher = Teacher::where('gender', 'زن')->get()->count();
        $total_master_teacher = Teacher::where('education_degree', 'ماستر')->get()->count();
        $total_doctor_teacher = Teacher::where('education_degree', 'داکتر')->get()->count();
        $total_bachelor_teacher = Teacher::where('education_degree', 'لیسانس')->get()->count();
        $total_employees = Employee::where('user_id', $currentUser->user_id)->get()->count();
        if ($currentUser->user_type == 'fifth_department') {
            $total_send_docs = Document::where('dep_id', $currentUser->dep_id)->where('type', 'صادره')->get()->count();
            $total_rec_docs = Document::where('dep_id', $currentUser->dep_id)->where('type', 'وارده')->get()->count();
        }

        return [
            'total_lab' => $total_lab,
            'total_equipments' => $total_equipments,
            'total_programs' => $total_programs,
            'total_students' => $total_students,
            'total_graduated_students' => $total_graduated_students,
            'total_current_students' => $total_current_students,
            'total_teachers' => $total_teachers,
            'total_male_teacher' => $total_male_teacher,
            'total_female_teacher' => $total_female_teacher,
            'total_master_teacher' => $total_master_teacher,
            'total_doctor_teacher' => $total_doctor_teacher,
            'total_bachelor_teacher' => $total_bachelor_teacher,
            'total_employees' => $total_employees,
            'total_send_docs' => $total_send_docs,
            'total_rec_docs' => $total_rec_docs,
        ];
    }


    // research department



    // research department
    public function getResearchTotalData()
    {
        $total_send_docs = '';
        $total_rec_docs = '';
        $currentUser = Auth::user();
        $total_publishments = InternationalPublishment::get()->count();
        $total_lab = ReasearchLab::get()->count();
        $total_research_project = ResearchProject::get()->count();
        $total_employees = Employee::where('user_id', $currentUser->user_id)->get()->count();
        if ($currentUser->user_type == 'fifth_department') {
            $total_send_docs = Document::where('dep_id', $currentUser->dep_id)->where('type', 'صادره')->get()->count();
            $total_rec_docs = Document::where('dep_id', $currentUser->dep_id)->where('type', 'وارده')->get()->count();
        }

        return [
            'total_lab' => $total_lab,
            'total_publishments' => $total_publishments,
            'total_research_project' => $total_research_project,
            'total_employees' => $total_employees,
            'total_send_docs' => $total_send_docs,
            'total_rec_docs' => $total_rec_docs,
        ];
    }




    // faculties document and employees
    public function getFacultyTotalData()
    {
        $currentUser = Auth::user();
        $total_send_docs = '';
        $total_rec_docs = '';
        $total_departments = Department::get()->where('faculty_id', $currentUser->faculty_id)->count();
        $total_employees = Employee::where('user_id', $currentUser->user_id)->get()->count();
        if ($currentUser->user_type == 'fifth_department') {
            $total_send_docs = Document::where('faculty_id', $currentUser->faculty_id)->where('type', 'صادره')->get()->count();
            $total_rec_docs = Document::where('faculty_id', $currentUser->faculty_id)->where('type', 'وارده')->get()->count();
        }
        return [
            'total_departments' => $total_departments,
            'total_employees' => $total_employees,
            'total_send_docs' => $total_send_docs,
            'total_rec_docs' => $total_rec_docs,
        ];
    }
    // common departments
    public function getDepartmentTotalData()
    {
        $total_send_docs = '';
        $total_rec_docs = '';
        $currentUser = Auth::user();
        $total_employees = Employee::where('user_id', $currentUser->user_id)->get()->count();
        if ($currentUser->user_type == 'common_department') {
            $total_send_docs = Document::where('department_id', $currentUser->department_id)->where('type', 'صادره')->get()->count();
            $total_rec_docs = Document::where('department_id', $currentUser->department_id)->where('type', 'وارده')->get()->count();
        }
        if ($currentUser->user_type == 'uncommon_department') {
            $total_send_docs = Document::where('department_id', $currentUser->department_id)->where('type', 'صادره')->get()->count();
            $total_rec_docs = Document::where('department_id', $currentUser->department_id)->where('type', 'وارده')->get()->count();
        }

        return [
            'total_employees' => $total_employees,
            'total_send_docs' => $total_send_docs,
            'total_rec_docs' => $total_rec_docs,
        ];
    }


    public function getTotalQualityAssuranceData()
    {
        $year = (date('Y') - 621);
        $currentUser = Auth::user();
        $criteria =  Criteria::query()
            ->where('criterias.year', $year)
            ->where('')
            ->join('sub_criterias', 'criterias.id', 'sub_criterias.criteria_id')
            ->select('criterias.*', 'sub_criterias.number as sub_number', 'sub_criterias.attachment_path as sub_attachment_path')
            ->get();
        $totalSendDocs = Document::where('dep_id', '=', $currentUser->dep_id)->where('type', 'صادره')->count();
        $total_rec_docs = Document::where('dep_id', '=', $currentUser->dep_id)->where('type', 'وارده')->count();
        $total_employees = Employee::where('user_id', '=', $currentUser->user_id)->count();

        return [
            'total_employees' => $total_employees,
            'total_sendDocs' => $totalSendDocs,
            'total_rec_docs' => $total_rec_docs,
            'criteria' => $criteria,
        ];
    }
}
