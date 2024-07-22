<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{


    public function index()
    {
        $per_page = request('per_page', 10);
        $search = request('search', '');
        $sortDirection = request('sortDirection', 'DESC');
        $sortField = request('sortField', 'id');
        $user_id = Auth::id();
        $data  = Employee::query()
            ->where('employees.user_id', '=', $user_id)
            ->whereAny([
                'employees.name',
                'employees.lname',
                'employees.fname',
                'employees.email',
                'employees.phone'
        ], 'LIKE', "%{$search}%")
            ->join('users', 'employees.user_id', 'users.id')
            ->select('employees.*', 'users.name as uname', 'users.part_name as part_name')
            ->orderBy("employees.$sortField", $sortDirection)
            ->paginate($per_page);
        return EmployeeResource::collection($data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:100', 'fname' => 'required|max:100',
            'lname' => 'required|max:100', 'email' => 'nullable|max:100|email|unique:employees', 'phone' => 'required|max:14|email|unique:employees',
            'salary' => 'required', 'current_address' => 'required',
            'nic' => 'required|max:13|min:13', 'position' => 'required|max:100', 'date_of_birth' => 'required|date|max:100',
            'gender' => 'required',
            'current_address' => 'required',
            'main_address' => 'required',
            'date_of_birth' => 'required|date|max:100',
            'phone' => 'required|max:14',
            'hire_date' => 'required|date|max:100', 'position' => 'required',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif'
        ], [
            'name.required' => 'فلید نام الزامی می باشد',
            // 'fname.required' => 'فلید نام پدر الزامی می باشد',
            'lname.required' => 'فلید تخلص الزامی می باشد',
            'email.required' => 'فلید ادرس ایمیل الزامی می باشد',
            'salary.required' => 'فلید معاش الزامی می باشد',
            'gender.required' => 'فلید جنسیت الزامی می باشد',
            'main_address.required' => 'فلید  ادرس اصلی می باشد',
            'current_address.required' => 'فلید ادرس فعلی الزامی می باشد',
            'gender.required' => 'فلید جنسیت الزامی می باشد',
            // 'nic.required' => 'فلید نمبر تذکره الزامی می باشد',
            'phone.required' => 'فلید شماره تماس الزامی می باشد',
            'hire_date.required' => 'فلید تاریخ استخدام الزامی می باشد',
            'date_of_birth.required' => 'فلید تولد الزامی می باشد',
            'position.required' => 'فلید سیمت کاری الزامی می باشد',
            'email.unique' => 'ادرس ایمیل از قبلا در سیستم موجود است',
            'email.unique' => ' شماره  از قبلا در سیستم موجود است',
            'photo.mimes' => 'فارمت عکس باید شامل این ها باشد:jpg,png,jpg,gif',

        ]);

        $photo = null;
        $photo_path = null;
        if ($request->photo != null) {
            $photo = $request->photo->store('/', 'employee/photo');
            $photo_path = asset(Storage::url('employee/photo/' . $photo));
        }

        $user_id = Auth::id();
        $employee = new Employee();
        $employee->name =  $request->name;
        $employee->lname =  $request->lname;
        $employee->fname =  $request->fname;
        $employee->email =  $request->email;
        $employee->phone =  $request->phone;
        $employee->salary =  $request->salary;
        $employee->position =  $request->position;
        $employee->hire_date =  $request->hire_date;
        $employee->gender =  $request->gender;
        $employee->date_of_birth =  $request->date_of_birth;
        $employee->main_address =  $request->main_address;
        $employee->current_address =  $request->current_address;
        $employee->nic =  $request->nic;
        $employee->photo =  $photo;
        $employee->photo_path =  $photo_path;
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
            // 'fname ' => 'required|max:100',
            'lname' => 'required|max:100', 'email' => 'nullable|max:100|email',
            'phone' => 'required|max:14',
            'salary' => 'required', 'current_address' => 'required',
            'nic' => 'required|max:13|min:13', 'position' => 'required|max:100', 'date_of_birth' => 'required|date|max:100',
            'gender' => 'required',
            'current_address' => 'required',
            'main_address' => 'required',
            'date_of_birth' => 'required|date|max:100',
            'phone' => 'required|max:14',
            'hire_date' => 'required|date|max:100', 'position' => 'required',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif'
        ], [
            'name.required' => 'فلید نام الزامی می باشد',
            // 'fname.required' => 'فلید نام پدر الزامی می باشد',
            'lname.required' => 'فلید تخلص الزامی می باشد',
            'email.required' => 'فلید ادرس ایمیل الزامی می باشد',
            'salary.required' => 'فلید معاش الزامی می باشد',
            'gender.required' => 'فلید جنسیت الزامی می باشد',
            'main_address.required' => 'فلید  ادرس اصلی می باشد',
            'current_address.required' => 'فلید ادرس فعلی الزامی می باشد',
            'gender.required' => 'فلید جنسیت الزامی می باشد',
            'nic.required' => 'فلید نمبر تذکره الزامی می باشد',
            'phone.required' => 'فلید شماره تماس الزامی می باشد',
            'hire_date.required' => 'فلید تاریخ استخدام الزامی می باشد',
            'date_of_birth.required' => 'فلید تولد الزامی می باشد',
            'position.required' => 'فلید سیمت کاری الزامی می باشد',
            'email.unique' => 'ادرس ایمیل از قبلا در سیستم موجود است',
            'email.unique' => ' شماره  از قبلا در سیستم موجود است',
            'photo.mimes' => 'فارمت عکس باید شامل این ها باشد:jpg,png,jpg,gif',
        ]);

        $user_id = Auth::id();
        $employee = Employee::find($request->id);
        $photo = $employee->photo;
        $photo_path = $employee->photo_path;

        if ($request->photo != null) {
            if (is_file(storage_path('app/public/employee/photo/' . $photo))) {
                unlink(storage_path('app/public/employee/photo/' . $photo));
            }

            $photo = $request->photo->store('/', 'employee/photo');
            $photo_path = asset(Storage::url('employee/photo/' . $photo));
        }

        $employee->name =  $request->name;
        $employee->lname =  $request->lname;
        $employee->fname =  $request->fname;
        $employee->email =  $request->email;
        $employee->phone =  $request->phone;
        $employee->salary =  $request->salary;
        $employee->position =  $request->position;
        $employee->hire_date =  $request->hire_date;
        $employee->gender =  $request->gender;
        $employee->date_of_birth =  $request->date_of_birth;
        $employee->main_address =  $request->main_address;
        $employee->current_address =  $request->current_address;
        $employee->nic =  $request->nic;
        $employee->photo =  $photo;
        $employee->photo_path =  $photo_path;
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



    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (is_file(storage_path('app/public/employee/photo/' . $employee->photo))) {
            unlink(storage_path('app/public/employee/photo/' . $employee->photo));
        }
        $result = $employee->delete();
        return $result;
    }
}
