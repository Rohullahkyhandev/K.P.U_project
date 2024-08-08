<?php

namespace App\Exports;

use App\Models\PostGraduatedPrograms;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class StudentExport implements FromView
{

    public $type;
    public $report_data;
    public $status;

    public function getData($type, $report_data, $status)
    {
        $this->type = $type;
        $this->report_data = $report_data;
        $this->status = $status;
        return $this;
    }

    public function view(): View
    {

        if ($this->type == 'base_on_year' && $this->status == 1) {
            return view('reports.student', [
                'students' => Student::query()
                    ->where('students.status', '1')
                    ->where(DB::raw('YEAR(students.admission_year)'), $this->report_data)
                    ->join('post_graduated_programs', 'students.program_id', 'post_graduated_programs.id')
                    ->select('students.*', 'post_graduated_programs.program_name as program_name')
                    ->get(),
                'type' => $this->type,
                'year' => $this->report_data,
                'status' => $this->status,
            ]);
        }
        if ($this->type == 'base_on_year' && $this->status == 2) {
            return view('reports.student', [
                'graduated_students' => Student::query()
                    ->where('students.status', '2')
                    ->where(DB::raw('YEAR(students.admission_year)'), $this->report_data)
                    ->join('post_graduated_programs', 'students.program_id', 'post_graduated_programs.id')
                    ->join('graduated_students', 'students.id', 'graduated_students.student_id')
                    ->select('students.*', 'post_graduated_programs.program_name as program_name', 'graduated_students.percentage as percentage', 'graduated_students.diplome_id as diploma_id', 'graduated_students.thesis_mark as thesis_mark', 'graduated_students.thesis_guide_teacher as thesis_guide_teacher', 'graduated_students.attribute as attribute', 'graduated_students.graduated_year as graduation_year')
                    ->get(),
                'type' => $this->type,
                'year' => $this->report_data,
                'status' => $this->status,
            ]);
        }



        if ($this->status == 1 && $this->type == 'base_on_program') {
            $program = PostGraduatedPrograms::find($this->report_data);
            return view('reports.student', [
                'students' => Student::query()
                    ->where('students.status', '1')
                    ->where('students.program_id', $this->report_data)
                    ->join('post_graduated_programs', 'students.program_id', 'post_graduated_programs.id')
                    ->select('students.*', 'post_graduated_programs.program_name as program_name')
                    ->get(),
                'type' => $this->type,
                'program_name' => $program->program_name,
                'status' => $this->status,
            ]);
        }
        if ($this->status == 2 && $this->type == 'base_on_program') {
            $program = PostGraduatedPrograms::find($this->report_data);
            return view('reports.student', [
                'graduated_students' => Student::query()
                    ->where('students.status', '2')
                    ->where('students.program_id', $this->report_data)
                    ->join('post_graduated_programs', 'students.program_id', 'post_graduated_programs.id')
                    ->join('graduated_students', 'students.id', 'graduated_students.student_id')
                    ->select('students.*', 'post_graduated_programs.program_name as program_name', 'graduated_students.percentage as percentage', 'graduated_students.diplome_id as diploma_id', 'graduated_students.thesis_mark as thesis_mark', 'graduated_students.thesis_guide_teacher as thesis_guide_teacher', 'graduated_students.attribute as attribute', 'graduated_students.graduated_year as graduation_year')
                    ->get(),
                'type' => $this->type,
                'program_name' => $program->program_name,
                'status' => $this->status,
            ]);
        }
    }
}
