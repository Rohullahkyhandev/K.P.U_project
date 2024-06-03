<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResearchResource;
use App\Models\StudentResearch;
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
        $program_id = request('program_id');

        $data = StudentResearch::query()
            ->where('student_researchs.title', 'like', "%{$search}%")
            ->orWhere('student_researchs.date', 'like', "%{$search}%")
            ->join('users', 'student_researchs.user_id', 'users.id')
            ->join('students', 'student_researchs.student_id', 'students.id')
            ->join('programs', 'student_researchs.program_id', 'programs.id')
            ->join('teachers', 'student_researchs.teacher_id', 'post_teachers.id')
            ->select('student_researchs.*', 'programs.program_name as program', 'teachers.name as teacher_name', 'teachers.lname as teacher_lname', 'users.name as uname', 'students.name as name', 'students.lname as lname')
            ->where('student_ressearchs.program_id', '=', $program_id)
            ->orderBy("student_researchs.$sortField", $sortDirection)
            ->paginate($per_page);

        return StudentResearchResource::collection($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'studnet_id' => 'required',
            'teacher_id' => 'required',
            'program_id' => 'required',
            'description' => 'nullable',
            'attachments' => 'required|max:4000|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'title.required' => 'فیلد عنوان الزامی می باشد',
            'date.required' => 'فلد تاریخ الزامی می باشد',
            'studnet_id.required' => 'فیلد نام دانشجو الزامی می باشد',
            'teacher_id.required' => 'فیلد نام استاد الزامی می باشد',
            'program_id.required' => 'فیلد نام برنامه الزامی می باشد',
            'attachments.required' => 'فیلد فایل الزامی می باشد',
        ]);

        $user_id = Auth::user()->id;
        $attachments = [];
        $attachment_paths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->attachments as $attachment) {
                $attachment = $attachment->store('/', 'postgraduated/student_research');
                $attachments[] = $attachment;
                $attachment_paths[] = asset(Storage::url('postgraduated/student_research/' . $attachment));
            }
        }

        $studnet_research = new  StudentResearch();
        $studnet_research->title = $request->title;
        $studnet_research->date = $request->date;
        $studnet_research->student_id = $request->studnet_id;
        $studnet_research->teacher_id = $request->teacher_id;
        $studnet_research->program_id = $request->program_id;
        $studnet_research->description = $request->description;
        $studnet_research->attachments = json_encode($attachments);
        $studnet_research->attachment_paths = json_encode($attachment_paths);
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
            'studnet_id' => 'required',
            'teacher_id' => 'required',
            'program_id' => 'required',
            'description' => 'nullable',
            'attachments' => 'required|max:4000|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'title.required' => 'فیلد عنوان الزامی می باشد',
            'date.required' => 'فلد تاریخ الزامی می باشد',
            'studnet_id.required' => 'فیلد نام دانشجو الزامی می باشد',
            'teacher_id.required' => 'فیلد نام استاد الزامی می باشد',
            'program_id.required' => 'فیلد نام برنامه الزامی می باشد',
            'attachments.required' => 'فیلد فایل الزامی می باشد',
        ]);

        $user_id = Auth::user()->id;
        $studnet_research = StudentResearch::find($request->studnet_id);
        $attachments[] = $studnet_research->attachments;
        $attachment_paths[] = $studnet_research->attachment_paths;
        if ($request->hasFile('attachment')) {
            foreach ($attachments as $attachment) {
                if (is_file(storage_path('app/public/postgraduated/student_research/' . $attachment))) {
                    Storage::delete('app/public/postgraduated/student_research/' . $attachment);
                }
            }

            foreach ($request->attachments as $attachment) {
                $attachment = $attachment->store('/', 'postgraduated/student_research');
                $attachments[] = $attachment;
                $attachment_paths[] = asset(Storage::url('postgraduated/student_research/' . $attachment));
            }
        }

        $studnet_research->title = $request->title;
        $studnet_research->date = $request->date;
        $studnet_research->student_id = $request->studnet_id;
        $studnet_research->teacher_id = $request->teacher_id;
        $studnet_research->program_id = $request->program_id;
        $studnet_research->description = $request->description;
        $studnet_research->attachments = json_encode($attachments);
        $studnet_research->attachment_paths = json_encode($attachment_paths);
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

        $studnet_research = StudentResearch::find($id);
        foreach ($studnet_research->attachments as $attachment) {
            if (is_file(storage_path('app/public/postgraduated/student_research/' . $attachment))) {
                Storage::delete('app/public/postgraduated/student_research/' . $attachment);
            }
        }

        $result = StudentResearch::destroy($id);
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
