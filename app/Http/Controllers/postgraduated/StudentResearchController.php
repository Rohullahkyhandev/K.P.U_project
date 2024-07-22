<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResearchResource;
use App\Models\StudentResearch;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentResearchController extends Controller
{

    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $year = request('year', '');

        $data = StudentResearch::query()
            ->where('student_research.date', 'like', $year)
            ->whereAny([
                'student_research.title',
                'student_research.date',
            ], 'LIKE', "%{$search}%")
            ->join('users', 'student_research.user_id', 'users.id')
            ->join('students', 'student_research.student_id', 'students.id')
            ->join('post_graduated_programs', 'student_research.program_id', 'post_graduated_programs.id')
            ->join('teachers', 'student_research.teacher_id', 'teachers.id')
            ->select('student_research.*', 'post_graduated_programs.program_name as program', 'teachers.name as teacher_name', 'teachers.lname as teacher_lname', 'users.name as uname', 'students.name as name', 'students.lname as lname')
            // ->where('student_ressearch.program_id', '=', $program_id)
            ->orderBy("student_research.$sortField", $sortDirection)
            ->paginate($per_page);

        return StudentResearchResource::collection($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'teacher_id' => 'required',
            'program_id' => 'required',
            'description' => 'nullable',
            'attachment' => 'nullable|max:6000|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'title.required' => 'فیلد عنوان الزامی می باشد',
            'date.required' => 'فیلد تاریخ الزامی می باشد',
            'teacher_id.required' => 'فیلد نام استاد الزامی می باشد',
            'program_id.required' => 'فیلد نام برنامه الزامی می باشد',
            'attachment.required' => 'فیلد فایل الزامی می باشد',
        ]);

        $user_id = Auth::user()->id;
        $attachment = null;
        $attachment_path =  null;
        if ($request->hasFile('attachment')) {
            $attachment = $request->attachment->store('/', 'postgraduated/student_research');
            $attachment_path = asset(Storage::url('postgraduated/student_research/' . $attachment));
        }

        $studnet_research = new  StudentResearch();
        $studnet_research->title = $request->title;
        $studnet_research->date = $request->date;
        $studnet_research->student_id = $request->student_id;
        $studnet_research->teacher_id = $request->teacher_id;
        $studnet_research->program_id = $request->program_id;
        $studnet_research->description = $request->description;
        $studnet_research->attachment = $attachment;
        $studnet_research->attachment_path = $attachment_path;
        $studnet_research->user_id = $user_id;
        $result = $studnet_research->save();
        if ($result) {
            return response([
                'message' => 'درخواست موفقانه انجام شد'
            ], 200);
        } else {
            return response([
                'error' => 'رخواست موفقانه انجام نشد'
            ], 304);
        }
    }


    public function getTeacherData($program_id)
    {
        $data =  Teacher::where('program_id', $program_id)->get();
        return $data;
    }

    public function edit($id)
    {
        $data = StudentResearch::find($id);
        return $data;
    }


    public function update(Request $request,)
    {


        $request->validate([
            'title' => 'required',
            'date' => 'required',
            // 'studnet_id' => 'required',
            'teacher_id' => 'required',
            'program_id' => 'required',
            'description' => 'nullable',
            // 'attachment' => 'nullable|max:4000|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'title.required' => 'فیلد عنوان الزامی می باشد',
            'date.required' => 'فلد تاریخ الزامی می باشد',
            // 'studnet_id.required' => 'فیلد نام دانشجو الزامی می باشد',
            'teacher_id.required' => 'فیلد نام استاد الزامی می باشد',
            'program_id.required' => 'فیلد نام برنامه الزامی می باشد',

        ]);

        $user_id = Auth::user()->id;
        $studnet_research = StudentResearch::find($request->id);
        $attachment = $studnet_research->attachment;
        $attachment_path = $studnet_research->attachment_path;
        if ($request->attachment != '') {
            if (is_file(storage_path('app/public/postgraduated/student_research/' . $attachment))) {
                unlink(storage_path('app/public/postgraduated/student_research/' . $attachment));
            }

            $attachment = $request->attachment->store('/', 'postgraduated/student_research');
            $attachment_path = asset(Storage::url('postgraduated/student_research/' . $attachment));
        }

        $studnet_research->title = $request->title;
        $studnet_research->date = $request->date;
        $studnet_research->teacher_id = $request->teacher_id;
        $studnet_research->program_id = $request->program_id;
        $studnet_research->description = $request->description;
        $studnet_research->attachment = $attachment;
        $studnet_research->attachment_path = $attachment_path;
        $studnet_research->user_id = $user_id;
        $result = $studnet_research->save();
        if ($result) {
            return response([
                'message' => 'ویرایش موفقانه انجام شد'
            ], 200);
        } else {
            return response([
                'error' => 'ویرایش موفقانه انجام نشد دوباره تلاش نماید.'
            ], 304);
        }
    }

    public function destroy($id)
    {

        $student_research = StudentResearch::find($id);
        if (is_file(storage_path('app/public/postgraduated/student_research/' . $student_research->attachment))) {
            Storage::delete('app/public/postgraduated/student_research/' .  $student_research->attachment);
        }
        $result = $student_research->delete();
        if ($result) {
            return response([
                'message' => 'حذف موفقانه انجام شد'
            ], 200);
        } else {
            return response([
                'error' => 'حذف موفقانه انجام نشد دوباره تلاش نماید.'
            ], 304);
        }
    }
}
