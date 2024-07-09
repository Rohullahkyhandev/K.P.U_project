<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostTeacherResource;
use App\Models\PostTeacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{

    public function index()
    {
        $per_page = request('perPage', 10);
        $department_id = request('department_id');
        $search = request('search', '');
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data = PostTeacher::query()
            ->distinct()
            ->where('teachers.name', 'like', "%{$search}%")
            ->where('teachers.department_id', '=', $department_id)
            ->orWhere('teachers.lname', 'like', "%{$search}%")
            ->join('departments', 'teachers.department_id', 'departments.id')
            ->join('users', 'teachers.user_id', 'users.id')
            ->leftJoin('promotions', 'promotions.teacher_id', 'teachers.id')
            ->leftJoin('teacher_qualifications', 'teachers.id', 'teacher_qualifications.teacher_id')
            ->join('faculties', 'teachers.faculty_id', 'faculties.id')
            ->select('teachers.*', 'promotions.date as date', 'promotions.attachment_path as attachment_path', 'promotions.last_academic_rank as last_rank', 'promotions.now_academic_rank as now_rank', 'faculties.name as faculty', 'departments.name as department', 'teacher_qualifications.education_ as education', 'users.name as uname')
            ->orderBy("teachers.$sortField", $sortDirection)
            ->paginate($per_page);
        return PostTeacherResource::collection($data);
    }



    public function store(Request $request)
    {
        $rules = $this->validation();
        Validator::make($request->all(), $rules)->validate();

        DB::beginTransaction();
        try {
            $photo = null;
            $photo_path = null;
            if ($request->photo != '') {
                $photo = $request->photo->store('/', 'teacher_photo');
                $photo_path = asset(Storage::url('teacher_photo/' . $photo));
            }
            $user_id = Auth::id();
            $teacher = new PostTeacher();
            $teacher->code_bast  = $request->code_bast;
            $teacher->name  = $request->name;
            $teacher->lname = $request->lname;
            $teacher->fatherName = $request->fatherName;
            $teacher->grandFathername = $request->grandFathername;
            $teacher->email = $request->email;
            $teacher->phone = $request->phone;
            $teacher->gender = $request->gender;
            $teacher->main_address = $request->main_address;
            $teacher->current_address = $request->current_address;
            $teacher->birth_date = $request->birth_date;
            $teacher->academic_rank = $request->academic_rank;
            $teacher->hire_date = $request->hire_date;
            $teacher->nic = $request->nic;
            $teacher->education_field = $request->education_field;
            $teacher->photo = $photo;
            $teacher->photo_path = $photo_path;
            $teacher->department_id = $request->department_id;
            $teacher->user_id = $user_id;
            $teacher->faculty_id = $request->faculty_id;
            $result = $teacher->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
        if ($result) {
            return response([
                'message' => 'درخواست موفقانه انجام شد'
            ]);
        }
    }



    public function edit($id = '')
    {
        $data = PostTeacher::find($id);
        return $data;
    }


    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->id;
            $teacher = PostTeacher::find($id);
            $photo = null;
            $photo_path = null;
            if ($request->photo != '') {
                if (is_file(storage_path('app/public/teacher_photo/' . $request->photo))) {
                    unlink(storage_path('app/public/teacher_photo/' . $photo));
                }
                $photo = $request->photo->store('/', 'teacher_photo');
                $photo_path = asset(Storage::url('teacher_photo/' . $photo));
            }
            $user_id = Auth::id();
            $teacher->code_bast  = $request->code_bast;
            $teacher->name  = $request->name;
            $teacher->lname = $request->lname;
            $teacher->fatherName = $request->fatherName;
            $teacher->grandFathername = $request->grandFathername;
            $teacher->email = $request->email;
            $teacher->phone = $request->phone;
            $teacher->gender = $request->gender;
            $teacher->main_address = $request->main_address;
            $teacher->current_address = $request->current_address;
            $teacher->birth_date = $request->birth_date;
            $teacher->academic_rank = $request->academic_rank;
            $teacher->hire_date = $request->hire_date;
            $teacher->nic = $request->nic;
            $teacher->education_field = $request->education_field;
            $teacher->photo = $photo;
            $teacher->photo_path = $photo_path;
            $teacher->department_id = $request->department_id;
            $teacher->user_id = $user_id;
            $teacher->faculty_id = $request->faculty_id;
            $result = $teacher->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
        if ($result) {
            return response([
                'message' => 'اطلاعات  موفقانه ویرایش  شد'
            ]);
        } else {
            return response([
                'message' => ' دوباره تلاش نماید,اطلاعات موفقانه ویرایش نشد'
            ]);
        }
    }


    // just destory teacher information
    public function destory($id = '')
    {
        $teacher = PostTeacher::find($id);
        if (is_file(storage_path('app/public/teacher_photo/' . $teacher->photo))) {
            unlink(storage_path('app/public/teacher_photo/' . $teacher->photo));
        }
        $result =  PostTeacher::destroy($id);
        return $result;
    }
}
