<?php

namespace App\Http\Controllers\PDC;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkshopResource;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WorkshopController extends Controller
{

    public function index()
    {
        $per_page = request('per_page', 10);
        $search  =  request('search', '');
        $sortField  = request('sortField', 'id');
        $sortDirection  = request('sortDirection', 'DESC');

        $data = Workshop::query()
            ->where('workshops.date', 'like', "%{$search}%")
            ->join('users', 'workshops.user_id', 'users.id')
            ->select('workshops.*', 'users.name as uname')
            ->orderBy("workshops.$sortField", $sortDirection)
            ->paginate($per_page);
        return WorkshopResource::collection($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'topic' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'required',
            'document' => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'topic.required' => "فیلد موضوع  الزامی می باشد",
            'start_time.required' => "فیلد زمان شروع   الزامی می باشد",
            'end_time.required' => "فیلد زمان ختم الزامی می باشد",
            'description.required' => "فیلد توضیحات  الزامی می باشد",
            'document.mimes' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"
        ]);
        $document = null;
        $document_path = null;
        if ($request->document != '') {
            $document = $request->document->store('/', 'pdc/teacher_in_workshop');
            $document_path = asset(Storage::url('pdc/teacher_in_workshop' . $document));
        }
        $user_id = Auth::id();
        $teacher_in_workshop = new Workshop();
        $teacher_in_workshop->topic = $request->topic;
        $teacher_in_workshop->start_time = $request->start_time;
        $teacher_in_workshop->end_time = $request->end_time;
        $teacher_in_workshop->description = $request->description;
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
        $data = Workshop::find($id);
        return $data;
    }

    public function update(Request $request)
    {

        $request->validate([
            'topic' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'required',
            'document' => 'required|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'topic.required' => "فیلد موضوع  الزامی می باشد",
            'start_time.required' => "فیلد زمان شروع   الزامی می باشد",
            'end_time.required' => "فیلد زمان ختم الزامی می باشد",
            'description.required' => "فیلد توضیحات  الزامی می باشد",
            'document' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"
        ]);

        $id = $request->id;
        $teacher_in_workshop =  Workshop::find($id);
        $document = $teacher_in_workshop->document;
        $document_path = $teacher_in_workshop->document_path;
        if ($request->document != '') {
            if (is_file(storage_path('/app/public/teacher_in_workshop/' . $document))) {
                unlink(storage_path('/app/public/teacher_in_workshop/' . $document));
            }
            $document = $request->document->store('/', 'teacher_in_workshop');
            $document_path = asset(Storage::url('teacher_in_workshop/' . $document));
        }
        $user_id = Auth::id();
        $teacher_in_workshop->teacher_id = $request->teacher_id;
        $teacher_in_workshop->workshop_id = $request->workshop;
        $teacher_in_workshop->document = $document;
        $teacher_in_workshop->document_path = $document_path;
        $teacher_in_workshop->user_id = $user_id;
        $result = $teacher_in_workshop->save();

        if ($result) {
            return response([
                'message' => ' موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response([
                'message' => 'پلان  ویرایش نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function destroy($id = '')
    {
        $teacher_in_scholarship = Workshop::find($id);
        if (is_file(storage_path('/app/public/pdc/teacher_in_scholarship/' . $teacher_in_scholarship->document))) {
            unlink(storage_path('/app/public/pdc/teacher_in_scholarship/' . $teacher_in_scholarship->document));
        }
        $result = Workshop::destroy($id);
    }
}
