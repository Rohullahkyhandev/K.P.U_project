<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DepartmentsResource;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{




    public function getFacultyDepartment()
    {
        $id = request('id');
        $per_page = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data =  Department::query()
            ->where('departments.faculty_id', '=', $id)
            ->where('departments.name', 'like', "%{$search}%")
            ->join('faculties', 'departments.faculty_id', 'faculties.id')
            ->join('users', 'departments.user_id', 'users.id')
            ->select('departments.*', 'users.name as uname', 'faculties.name as fname')
            ->orderBy("departments.$sortField", $sortDirection)
            ->paginate($per_page);
        return DepartmentResource::collection($data);
    }

    public function store(Request $request, $id = '')
    {
        $result = 0;
        $request->validate([
            'name' => 'required',
            'date' => 'date',
            'description' => 'required|string',
        ]);

        $user_id = Auth::id();

        $department = new Department();
        $department->name = $request->name;
        $department->description = $request->description;
        $department->date = $request->date;
        $department->faculty_id = $id;
        $department->user_id = $user_id;
        $result = $department->save();
        if ($result) {
            return response([
                'message' => 'موفقانه ذخیره شد'
            ], 200);
        } else {
            return response([
                'message' => 'دیتا ذخیره نشد دوباره تلاش نماید'
            ], 403);
        }
    }

    public function getDepartments($id = '')
    {
        $data = Department::query()
            ->where('departments.faculty_id', '=', $id)
            ->select('departments.name as department_name', 'departments.id as department_id')
            ->get();
        return DepartmentsResource::collection($data);
    }
}
