<?php

namespace App\Http\Controllers\researchDepartment;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurriculumResource;
use App\Models\Curriculum;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurriculumController extends Controller
{



    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sort_field', 'id');
        $sortDirection = request('sort_direction', 'DESC');

        $data = Curriculum::query()
            ->where('curricula.subject_name', 'like', "%{$search}%")
            ->orWhere('curricula.subject_code', 'like', "%{$search}%")
            ->orWhere('curricula.subject_type', 'like', "%{$search}%")
            ->join('users', 'curricula.user_id', 'users.id')
            // ->join('departments', 'departments.id', 'departments.id')
            ->select('curricula.*', 'users.name as uname')
            ->orderBy("curricula.$sortField", $sortDirection)
            ->paginate($per_page);
        return CurriculumResource::collection($data);
    }


    public function getAllDepartments()
    {
        $data  = Department::all();
        return $data;
    }


    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required',
            'subject_code' => 'required|unique:curricula',
            'subject_type' => 'required',
            'departments.*' => 'required',
            'semester' => 'required',
        ], [
            'subject_name.required' => 'فلید نام الزامی می باشد',
            'subject_code.required' => 'فلید کد الزامی می باشد',
            'subject_type.required' => 'فلید نوع الزامی می با��د',
            'user_id.required' => 'فلید کاربر الزامی می باشد',
            'departments.required' => 'فلید دانشکده الزامی می باشد',
            'semster.required' => 'فلید سیمستر الزامی می باشد',
        ]);

        $user_id = Auth::user()->id;
        $curriculum = new Curriculum();
        $curriculum->subject_name = $request->subject_name;
        $curriculum->subject_code = $request->subject_code;
        $curriculum->subject_type = $request->subject_type;
        $curriculum->subject_credit = $request->subject_credit;
        $curriculum->user_id = $user_id;
        $curriculum->departments = $request->departments;
        $curriculum->semester = $request->semester;
        $result  = $curriculum->save();

        if ($result) {
            return response()->json([
                'message' => 'اطلاعات با موفقیت ��خیره شد'
            ]);
        } else {
            return response()->json([
                'message' => 'اطلاعات ��خیره نشد دوباره تلاش کنید'
            ]);
        }
    }

    public function edit($id)
    {
        return Curriculum::find($id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'subject_name' => 'required',
            'subject_code' => 'required',
            'subject_type' => 'required',
            'user_id' => 'required',
            'department.*' => 'required',
        ], [
            'subject_name.required' => 'فلید نام الزامی می باشد',
            'subject_code.required' => 'فلید کد الزامی می باشد',
            'subject_type.required' => 'فلید نوع الزامی می با��د',
            'user_id.required' => 'فلید کاربر الزامی می باشد',
            'department.required' => 'فلید دانشکده الزامی می باشد',
        ]);

        $user_id = Auth::user()->id;
        $curriculum = Curriculum::find($request->id);
        $curriculum->subject_name = $request->subject_name;
        $curriculum->subject_code = $request->subject_code;
        $curriculum->subject_type = $request->subject_type;
        $curriculum->user_id = $user_id;
        $curriculum->semester = $request->semester;
        $curriculum->departments = $request->departments;
        $result  = $curriculum->save();

        if ($result) {
            return response()->json([
                'message' => 'اطلاعات با موفقیت ��خیره شد'
            ]);
        } else {
            return response()->json([
                'message' => 'اطلاعات ��خیره نشد دوباره تلاش کنید'
            ]);
        }
    }


    public function destroy($id)
    {
        $result = Curriculum::destroy($id);
        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه حذف گردید'
            ]);
        } else {
            return response([
                'message' => 'اطلاعات موفقانه حذف نشد دوباره تلاش کنید'
            ]);
        }
    }
}
