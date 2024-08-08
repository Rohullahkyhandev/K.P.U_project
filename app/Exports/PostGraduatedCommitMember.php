<?php

namespace App\Exports;

use App\Models\CommitMember;
use App\Models\PostCommit;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PostGraduatedCommitMember implements FromView
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
            return view('reports.post_member_commit', [
                'committeeMembers' =>  PostCommit::query()
                    ->where(DB::raw('YEAR(post_commits.created_at)'), '=', $this->report_data)
                    ->join('commit_members', 'post_commits.id', 'post_commits.id')
                    ->select('post_commits.*', 'commit_members.name as board_name', 'commit_members.lname', 'commit_members.phone', 'commit_members.email', 'commit_members.address')
                    ->get(),
                'year' => $this->report_data,
                'type' => $this->type,
            ]);
        }

        if ($this->type == 'base_on_commit') {
            $commit = PostCommit::find($this->report_data);
            return view('reports.post_member_commit', [
                'committeeMembers' => CommitMember::query()
                    ->where('commit_members.commit_id', '=', $this->report_data)
                    ->join('post_commits', 'commit_members.commit_id', 'post_commits.id')
                    ->select('commit_members.*', 'post_commits.name as commit_name')
                    ->get(),
                'commit_name' => $commit->name,
                'type' => $this->type,
            ]);
        }
    }
}
