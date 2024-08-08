<?php

namespace App\Exports;

use App\Models\Board;
use App\Models\BoardMember as ModelsBoardMember;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BoardMember implements FromView
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

        if ($this->type == 'base_on_year') {
            return view('reports.teacherReport', [
                'boardMembers' => Board::query()
                    ->where('YEAR(date)', '=', $this->report_data)
                    ->join('board_members', 'boards.id', 'board_members.board_id')
                    ->select('boards.*', 'board_members.name as board_name', 'board_members.lname', 'board_members.phone', 'board_members.email', 'board_members.address')
                    ->get(),
                'year' => $this->report_data,
                'type' => $this->type,
            ]);
        }

        if ($this->type == 'base_on_board') {
            $board = Board::find($this->report_data);
            return view('reports.teacherReport', [
                'boardMembers' => ModelsBoardMember::query()
                    ->where('board_members.board_id', '=', $this->report_data)
                    ->join('boards', 'board_members.board_id', 'boards.id')
                    ->select('boards.*', 'boards.name as board_name')
                    ->get(),
                'board_name' => $board->name,
                'type' => $this->type,
            ]);
        }
    }
}
