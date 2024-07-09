<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{



    public function index()
    {
        $per_page = request('per_page', 10);
        $search = request('search', '');
        $sortDirection = request('sortDirection', 'DESC');
        $sortField = request('sortField', 'id');
        $program_id = request('program_id', '');

        $data  = Employee::query()
            ->where('program_id', 'like', "%{$program_id}%")
            ->whereAny([
                'employees.name',
                'employees.lname',
                'employees.fname',
                'employees.email',
                'employees.phone'
            ], 'LIKE', "%{$search}%")
            ->join('post_graduated_programs', 'employees.program_id ', ' post_graduated_programs.id')
            ->join('users', 'employees.user_id', 'users.id')
            ->select('employees.*', 'post_graduated_programs.program_name as program_name', 'users.name as uname')
            ->orderBy("employees.$sortField", $sortDirection)
            ->paginate($per_page);
        return EmployeeResource::collection($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'fname ' => 'required|max:100',
            'lname' => 'required|max:100',
            'email' => 'nullable|max:100|email|unique:employees',
            'salary' => 'required',
            'current_place' => 'required',
            'main_place' => 'required',
            'nic' => 'required|max:13|min:13',
            'position' => 'required|max:100',
            'hire_date' => 'required|date|max:100',
            'program_id' => 'required',
        ]);

        $user_id = Auth::id();
        $employee = new Employee();
        $employee->name =  $request->name;
        $employee->lname =  $request->lname;
        $employee->fname =  $request->fname;
        $employee->email =  $request->email;
        $employee->phone =  $request->phone;
        $employee->salary =  $request->salary;
        $employee->postion =  $request->postion;
        $employee->program_id =  $request->program_id;
        $employee->current_place =  $request->current_place;
        $employee->main_place =  $request->main_place;
        $employee->nic =  $request->nic;
        $employee->user_id =  $user_id;
        $result = $employee->save();

        if ($result) {
            return response([
                'message', 'اطلاعات موفقانه راجستر گردید'
            ], 200);
        } else {
            return response([
                'error', 'اطلاعات موفقانه راجستر نگردید دوباره تلاش نماید'
            ], 204);
        }
    }

    public function edit($id)
    {
        return Employee::find($id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'fname ' => 'required|max:100',
            'lname' => 'required|max:100',
            'email' => 'nullable|max:100|email|unique:employees',
            'salary' => 'required',
            'current_place' => 'required',
            'main_place' => 'required',
            'nic' => 'required|max:13|min:13',
            'position' => 'required|max:100',
            'hire_date' => 'required|date|max:100',
            'program_id' => 'required',
        ]);

        $user_id = Auth::id();
        $employee = Employee::find($request->id);
        $employee->name =  $request->name;
        $employee->lname =  $request->lname;
        $employee->fname =  $request->fname;
        $employee->email =  $request->email;
        $employee->phone =  $request->phone;
        $employee->salary =  $request->salary;
        $employee->postion =  $request->postion;
        $employee->program_id =  $request->program_id;
        $employee->current_place =  $request->current_place;
        $employee->main_place =  $request->main_place;
        $employee->nic =  $request->nic;
        $employee->user_id =  $user_id;
        $result = $employee->save();

        if ($result) {
            return response([
                'message', 'اطلاعات موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response([
                'error', 'اطلاعات موفقانه ویرایش نگردید دوباره تلاش نماید'
            ], 204);
        }
    }



    public function destory($id)
    {
        $result = Employee::destory($id);
        return $result;
    }
}
