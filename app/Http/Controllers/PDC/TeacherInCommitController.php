<?php

namespace App\Http\Controllers\PDC;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TeacherController;
use App\Http\Resources\TeacherInCommitResource;
use App\Models\PDCCommittee;
use App\Models\PDCTeacherInCommitee;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherInCommitController extends Controller
{



    public function index()
    {
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $search = request('search', '');


        $data = PDCTeacherInCommitee::query()
            // ->where('p_d_c_teacher_in_commitees.', 'like', "%{$search}%")
            ->join('users', 'p_d_c_teacher_in_commitees.user_id', 'users.id')
            ->join('teachers', 'p_d_c_teacher_in_commitees.teacher_id', 'teachers.id')
            ->join('p_d_c_committees', 'p_d_c_teacher_in_commitees.commit_id', 'p_d_c_committees.id')
            ->select('p_d_c_teacher_in_commitees.*', 'users.name as uname', 'teachers.name as name', 'teachers.lname as lname', 'teachers.email as email',  'teachers.phone as phone', 'p_d_c_committees.name as cname')
            ->orderBy("p_d_c_teacher_in_commitees.$sortField", $sortDirection)
            ->paginate($per_page);

        return TeacherInCommitResource::collection($data);
    }


    // get all the commits

    public function getCommit()
    {
        $data = PDCCommittee::all();
        return $data;
    }

    public function getTeacher()
    {
        $data = Teacher::all();
        return $data;
    }


    public function store(Request $request)
    {

        $request->validate([
            "teacher_id" => 'required',
            "commit_id" => 'required',
            "attachment" => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx"',

        ], [
            'teacher_id.required' => 'فلد استاد الزامی می باشد',
            'commit_id.required' => 'فلد کمیته الزامی می باشد',
            'attachment' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"

        ]);

        $attachment = null;
        $attachment_path = null;

        if ($request->attachment != '') {
            $attachment = $request->attachment->store('', 'pdc/teacher_in_commit' . $attachment);
            $attachment_path = asset(Storage::url('/pdc/teacher_in_commit/' . $attachment));
        }

        $user_id = Auth::id();
        $teacher_inCommit = new PDCTeacherInCommitee();
        $teacher_inCommit->teacher_id = $request->teacher_id;
        $teacher_inCommit->commit_id = $request->commit_id;
        $teacher_inCommit->attachment = $attachment;
        $teacher_inCommit->attachment_path = $attachment_path;
        $teacher_inCommit->user_id = $user_id;
        $result = $teacher_inCommit->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه راچستر گردید '
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات موفقانه راجستر نشد دوباره تلاش نماید'
            ], 403);
        }
    }

    public function edit($id = '')
    {
        return PDCTeacherInCommitee::find($id);
    }

    public function update(Request $request)
    {

        $request->validate([
            "teacher_id" => 'required',
            "commit_id" => 'required',
            "attachment" => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx"',

        ], [
            'teacher_id.required' => 'فلد استاد الزامی می باشد',
            'commit_id.required' => 'فلد کمیته الزامی می باشد',
            'attachment' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"

        ]);

        $id = $request->id;
        $teacher_inCommit = PDCTeacherInCommitee::find($id);
        $attachment = $teacher_inCommit->attachment;
        $attachment_path = $teacher_inCommit->attachment_path;
        if ($request->attachment != '') {
            if (is_file(storage_path('app/public/pdc/teacher_in_commit/' . $teacher_inCommit->attachment))) {
                unlink(storage_path('app/public/pdc/teacher_in_commit/' . $teacher_inCommit->attachment));
            }
            $attachment = $request->attachment->store('/', 'pdc/teacher_in_commit');
            $attachment_path = asset(Storage::url('pdc/teacher_in_commit/' . $attachment));
        }
        $user_id = Auth::id();
        $teacher_inCommit->teacher_id = $request->teacher_id;
        $teacher_inCommit->commit_id = $request->commit_id;
        $teacher_inCommit->attachment = $attachment;
        $teacher_inCommit->attachment_path = $attachment_path;
        $teacher_inCommit->user_id = $user_id;
        $result = $teacher_inCommit->save();

        if ($result) {
            return response([
                'message' => 'دیتا در آرشیف موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response([
                'message' => 'دیتا در آرشیف  ویرایش نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function destroy($id = '')
    {
        $teacher_inCommit = PDCTeacherInCommitee::find($id);
        if (is_file(storage_path('/app/public/pdc/teacher_in_commit/' . $teacher_inCommit->attachment_path))) {
            unlink(storage_path('/app/public/pdc/teacher_in_commit/' . $teacher_inCommit->attachment_path));
        }
        $result = PDCTeacherInCommitee::destroy($id);
        return $result;
    }
}
