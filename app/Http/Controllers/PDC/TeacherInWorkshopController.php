<?php

namespace App\Http\Controllers\PDC;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherInWorkshopResource;
use App\Models\Teacher_in_Workshop;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherInWorkshopController extends Controller
{



    public function index()
    {

        $per_page = request('perPage', 10);
        $search  =  request('search', '');
        $sortField  = request('sortField', 'id');
        $sortDirection  = request('sortDirection', 'DESC');

        $data = Teacher_in_Workshop::query()
            // ->where('teacher_in_workshops.teacher_id', 'like', "%{$search}%")
            // ->orWhere('teacher_in_workshops.workshop_id', 'like', "%{$search}%")
            ->join('workshops', 'teacher_in__workshops.workshop_id', 'workshops.id')
            ->join('departments', 'teacher_in__workshops.department_id', 'departments.id')
            ->leftJoin('faculties', 'teacher_in__workshops.faculty_id', 'faculties.id')
            ->join('teachers', 'teacher_in__workshops.teacher_id', 'teachers.id')
            ->join('users', 'teacher_in__workshops.user_id', 'users.id')
            ->select('teacher_in__workshops.*', 'faculties.name as faculty_name', 'departments.name as department_name', 'users.name as uname', 'teachers.name as name', 'teachers.lname as lname', 'teachers.phone as phone', 'teachers.email as email', 'workshops.topic as topic')
            ->orderBy("teacher_in__workshops.$sortField", $sortDirection)
            ->paginate($per_page);
        return TeacherInWorkshopResource::collection($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required',
            'workshop_id' => 'required',
            'faculty_id' => 'nullable',
            'department_id' => 'required',
            'department_type' => 'required',
            'document' => 'required|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'teacher_id.required' => "فیلد استاد  الزامی می باشد",
            'workshop_id.required' => "فیلد زمان ورکشاپ   الزامی می باشد",
            'document.mimes' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"
        ]);
        $document = null;
        $document_path = null;
        if ($request->document != '') {
            $document = $request->document->store('/', 'pdc/teacher_in_workshop');
            $document_path = asset(Storage::url('pdc/teacher_in_workshop' . $document));
        }
        $user_id = Auth::id();
        $teacher_in_workshop = new Teacher_in_Workshop();
        $teacher_in_workshop->teacher_id = $request->teacher_id;
        $teacher_in_workshop->workshop_id = $request->workshop_id;
        $teacher_in_workshop->faculty_id = $request->faculty_id;
        $teacher_in_workshop->department_id = $request->department_id;
        $teacher_in_workshop->department_type = $request->department_type;
        $teacher_in_workshop->document = $document;
        $teacher_in_workshop->document_path = $document_path;
        $teacher_in_workshop->user_id = $user_id;
        $result = $teacher_in_workshop->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات  موفقانه ذخیره گردید'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات  ذخیره نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function getAllWorkshops()
    {
        $data = Workshop::all();
        return $data;
    }

    public function edit($id = '')
    {
        $data = Teacher_in_Workshop::find($id);
        return $data;
    }

    public function update(Request $request)
    {

        $request->validate([
            'teacher_id' => 'required',
            'workshop_id' => 'required',
            'document' => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'teacher_id.required' => "فیلد استاد  الزامی می باشد",
            'workshop_id.required' => "فیلد زمان ورکشاپ   الزامی می باشد",
            'document.mimes' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"
        ]);

        $id = $request->id;
        $teacher_in_workshop =  Teacher_in_Workshop::find($id);
        $document = $teacher_in_workshop->document;
        $document_path = $teacher_in_workshop->document_path;
        if ($request->document != '') {
            if (is_file(storage_path('/app/public/pdc/teacher_in_workshop/' . $document))) {
                unlink(storage_path('/app/public/pdc/teacher_in_workshop/' . $document));
            }
            $document = $request->document->store('/', 'pdc/teacher_in_workshop');
            $document_path = asset(Storage::url('pdc/teacher_in_workshop/' . $document));
        }
        $user_id = Auth::id();
        $teacher_in_workshop->teacher_id = $request->teacher_id;
        $teacher_in_workshop->workshop_id = $request->workshop_id;
        $teacher_in_workshop->faculty_id = $request->faculty_id;
        $teacher_in_workshop->department_id = $request->department_id;
        $teacher_in_workshop->department_type = $request->department_type;
        $teacher_in_workshop->document = $document;
        $teacher_in_workshop->document_path = $document_path;
        $teacher_in_workshop->user_id = $user_id;
        $result = $teacher_in_workshop->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات  ویرایش نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function destroy($id = '')
    {
        $teacher_in_workshop = Teacher_in_Workshop::find($id);
        if (is_file(storage_path('/app/public/pdc/teacher_in_workshop/' . $teacher_in_workshop->document))) {
            unlink(storage_path('/app/public/pdc/teacher_in_workshop/' . $teacher_in_workshop->document));
        }
        $result = Teacher_in_Workshop::destroy($id);
        return $result;
    }
}
