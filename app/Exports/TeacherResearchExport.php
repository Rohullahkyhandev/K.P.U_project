<?php

namespace App\Exports;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\TeacherResearch;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TeacherResearchExport implements FromView
{
    public $type;
    public $faculty_id;
    public $department_id;
    public function getData($type, $faculty_id, $department_id)
    {
        $this->type = $type;
        $this->faculty_id = $faculty_id;
        $this->department_id = $department_id;
        return $this;
    }
    public function view(): View
    {

        if ($this->type == 'all') {
            return view('reports.teacher_research', [
                'teacher_researches' => TeacherResearch::query()
                    ->join('faculties', 'teacher_research.faculty_id', 'faculties.id')
                    ->join('departments', 'teacher_research.department_id', 'departments.id')
                    ->select('teacher_research.*', 'faculties.name as faculty_name', 'departments.name as department_name')
                    ->get(),
                'type' => $this->type,
            ]);
        }
        if ($this->type == 'faculty') {
            $faculty = Faculty::find($this->faculty_id);
            return view('reports.teacher_research', [
                'teacher_researches' => TeacherResearch::query()
                    ->where('teacher_research.faculty_id', $this->faculty_id)
                    ->join('faculties', 'teacher_research.faculty_id', 'faculties.id')
                    ->select('teacher_research.*', 'faculties.name as faculty_name')
                    ->get(),
                'type' => $this->type,
                'faculty_name' => $faculty->name,
            ]);
        }

        if ($this->type == 'department') {
            $department = Department::find($this->department_id);
            return view('reports.teacher_research', [
                'teacher_researches' => TeacherResearch::query()
                    ->where('teacher_research.department_id', $this->department_id)
                    ->join('departments', 'teacher_research.faculty_id', 'departments.id')
                    ->join('faculties', 'teacher_research.faculty_id', 'faculties.id')
                    ->select('teacher_research.*', 'departments.name as department_name', 'faculties.name as faculty_name')
                    ->get(),
                'type' => $this->type,
                'department_name' => $department->name,
            ]);
        }
    }
}
