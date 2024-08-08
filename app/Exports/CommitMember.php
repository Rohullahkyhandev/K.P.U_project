<?php

namespace App\Exports;

use App\Models\PD_Committee;
use App\Models\PDCTeacherInCommitee;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CommitMember implements FromView
{

    public $report_data;
    public $type;
    public function getData($type, $report_data)
    {
        $this->report_data = $report_data;
        $this->type = $type;
        return $this;
    }

    public function view(): View
    {
        if ($this->type == "base_on_commit") {
            $commit  = PD_Committee::find($this->report_data);
            return view('reports.teacher_in_commit', [
                'teacher_in_commits' => PDCTeacherInCommitee::query()
                    ->where('p_d_c_teacher_in_commitees.commit_id', '=', $this->report_data)
                    ->leftJoin('faculties', 'p_d_c_teacher_in_commitees.faculty_id', 'faculties.id')
                    ->join('departments', 'p_d_c_teacher_in_commitees.department_id', 'departments.id')
                    ->join('teachers', 'p_d_c_teacher_in_commitees.teacher_id', 'teachers.id')
                    ->join('p_d__committees', 'p_d_c_teacher_in_commitees.commit_id', 'p_d__committees.id')
                    ->select('p_d_c_teacher_in_commitees.*', 'p_d__committees.name as commit_name', 'faculties.name as faculty_name', 'departments.name as department_name', 'teachers.name as tname', 'teachers.lname as lname', 'teachers.phone as phone', 'teachers.email as email')
                    ->get(),
                'commit' => $commit,
                'type' => $this->type,
            ]);
        } else {
            return view('reports.teacher_in_commit', [
                'teacher_in_commits' => PDCTeacherInCommitee::query()
                    ->leftJoin('faculties', 'p_d_c_teacher_in_commitees.faculty_id', 'faculties.id')
                    ->join('departments', 'p_d_c_teacher_in_commitees.department_id', 'departments.id')
                    ->join('teachers', 'p_d_c_teacher_in_commitees.teacher_id', 'teachers.id')
                    ->join('p_d__committees', 'p_d_c_teacher_in_commitees.commit_id', 'p_d__committees.id')
                    ->select('p_d_c_teacher_in_commitees.*', 'p_d__committees.name as commit_name', 'faculties.name as faculty_name', 'departments.name as department_name', 'teachers.name as tname', 'teachers.lname as lname', 'teachers.phone as phone', 'teachers.email as email')
                    ->where(DB::raw("YEAR(p_d_c_teacher_in_commitees.created_at)"), $this->report_data)
                    ->get(),
                'commit' => $this->report_data,
                'type' => $this->type,
            ]);
        }
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text
            1    => ['font' => ['bold' => true]],

            // Styling all cells
            'A1:Z1000' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'F2F2F2',
                    ],
                ],
            ],
        ];
    }
}
