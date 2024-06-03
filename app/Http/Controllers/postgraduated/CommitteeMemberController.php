<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCommitteeMemberResource;
use App\Models\PostCommitteeMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommitteeMemberController extends Controller
{


    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data = PostCommitteeMember::query()
            ->where('commit_members.name', 'like', "%{$search}%")
            ->orWhere('commit_members.lname', 'like', "%{$search}%")
            ->join('post_committees.', 'commit_members.commit_id', 'post_committees.id')
            ->join('users', 'commit_members.user_id', 'users.id')
            ->select('commit_members.*', 'post_committees.name as name', 'post_committees.faulty as faculty', 'users.name as uname')
            ->orderBy("commit_members.$sortField", $sortDirection)
            ->paginate($per_page);

        return PostCommitteeMemberResource::collection($data);
    }

    public function store(Request $request)
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

        $user_id = Auth::user()->id;
        $committee_member = new PostCommitteeMember();
        $committee_member->name = $request->name;
        $committee_member->lname = $request->lname;
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
        $data = PostCommitteeMember::all();
        return $data;
    }

    public function edit($id = '')
    {
        return PostCommitteeMember::find($id);
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

        $committee_member = PostCommitteeMember::find($request->id);
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
        $result = PostCommitteeMember::destroy($id);
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
}
