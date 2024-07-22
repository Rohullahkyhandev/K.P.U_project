<?php

namespace App\Http\Controllers;

use App\Exports\TeachersExport;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Teacher;
use App\Models\Teacher_qualification;
use FontLib\TrueType\Collection;
use Illuminate\Http\Request;
use Excel;

class TeacherReportController extends Controller
{



    public function generateReport()
    {
        // $faculty_department_data[$faculty->name]['total_teacher_entire_faculty'] = Teacher::where('faculty_id', $faculty->id)->get()->count();
        // $faculty_department_data[$faculty->name]['total_male_teacher_entire_faculty'] = Teacher::where('faculty_id', $faculty->id)->where('gender', 'مرد')->get()->count();
        // $faculty_department_data[$faculty->name]['total_female_teacher_entire_faculty'] = Teacher::where('faculty_id', $faculty->id)->where('gender', 'زن')->get()->count();
        // $department_data[$faculty->name] = Department::where('faculty_id', $faculty->id)->get();
        // foreach ($department_data[$faculty->name] as $department) {
        //     $faculty_department_data[$faculty->name][$department->name]['total_teacher_in_department'] = Teacher::where('department_id', $department->id)->get()->count();
        //     $faculty_department_data[$faculty->name][$department->name]['total_male_teacher_in_department'] = Teacher::where('department_id', $department->id)->where('gender', 'مرد')->get()->count();
        //     $faculty_department_data[$faculty->name][$department->name]['total_female_teacher_in_department'] = Teacher::where('department_id', $department->id)->where('gender', 'زن')->get()->count();
        //     $faculty_department_data[$faculty->name][$department->name]['total_doctor_male_teacher_in_department'] = Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('education_degree', 'داکتر')->get()->count();
        //     $faculty_department_data[$faculty->name][$department->name]['total_doctor_female_teacher_in_department'] = Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('education_degree', 'داکتر')->get()->count();
        //     $faculty_department_data[$faculty->name][$department->name]['total_master_male_teacher_in_department'] = Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('education_degree', 'ماستر')->get()->count();
        //     $faculty_department_data[$faculty->name][$department->name]['total_master_female_teacher_in_department'] = Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('education_degree', 'ماستر')->get()->count();
        //     $faculty_department_data[$faculty->name][$department->name]['total_bachelor_male_teacher_in_department'] = Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('education_degree', 'لیسانس')->get()->count();
        //     $faculty_department_data[$faculty->name][$department->name]['total_bachelor_female_teacher_in_department'] = Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('education_degree', 'لیسانس')->get()->count();
        // }

        $faculties = Faculty::all();
        $faculty_department_data = array();
        foreach ($faculties as $faculty) {

            $faculty_department_data[] = (object)array(
                'faculty_name' => $faculty->name,
                'total_teacher_entire_faculty' => Teacher::where('faculty_id', $faculty->id)->get()->count(),
                'total_teacher' => Teacher::all()->count(),
                'total_male_teacher' => Teacher::where('gender', '=', 'مرد')->get()->count(),
                'total_female_teacher' => Teacher::where('gender', '=', 'زن')->get()->count(),
                'total_male_teacher_entire_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'مرد')->get()->count(),
                'total_female_teacher_entire_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'زن')->get()->count(),
                'faculty_departments_length' => Department::where('faculty_id', $faculty->id)->count(),
            );

            foreach (Department::where('faculty_id', $faculty->id)->get() as $department) {
                $faculty_department_data[count($faculty_department_data) - 1]->departments[] = (object) array(
                    'department_name' => $department->name,
                    'total_teacher_in_department' => Teacher::where('department_id', $department->id)->get()->count(),
                    'total_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->get()->count(),
                    'total_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->get()->count(),
                    'total_doctor_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('education_degree', 'داکتر')->get()->count(),
                    'total_doctor_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('education_degree', 'داکتر')->get()->count(),
                    'total_master_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('education_degree', 'ماستر')->get()->count(),
                    'total_master_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('education_degree', 'ماستر')->get()->count(),
                    'total_bachelor_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('education_degree', 'لسیانس')->get()->count(),
                    'total_bachelor_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('education_degree', 'لسیانس')->get()->count(),
                );
            }
        }
        return $faculty_department_data;

        // number of the departments that depend on the particular faculty
        $departments = Department::query()
            ->join('faculties', 'departments.faculty_id', 'faculties.id')
            ->select("departments.*", "faculties.name as faculty_name", "faculties.id as faculty_id")
            ->get();
        // return $departments;
        $data = [];
        foreach ($departments as  $department) {
            $faculty_department_length = Department::where('faculty_id', $department->faculty_id)->get()->count();
            $total_male_teacher_entire_department = Teacher::where('department_id', '=', $department->id)->where('gender', 'مرد')->get()->count();
            $total_female_teacher_entire_department = Teacher::where('department_id', '=', $department->id)->where('gender', 'زن')->get()->count();
            $total_male_teachers = Teacher::where('gender', 'مرد')->get()->count();
            $total_female_teachers = Teacher::where('gender', 'زن')->get()->count();
            $total_teachers = Teacher::get()->count();
            $data[] = (object) array(
                'faculty_name' => $department->faculty_name,
                'total_teachers' => $total_teachers,
                'total_male_teachers' => $total_male_teachers,
                'faculty_departments_length' => $faculty_department_length,
                'total_female_teacher' => $total_female_teachers,

                'teachers' => [
                    'total_male_teacher_entire_department' => $total_male_teacher_entire_department,
                    'total_female_teacher_entire_department' => $total_female_teacher_entire_department,
                    'department_name' => $department->name,
                    'total_bachelor_male_teacher_in_department' => Teacher::where('gender', 'مرد')->where('department_id', $department->id)->where('education_degree', 'لسیانس')->get()->count(),
                    'total_bachelor_female_teacher_in_department' => Teacher::where('gender', 'زن')->where('department_id', $department->id)->where('education_degree', 'لسیانس')->get()->count(),
                    'total_master_male_teacher_in_department' => Teacher::where('gender', 'مرد')->where('department_id', $department->id)->where('education_degree', 'ماستر')->get()->count(),
                    'total_master_female_teacher_in_department' => Teacher::where('gender', 'زن')->where('department_id', $department->id)->where('education_degree', 'ماستر')->get()->count(),
                    'total_doctor_male_teacher_in_department' => Teacher::where('gender', 'مرد')->where('department_id', $department->id)->where('education_degree', 'داکتر')->get()->count(),
                    'total_doctor_female_teacher_in_department' => Teacher::where('gender', 'زن')->where('department_id', $department->id)->where('education_degree', 'داکتر')->get()->count(),
                    'total_pohand_male_teacher_in_department' => Teacher::where('gender', 'مرد')->where('department_id', $department->id)->where('academic_rank', 'پوهاند')->get()->count(),
                    'total_pohand_female_teacher_in_department' => Teacher::where('gender', 'زن')->where('department_id', $department->id)->where('academic_rank', 'پوهاند')->get()->count(),
                    'total_pohyali_male_teacher_in_department' => Teacher::where('gender', 'مرد')->where('department_id', $department->id)->where('academic_rank', 'پوهیالی')->get()->count(),
                    'total_pohyali_female_teacher_in_department' => Teacher::where('gender', 'زن')->where('department_id', $department->id)->where('academic_rank', 'پوهیالی')->get()->count(),
                    'total_pohanmal_male_teacher_in_department' => Teacher::where('gender', 'مرد')->where('department_id', $department->id)->where('academic_rank', 'پوهنمل')->get()->count(),
                    'total_pohanmal_female_teacher_in_department' => Teacher::where('gender', 'زن')->where('department_id', $department->id)->where('academic_rank', 'پوهنمل')->get()->count(),
                    'total_namzadPohanyar_male_teacher_in_department' => Teacher::where('gender', 'مرد')->where('department_id', $department->id)->where('academic_rank', 'نامزد پوهنیار')->get()->count(),
                    'total_namzadPohanyar_female_teacher_in_department' => Teacher::where('gender', 'زن')->where('department_id', $department->id)->where('academic_rank', 'نامزد پوهنیار')->get()->count(),
                    'total_pohanyar_male_teacher_in_department' => Teacher::where('gender', 'مرد')->where('department_id', $department->id)->where('academic_rank', ' پوهنیار')->get()->count(),
                    'total_pohanyar_female_teacher_in_department' => Teacher::where('gender', 'زن')->where('department_id', $department->id)->where('academic_rank', ' پوهنیار')->get()->count(),
                ],
            );
        }

        return $data;
    }


    public function exportToExcel()
    {
        return Excel::download(new TeachersExport(), 'teacher report.xls');
    }
}
