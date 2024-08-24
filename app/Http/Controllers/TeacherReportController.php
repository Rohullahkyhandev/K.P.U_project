<?php

namespace App\Http\Controllers;

use App\Exports\TeacherDetailsInfo;
use App\Exports\TeachersExport;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Scholarship;
use App\Models\Teacher;
use App\Models\Teacher_qualification;
use FontLib\TrueType\Collection;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TeacherReportController extends Controller
{


    public function  test()
    {
        // make the total report
        $total_data =  array();
        $total_data[] = (object)array(
            'total_teacher_in_university' => Teacher::get()->count(),
            'total_male_teacher' => Teacher::get()->where('gender', 'مرد')->count(),
            'total_female_teacher' => Teacher::get()->where('gender', 'زن')->count(),
            'total_doctor_male_teacher' => Teacher::get()->where('education_degree', 'داکتر')->where('gender', 'مرد')->count(),
            'total_doctor_female_teacher' => Teacher::get()->where('education_degree', 'داکتر')->where('gender', 'زن')->count(),
            'total_master_male_teacher' => Teacher::get()->where('education_degree', 'ماستر')->where('gender', 'مرد')->count(),
            'total_master_female_teacher' => Teacher::get()->where('education_degree', 'ماستر')->where('gender', 'زن')->count(),
            'total_bachelor_male_teacher' => Teacher::get()->where('education_degree', 'لسیانس')->where('gender', 'مرد')->count(),
            'total_bachelor_female_teacher' => Teacher::get()->where('education_degree', 'لسیانس')->where('gender', 'زن')->count(),
            'total_pohand_male_teacher' => Teacher::get()->where('academic_rank', 'پوهاند')->where('gender', 'مرد')->count(),
            'total_pohand_female_teacher' => Teacher::get()->where('academic_rank', 'پوهاند')->where('gender', 'زن')->count(),

            'total_pohandval_male_teacher' => Teacher::where('gender', 'مرد')->where('academic_rank', 'پوهنوال')->get()->count(),
            'total_pohandval_female_teacher' => Teacher::where('gender', 'زن')->where('academic_rank', 'پوهنوال')->get()->count(),

            'total_pohandoie_male_teacher' => Teacher::where('gender', 'مرد')->where('academic_rank', 'پوهندوی')->get()->count(),
            'total_pohandoie_female_teacher' => Teacher::where('gender', 'زن')->where('academic_rank', 'پوهندوی')->get()->count(),

            'total_pohanmal_male_teacher' => Teacher::where('gender', 'مرد')->where('academic_rank', 'پوهنمل')->get()->count(),
            'total_pohanmal_female_teacher' => Teacher::where('gender', 'زن')->where('academic_rank', 'پوهنمل')->get()->count(),


            'total_poh‌nyar_male_teacher' => Teacher::where('gender', 'مرد')->where('academic_rank', 'پوهنیار')->get()->count(),
            'total_poh‌nyar_female_teacher' => Teacher::where('gender', 'زن')->where('academic_rank', 'پوهنیار')->get()->count(),

            'total_poh‌yali_male_teacher' => Teacher::where('gender', 'مرد')->where('academic_rank', 'پوهیالی')->get()->count(),
            'total_poh‌yali_female_teacher' => Teacher::where('gender', 'زن')->where('academic_rank', 'پوهیالی')->get()->count(),

            'total_namzadpohanyar_male_teacher' => Teacher::where('gender', 'مرد')->where('academic_rank', 'نامزاد پوهنیار')->get()->count(),
            'total_namzadpohanyar_female_teacher' => Teacher::where('gender', 'زن')->where('academic_rank', 'نامزاد پوهنیار')->get()->count(),

            // ACC BAST OF THE TEACHER THAT HAS officel JOB ALONGSIDE  THE TUTOR
            'total_first_bast_male_teacher' => Teacher::where('code_bast_in_letter', '1')->where('gender', 'مرد')->count(),
            'total_first_bast_female_teacher' => Teacher::where('code_bast_in_letter', '1')->where('gender', 'زن')->count(),

            'total_second_bast_male_teacher' => Teacher::where('code_bast_in_letter', '2')->where('gender', 'مرد')->count(),
            'total_second_bast_female_teacher' => Teacher::where('code_bast_in_letter', '2')->where('gender', 'زن')->count(),

            'total_third_bast_male_teacher' => Teacher::where('code_bast_in_letter', '3')->where('gender', 'مرد')->count(),
            'total_third_bast_female_teacher' => Teacher::where('code_bast_in_letter', '3')->where('gender', 'زن')->count(),

            'total_forth_bast_male_teacher' => Teacher::where('code_bast_in_letter', '4')->where('gender', 'مرد')->count(),
            'total_forth_bast_female_teacher' => Teacher::where('code_bast_in_letter', '4')->where('gender', 'زن')->count(),

            // teachers doctors and masters in scholarship
            'total_doctor_male_teacher_scholarship' => Teacher::query()
                ->join('scholarships', 'teachers.id', 'scholarships.teacher_id')
                ->where('teachers.gender', 'مرد')
                ->where('teachers.status', '2')
                ->where('scholarships.edu_maqta', 'دوکتورا')
                ->get()->count(),

            'total_doctor_female_teacher_scholarship' => Teacher::query()
                ->join('scholarships', 'teachers.id', 'scholarships.teacher_id')
                ->where('teachers.gender', 'زن')
                ->where('teachers.status', '2')
                ->where('scholarships.edu_maqta', 'دوکتورا')
                ->get()->count(),
            'total_master_male_teacher_scholarship' => Teacher::query()
                ->join('scholarships', 'teachers.id', 'scholarships.teacher_id')
                ->where('teachers.gender', 'مرد')
                ->where('teachers.status', '2')
                ->where('scholarships.edu_maqta', 'ماستری')
                ->get()->count(),

            'total_master_female_teacher_scholarship' => Teacher::query()
                ->join('scholarships', 'teachers.id', 'scholarships.teacher_id')
                ->where('teachers.gender', 'زن')
                ->where('teachers.status', '2')
                ->where('scholarships.edu_maqta', 'ماستری')
                ->get()->count(),
        );

        $faculties = Faculty::all();
        $faculty_department_data = array();
        foreach ($faculties as $faculty) {

            $faculty_department_data[] = (object)array(
                'faculty_name' => $faculty->name,
                'total_teacher_entire_faculty' => Teacher::where('faculty_id', $faculty->id)->get()->count(),
                'department_length' => Department::where('faculty_id', $faculty->id)->count(),

                'total_male_teacher_entire_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'مرد')->get()->count(),
                'total_female_teacher_entire_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'زن')->get()->count(),

                'total_doctor_male_teacher_entire_faculty' => Teacher::where('faculty_id', $faculty->id)->where('education_degree', 'داکتر')->where('gender', 'مرد')->get()->count(),
                'total_doctor_female_teacher_entire_faculty' => Teacher::where('faculty_id', $faculty->id)->where('education_degree', 'داکتر')->where('gender', 'زن')->get()->count(),

                'total_master_male_teacher_entire_faculty' => Teacher::where('faculty_id', $faculty->id)->where('education_degree', 'ماستر')->where('gender', 'مرد')->get()->count(),
                'total_master_female_teacher_entire_faculty' => Teacher::where('faculty_id', $faculty->id)->where('education_degree', 'ماستر')->where('gender', 'زن')->get()->count(),

                'total_bachelor_male_teacher_entire_faculty' => Teacher::where('faculty_id', $faculty->id)->where('education_degree', 'لیسانس')->where('gender', 'مرد')->get()->count(),
                'total_bachelor_female_teacher_entire_faculty' => Teacher::where('faculty_id', $faculty->id)->where('education_degree', 'لیسانس')->where('gender', 'زن')->get()->count(),


                'total_pohand_male_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'مرد')->where('academic_rank', 'پوهاند')->get()->count(),
                'total_pohand_female_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'زن')->where('academic_rank', 'پوهاند')->get()->count(),

                'total_pohandval_male_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'مرد')->where('academic_rank', 'پوهنوال')->get()->count(),
                'total_pohandval_female_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'زن')->where('academic_rank', 'پوهنوال')->get()->count(),

                'total_pohandoie_male_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'مرد')->where('academic_rank', 'پوهندوی')->get()->count(),
                'total_pohandoie_female_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'زن')->where('academic_rank', 'پوهندوی')->get()->count(),

                'total_pohanmal_male_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'مرد')->where('academic_rank', 'پوهنمل')->get()->count(),
                'total_pohanmal_female_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'زن')->where('academic_rank', 'پوهنمل')->get()->count(),

                'total_poh‌nyar_male_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'مرد')->where('academic_rank', 'پوهنیار')->get()->count(),
                'total_poh‌nyar_female_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'زن')->where('academic_rank', 'پوهنیار')->get()->count(),

                'total_poh‌nyar_male_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'مرد')->where('academic_rank', 'پوهنیار')->get()->count(),
                'total_poh‌nyar_female_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'زن')->where('academic_rank', 'پوهنیار')->get()->count(),

                'total_poh‌yali_male_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'مرد')->where('academic_rank', 'پوهیالی')->get()->count(),
                'total_poh‌yali_female_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'زن')->where('academic_rank', 'پوهیالی')->get()->count(),

                'total_namzadpohanyar_male_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'مرد')->where('academic_rank', 'نامزاد پوهنیار')->get()->count(),
                'total_namzadpohanyar_female_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('gender', 'زن')->where('academic_rank', 'نامزاد پوهنیار')->get()->count(),

                // ACC JOB BAST
                'total_first_bast_male_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('code_bast_in_letter', '1')->where('gender', 'مرد')->count(),
                'total_first_bast_female_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('code_bast_in_letter', '1')->where('gender', 'زن')->count(),

                'total_second_bast_male_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('code_bast_in_letter', '2')->where('gender', 'مرد')->count(),
                'total_second_bast_female_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('code_bast_in_letter', '2')->where('gender', 'زن')->count(),

                'total_third_bast_male_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('code_bast_in_letter', '3')->where('gender', 'مرد')->count(),
                'total_third_bast_female_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('code_bast_in_letter', '3')->where('gender', 'زن')->count(),

                'total_forth_bast_male_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('code_bast_in_letter', '4')->where('gender', 'مرد')->count(),
                'total_forth_bast_female_teacher_in_faculty' => Teacher::where('faculty_id', $faculty->id)->where('code_bast_in_letter', '4')->where('gender', 'زن')->count(),

                // total
                'total_dmb_male_in_faculty' => Teacher::where('faculty_id', $faculty->id)
                ->where('gender', 'مرد')
                    ->get()->count(),
                'total_dmb_female_in_faculty' => Teacher::where('faculty_id', $faculty->id)
                ->where('gender', 'زن')
                    ->get()->count(),
                'total_dmb_in_faculty' => Teacher::where('faculty_id', $faculty->id)
                ->get()->count(),

                'total_doctor_male_teacher_scholarship' => Teacher::query()
                    ->join('scholarships', 'teachers.id', 'scholarships.teacher_id')
                    ->where('teachers.faculty_id', $faculty->id)
                    ->where('teachers.gender', 'مرد')
                    ->where('teachers.status', '2')
                    ->where('scholarships.edu_maqta', 'دوکتورا')
                    ->get()->count(),

                'total_doctor_female_teacher_scholarship' => Teacher::query()
                    ->join('scholarships', 'teachers.id', 'scholarships.teacher_id')
                    ->where('teachers.faculty_id', $faculty->id)
                    ->where('teachers.gender', 'زن')
                    ->where('teachers.status', '2')
                    ->where('scholarships.edu_maqta', 'دوکتورا')
                    ->get()->count(),

                'total_master_male_teacher_scholarship' => Teacher::query()
                    ->join('scholarships', 'teachers.id', 'scholarships.teacher_id')
                    ->where('teachers.faculty_id', $faculty->id)
                    ->where('teachers.gender', 'مرد')
                    ->where('teachers.status', '2')
                    ->where('scholarships.edu_maqta', 'ماستری')
                    ->get()->count(),

                'total_master_female_teacher_scholarship' => Teacher::query()
                    ->join('scholarships', 'teachers.id', 'scholarships.teacher_id')
                    ->where('teachers.faculty_id', $faculty->id)
                    ->where('teachers.gender', 'زن')
                    ->where('teachers.status', '2')
                    ->where('scholarships.edu_maqta', 'ماستری')
                    ->get()->count(),

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
                    'total_bachelor_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('education_degree', 'لیسانس')->get()->count(),
                    'total_bachelor_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('education_degree', 'لیسانس')->get()->count(),

                    'total_pohand_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('academic_rank', 'پوهاند')->get()->count(),
                    'total_pohand_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('academic_rank', 'پوهاند')->get()->count(),

                    'total_pohandval_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('academic_rank', 'پوهنوال')->get()->count(),
                    'total_pohandval_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('academic_rank', 'پوهنوال')->get()->count(),

                    'total_pohandoie_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('academic_rank', 'پوهندوی')->get()->count(),
                    'total_pohandoie_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('academic_rank', 'پوهندوی')->get()->count(),

                    'total_pohanmal_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('academic_rank', 'پوهنمل')->get()->count(),
                    'total_pohanmal_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('academic_rank', 'پوهنمل')->get()->count(),

                    'total_poh‌nyar_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('academic_rank', 'پوهنیار')->get()->count(),
                    'total_poh‌nyar_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('academic_rank', 'پوهنیار')->get()->count(),

                    'total_poh‌nyar_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('academic_rank', 'پوهنیار')->get()->count(),
                    'total_poh‌nyar_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('academic_rank', 'پوهنیار')->get()->count(),

                    'total_poh‌yali_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('academic_rank', 'پوهیالی')->get()->count(),
                    'total_poh‌yali_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('academic_rank', 'پوهیالی')->get()->count(),

                    'total_namzadpohanyar_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('academic_rank', 'نامزاد پوهنیار')->get()->count(),
                    'total_namzadpohanyar_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('academic_rank', 'نامزاد پوهنیار')->get()->count(),

                    // ACC JOB BAST
                    'total_first_bast_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('code_bast_in_letter', '1')->where('gender', 'مرد')->count(),
                    'total_first_bast_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('code_bast_in_letter', '1')->where('gender', 'زن')->count(),

                    'total_second_bast_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('code_bast_in_letter', '2')->where('gender', 'مرد')->count(),
                    'total_second_bast_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('code_bast_in_letter', '2')->where('gender', 'زن')->count(),

                    'total_third_bast_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('code_bast_in_letter', '3')->where('gender', 'مرد')->count(),
                    'total_third_bast_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('code_bast_in_letter', '3')->where('gender', 'زن')->count(),

                    'total_forth_bast_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('code_bast_in_letter', '4')->where('gender', 'مرد')->count(),
                    'total_forth_bast_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('code_bast_in_letter', '4')->where('gender', 'زن')->count(),

                    // total
                    'total_dmb_male_in_department' => Teacher::where('department_id', $department->id)
                        ->where('gender', 'مرد')
                        ->get()->count(),
                    'total_dmb_female_in_department' => Teacher::where('department_id', $department->id)
                        ->where('gender', 'زن')
                        ->get()->count(),
                    'total_dmb_in_department' => Teacher::where('department_id', $department->id)
                        ->get()->count(),
                    // teachers doctors and masters in scholarship
                    'total_doctor_male_teacher_scholarship' => Teacher::query()
                        ->join('scholarships', 'teachers.id', 'scholarships.teacher_id')
                        ->where('teachers.department_id', $department->id)
                        ->where('teachers.gender', 'مرد')
                        ->where('teachers.status', '2')
                        ->where('scholarships.edu_maqta', 'دوکتورا')
                        ->get()->count(),

                    'total_doctor_female_teacher_scholarship' => Teacher::query()
                        ->join('scholarships', 'teachers.id', 'scholarships.teacher_id')
                        ->where('teachers.department_id', $department->id)
                        ->where('teachers.gender', 'زن')
                        ->where('teachers.status', '2')
                        ->where('scholarships.edu_maqta', 'دوکتورا')
                        ->get()->count(),
                    'total_master_male_teacher_scholarship' => Teacher::query()
                        ->join('scholarships', 'teachers.id', 'scholarships.teacher_id')
                        ->where('teachers.department_id', $department->id)
                        ->where('teachers.gender', 'مرد')
                        ->where('teachers.status', '2')
                        ->where('scholarships.edu_maqta', 'ماستری')
                        ->get()->count(),

                    'total_master_female_teacher_scholarship' => Teacher::query()
                        ->join('scholarships', 'teachers.id', 'scholarships.teacher_id')
                        ->where('teachers.department_id', $department->id)
                        ->where('teachers.gender', 'زن')
                        ->where('teachers.status', '2')
                        ->where('scholarships.edu_maqta', 'ماستری')
                        ->get()->count(),



                );
            }
        }

        return response([
            'faculty_department_teacher_data' => $faculty_department_data,
            'total_data' => $total_data
        ]);
    }


    // function generate teacher information report
    public function generateTeacherInformationReport()
    {

        $results = DB::table('teachers')
        ->leftJoin('faculties', 'teachers.faculty_id', '=', 'faculties.id')
        ->leftJoin('departments', 'teachers.department_id', '=', 'departments.id')
        ->leftJoin('teacher_qualifications', 'teachers.id', '=', 'teacher_qualifications.teacher_id')
        ->leftJoin('promotions', function ($join) {
            $join->on('teachers.id', '=', 'promotions.teacher_id')
            ->whereIn('promotions.id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                ->from('promotions')
                ->groupBy('teacher_id');
            });
        })
            ->leftJoin('scholarships', function ($join) {
                $join->on('teachers.id', '=', 'scholarships.teacher_id')
                ->whereIn('scholarships.id', function ($query) {
                    $query->select(DB::raw('MAX(id)'))
                    ->from('scholarships')
                    ->groupBy('teacher_id');
                });
            })
            ->select(
                'teachers.id as teacher_id',
                'teachers.code_bast_in_letter as code_bast_in_letter',
                'teachers.name as teacher_name',
                'teachers.lname as lname',
                'teachers.fatherName as fname',
                'teachers.academic_rank as academic_rank',
                'teachers.education_degree as education_degree',
                'teachers.education_field as education_field',
                'teachers.hire_date as hire_date',
                DB::raw('YEAR(teachers.birth_date) as birth_date'),
                'teachers.gender as gender',
                'teachers.phone as phone',
                'teachers.languages as languages',
                'teachers.email as teacher_email',
                'teacher_qualifications.edu_field as edu_field',
                'teacher_qualifications.education_ as education',
                DB::raw('YEAR(teacher_qualifications.graduated_year) as grad_year'),
                DB::raw('YEAR(teacher_qualifications.admission_year) as admission_year'),
                'teacher_qualifications.country as cname',
                'faculties.name as faculty_name',
                'departments.name as dname',
                'promotions.date as p_date',
                'scholarships.country_name as country_name',
                'scholarships.edu_maqta as edu_maqta',
                'scholarships.edu_degree as edu_degree',
                'scholarships.sent_date as sent_date',
                'scholarships.back_date as back_date'
            )
            ->get();

        // Transform data into a nested structure
        $teachers = $results->groupBy('teacher_id')->map(function ($items) {
            $teacher = $items->first(); // Get the teacher's information
            $qualifications = $items->map(function ($item) {
                return [
                    'edu_field' => $item->edu_field,
                    'grad_year' => $item->grad_year,
                    'admission_year' => $item->admission_year,
                    'cname' => $item->cname,
                ];
            }); // Avoid duplicate qualifications if any

            return [
                'id' => $teacher->teacher_id,
                'code_bast_in_letter' => $teacher->code_bast_in_letter,
                'education_field' => $teacher->education_field,
                'academic_rank' => $teacher->academic_rank,
                'education_degree' => $teacher->education_degree,
                'name' => $teacher->teacher_name,
                'lname' => $teacher->lname,
                'fname' => $teacher->fname,
                'gender' => $teacher->gender,
                'birth_date' => $teacher->birth_date,
                'hire_date' => $teacher->hire_date,
                'email' => $teacher->teacher_email,
                'phone' => $teacher->phone,
                'languages' => json_decode($teacher->languages, true),
                'faculty' => $teacher->faculty_name,
                'department' => $teacher->dname,
                'p_date' => $teacher->p_date,
                'scholarships' => [
                    'country_name' => $teacher->country_name,
                    'edu_maqta' => $teacher->edu_maqta,
                    'edu_degree' => $teacher->edu_degree,
                    'sent_date' => $teacher->sent_date,
                    'back_date' => $teacher->back_date,
                ],
                'qualifications' => $qualifications,
            ];
        })->values();

        // return $teachers;
        // Return data as JSON
        return response()->json($teachers);
        // return view('reports.teacher_personal_details', ['teacher_data' => $teachers]);

        // return Excel::download(new TeacherDetailsInfo(), 'teacher Details information report.xls');
    }




    // public function generateReport($type)
    // {
    //     return Excel::download((new TeachersExport())->getData($type), 'teacher report.xls');
    // }

    // // dose not used
    // public function exportToExcel()
    // {
    //     return Excel::download(new TeachersExport(), 'teacher report.xls');
    // }
}
