<?php

namespace App\Exports;

use App\Models\Scholarship;
use App\Models\Teacher_in_Scholarship;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class TeacherInScholarship implements FromView
{


    protected $year;
    public function getData($year)
    {
        $this->year = $year;
        return $this;
    }

    public function view(): View
    {

        return view('reports.teacher_in_scholarship', [
            'teacher_in_scholarships' => Scholarship::query()
                ->where('scholarships.sent_date', 'like', "%{$this->year}%")
                ->join('teachers', 'scholarships.teacher_id', 'teachers.id')
                ->leftJoin('faculties', 'scholarships.faculty_id', 'faculties.id')
                ->join('departments', 'scholarships.department_id', 'departments.id')
                ->select('scholarships.*', 'teachers.name as tname', 'teachers.lname as lname', 'teachers.email as email', 'faculties.name as faculty_name', 'departments.name as department_name')
                ->get(),
            'year' => $this->year,
        ]);
    }
}
