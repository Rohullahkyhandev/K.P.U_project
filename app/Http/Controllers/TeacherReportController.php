<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Teacher;
use App\Models\Teacher_qualification;
use FontLib\TrueType\Collection;
use Illuminate\Http\Request;

class TeacherReportController extends Controller
{



    public function generateReport()
    {
        // number of the departments that depend on the particular faculty
        $departments = Department::query()
            ->join('faculties', 'departments.faculty_id', 'faculties.id')
            ->select("departments.*", "faculties.name as faculty_name", "faculties.id as faculty_id")
            ->get();
        // return $departments;
        $data = [];
        foreach ($departments as $department) {
            $faculty_department_length = Department::where('faculty_id', $department->faculty_id)->get()->count();
            $total_male_teacher_entire_department = Teacher::where('department_id', '=', $department->id)->where('gender', 'مرد')->get()->count();
            $total_female_teacher_entire_department = Teacher::where('department_id', '=', $department->id)->where('gender', 'زن')->get()->count();
            $total_male_teachers = Teacher::where('gender', 'مرد')->get()->count();
            $total_female_teachers = Teacher::where('gender', 'زن')->get()->count();
            $total_teachers = Teacher::get()->count();
            $data[] = (object) array(
                'total_teachers' => $total_teachers,
                'faculty_departments_length' => $faculty_department_length,
                'total_male_teachers' => $total_male_teachers,
                'total_female_teacher' => $total_female_teachers,
                'total_male_teacher_entire_department' => $total_male_teacher_entire_department,
                'total_female_teacher_entire_department' => $total_female_teacher_entire_department,
                'department_name' => $department->name,
                'faculty_name' => $department->faculty_name,
                // 'total_bachelor_male_teacher_in_department' => Teacher::where('gender', 'مرد')->where('department_id', $department->id)->where('education_maqta', 'لسیانس')->get()->count(),
                // 'total_bachelor_female_teacher_in_department' => Teacher::where('gender', 'زن')->where('department_id', $department->id)->where('education_maqta', 'لسیانس')->get()->count(),
                // 'total_master_male_teacher_in_department' => Teacher::where('gender', 'مرد')->where('department_id', $department->id)->where('education_maqta', 'ماستر')->get()->count(),
                // 'total_master_female_teacher_in_department' => Teacher::where('gender', 'زن')->where('department_id', $department->id)->where('education_maqta', 'ماستر')->get()->count(),
                // 'total_doctor_male_teacher_in_department' => Teacher::where('gender', 'مرد')->where('department_id', $department->id)->where('education_maqta', 'داکتر')->get()->count(),
                // 'total_doctor_female_teacher_in_department' => Teacher::where('gender', 'زن')->where('department_id', $department->id)->where('education_maqta', 'داکتر')->get()->count(),
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
            );
        }

        return $data;
    }
}
