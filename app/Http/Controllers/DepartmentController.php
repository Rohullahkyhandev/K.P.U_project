<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DepartmentsResource;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\CssSelector\Node\FunctionNode;

use function Laravel\Prompts\select;

class DepartmentController extends Controller
{

    public function getFacultyDepartment()
    {
        // $id = request('id');
        $per_page = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $id = request('id');

        if ($id) {
            $data =  Department::query()
                ->where('departments.faculty_id', '=', $id)
                ->whereAny([
                    'departments.name',
                ], 'like', "%{$search}%")
                ->join('faculties', 'departments.faculty_id', 'faculties.id')
                ->select('departments.*', 'faculties.name as fname')
                ->orderBy("departments.$sortField", $sortDirection)
                ->paginate($per_page);
            return DepartmentResource::collection($data);
        }

        $data =  Department::query()
            ->where('departments.name', 'like', "%{$search}%")
            ->join('faculties', 'departments.faculty_id', 'faculties.id')
            ->select('departments.*', 'faculties.name as fname')
            ->orderBy("departments.$sortField", $sortDirection)
            ->paginate($per_page);
        return DepartmentResource::collection($data);
    }

    public function store(Request $request)
    {

        $result = 0;
        $request->validate([
            'manager_name' => 'required|max:100',
            'manager_lname' => 'required|max:100',
            'photo' => 'required|mimes:png,jpg,jpeg,gif',
            'name' => 'required|max:100',
            'date' => 'required|date|max:100',
            'description' => 'nullable|string',
        ]);

        $user_id = Auth::id();
        $photo = null;
        $photo_path = null;
        if ($request->photo) {
            $photo = $request->photo->store('/', 'department/photo');
            $photo_path = asset(Storage::url('department/photo/' . $photo));
        }

        $department = new Department();
        $department->name = $request->name;
        $department->manager_name = $request->manager_name;
        $department->manager_lname = $request->manager_lname;
        $department->photo = $photo;
        $department->photo_path = $photo_path;
        $department->name = $request->name;
        $department->description = $request->description;
        $department->date = $request->date;
        $department->faculty_id = $request->faculty_id;
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


    public function getAllDepartment()
    {
        return Department::all();
    }


    public function edit($id = '')
    {
        $data = Department::find($id);
        return $data;
    }

    public function update(Request $request)
    {

        $result = 0;
        $request->validate([
            'manager_name' => 'required|max:100',
            'manager_lname' => 'required|max:100',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'name' => 'required',
            'date' => 'date',
            'description' => 'required|string',
            'faculty_id' => 'nullable'
        ]);

        $user_id = Auth::id();
        $department =  Department::find($request->id);
        $photo = $department->photo;
        $photo_path = $department->photo_path;
        if ($request->photo != null) {
            if (is_file(storage_path('app/public/photo/' . $request->photo))) {
                unlink(storage_path('app/public/photo/' . $request->photo));
            }
            $photo = $request->photo->store('/', 'department/photo');
            $photo_path = asset(Storage::url('department/photo/' . $photo));
        }

        $department->name = $request->name;
        $department->manager_name = $request->manager_name;
        $department->manager_lname = $request->manager_lname;
        $department->photo = $photo;
        $department->photo_path = $photo_path;
        $department->name = $request->name;
        $department->description = $request->description;
        $department->date = $request->date;
        if ($department->faculty_id != null) {
            $department->faculty_id = $request->faculty_id;
        }
        $result = $department->save();
        if ($result) {
            return response([
                'message' => 'موفقانه ویرایش  شد '
            ], 200);
        } else {
            return response([
                'message' => 'دیتا ویرایش نشد دوباره تلاش نماید'
            ], 403);
        }
    }

    public function departmentHasOutFaculties()
    {
        $data = Department::query()
            ->select('departments.*', 'departments.id as id', 'departments.name as name')
            ->where('departments.faculty_id', '=', null)
            ->get();
        return $data;
    }


    public function getDepartments()
    {
        $faculty_id = request('id', '');
        $data = Department::query()
            ->where('departments.faculty_id', '=', $faculty_id)
            ->select('departments.*')
            ->get();
        return $data;
    }


    public function destroy($id)
    {
        $department = Department::find($id);
        if (is_file(storage_path('app/public/department/photo/' . $department->photo))) {
            unlink(storage_path('app/public/department/photo/' . $department->photo));
        }

        $result = $department->delete();
        return $result;
    }
}
