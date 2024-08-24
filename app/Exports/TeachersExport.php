<?php

namespace App\Exports;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Teacher;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;

class TeachersExport implements FromView
{

    public $type;
    public function getData($type)
    {
        $this->type = $type;
        return $this;
    }
    public function view(): View
    {
        $faculties = Faculty::all();
        $faculty_department_data = array();
        $total_teacher =  Teacher::all()->count();
        $total_master_teacher = Teacher::where('education_degree', 'ماستر')->count();
        $total_doctor_teacher = Teacher::where('education_degree', 'داکتر')->count();
        $total_bachelor_teacher = Teacher::where('education_degree', 'لیسانس')->count();
        if ($this->type == 'all') {
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
                        'total_pohand_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('academic_rank', 'پوهاند')->get()->count(),
                        'total_pohand_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('academic_rank', 'پوهاند')->get()->count(),
                        'total_pohandyar_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('academic_rank', 'پوهنیار')->get()->count(),
                        'total_pohandyar_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('academic_rank', 'پوهنیار')->get()->count(),
                        'total_pohanmal_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('academic_rank', 'پوهنمل')->get()->count(),
                        'total_pohanmal_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('academic_rank', 'پوهنمل')->get()->count(),
                        'total_namzadpohanyar_male_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('academic_rank', 'نامزاد پوهنیار')->get()->count(),
                        'total_namzadpohanyar_female_teacher_in_department' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('academic_rank', 'نامزاد پوهنیار')->get()->count(),
                        // teachers in scholarships
                        'total_male_teacher_scholarship' => Teacher::where('department_id', $department->id)->where('gender', 'مرد')->where('status', '2')->get()->count(),
                        'total_female_teacher_scholarship' => Teacher::where('department_id', $department->id)->where('gender', 'زن')->where('status', '2')->get()->count(),
                    );
                }
            }
        }
        return view('reports.teacherReport', [
            'teachers_data' => $faculty_department_data,
            'type' => $this->type,
        ]);
    }
}
