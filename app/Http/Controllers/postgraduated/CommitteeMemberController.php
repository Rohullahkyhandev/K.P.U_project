<?php

namespace App\Http\Controllers\postgraduated;

use App\Exports\PostGraduatedCommitMember;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostCommitteeMemberResource;
use App\Models\CommitMember;
use App\Models\PostCommit;
use App\Models\PostCommitteeMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;

class CommitteeMemberController extends Controller
{


    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data = CommitMember::query()
            ->where('commit_members.name', 'like', "%{$search}%")
            ->orWhere('commit_members.lname', 'like', "%{$search}%")
            ->join('post_commits', 'commit_members.commit_id', 'post_commits.id')
            ->join('users', 'commit_members.user_id', 'users.id')
            ->select('commit_members.*', 'post_commits.name as commit_name', 'post_commits.faculty as faculty', 'users.name as uname')
            ->orderBy("commit_members.$sortField", $sortDirection)
            ->paginate($per_page);

        return PostCommitteeMemberResource::collection($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'commit_id' => 'required',
        ], [
            'name.required' => 'فیلد نام الزامی میباشد',
            'lname.required' => 'فیلد تخلص الزامی میباشد',
            'email.required' => 'فیلد نام ادرس ایمل الزامی میباشد',
            'phone.required' => 'فیلد نام  شماره تماس الزامی میباشد',
            'address.required' => 'فیلد نام   ادرس  الزامی میباشد',
            'commit_id.required' => 'فیلد کمیته الزامی میباشد',
        ]);

        $user_id = Auth::user()->id;
        $committee_member = new CommitMember();
        $committee_member->name = $request->name;
        $committee_member->lname = $request->lname;
        $committee_member->email = $request->email;
        $committee_member->address = $request->address;
        $committee_member->phone = $request->phone;
        $committee_member->commit_id = $request->commit_id;
        $committee_member->user_id = $user_id;
        $result  = $committee_member->save();

        if ($result) {
            return response([
                'message' => ' اطلاعات موفقانه ذخیره شد'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات ذخیره نشد دوباره تلاش نماید'
            ], 403);
        }
    }



    public function getAllCommittees()
    {
        $data = PostCommit::all();
        return $data;
    }

    public function edit($id = '')
    {
        return CommitMember::find($id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lname' => 'required',
            'commit_id' => 'required',
            'user_id' => 'required',
        ], [
            'name.required' => 'فیلد نام الزامی میباشد',
            'lname.required' => 'فیلد نام خانوادگی الزامی میباشد',
            'commit_id.required' => 'فیلد کمیته الزامی میباشد',
        ]);

        $committee_member = CommitMember::find($request->id);
        $committee_member->name = $request->name;
        $committee_member->lname = $request->lname;
        $committee_member->phone = $request->phone;
        $committee_member->commit_id = $request->commit_id;
        $result  = $committee_member->save();

        if ($result) {
            return response([
                'message' => ' اطلاعات موفقانه ویرایش شد'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات ویرایش نشد دوباره تلاش نماید'
            ], 403);
        }
    }


    public function destroy($id = '')
    {
        $result = CommitMember::destroy($id);
        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه حذف گردید'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات حذف نشد دوباره تلاش نماید'
            ], 403);
        }
    }


    // generate report for commites members
    public function generate_report_commit_member($type, $report_data)
    {

        return Excel::download((new PostGraduatedCommitMember)->getData($type, $report_data), 'report.xls');
        
    }
}
