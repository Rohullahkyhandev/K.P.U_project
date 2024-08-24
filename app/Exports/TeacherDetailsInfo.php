<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class TeacherDetailsInfo implements FromView
{


    public function view(): View
    {

        $results = DB::table('teachers')
            ->join('faculties', 'teachers.faculty_id', '=', 'faculties.id')
            ->join('departments', 'teachers.department_id', '=', 'departments.id')
            ->join('teacher_qualifications', 'teachers.id', '=', 'teacher_qualifications.teacher_id')
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
                'teachers.birth_date as birth_date',
                'teachers.gender as gender',
                'teachers.phone as phone',
                'teachers.languages as languages',
                'teachers.email as teacher_email',
                'teacher_qualifications.education_ as education',
                DB::raw('YEAR(teacher_qualifications.graduated_year) as grad_year'),
                'teacher_qualifications.country as cname',
                'teacher_qualifications.university as uname',
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
                    'education' => $item->education,
                    'grad_year' => $item->grad_year,
                    'cname' => $item->cname,
                    'uname' => $item->uname,
                ];
            })->unique(); // Avoid duplicate qualifications if any

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
                'languages' => $teacher->languages,
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
        // return response()->json($teachers);
        return view('reports.teacher_personal_details', ['teacher_data' => $teachers]);
    }
}
