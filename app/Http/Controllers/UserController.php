<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Http\Resources\UserResource;
use App\Models\Chance_Amiryat;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\permission;
use App\Models\User;
use App\Models\User_Permission;
use App\Models\userpermission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;

class UserController extends Controller
{

    public function validation()
    {
        $rules = [
            'name' => 'required|max:100|string',
            'photo' => 'nullable|image',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|string|confirmed',
            'position' => 'required|string|max:100',
            // 'user_type' => 'required',

        ];

        return $rules;
    }

    public function index()
    {

        $per_page =  request('per_page', 10);
        $sortDirection = request('sortDirection', 'DESC');
        $sortField = request('sortField', 'id');
        $search = request('search', '');
        $data = User::query()
            ->where('users.name', 'like', "%{$search}%")
            ->leftjoin("chance__amiryats", "users.dep_id", "chance__amiryats.id")
            ->leftjoin("faculties", "users.faculty_id", "faculties.id")
            ->leftjoin("departments", "users.department_id", "departments.id")
            ->select("users.*", "chance__amiryats.display_name as dname", 'faculties.name as fname', 'departments.name as department_name')
            ->orderBy("users.$sortField", $sortDirection)
            ->paginate($per_page);

        return UserResource::collection($data);
    }

    // public function create()
    // {
    //     return view('users.create');
    // }

    public function store(Request $request)
    {
        // return $request->all();

        $rules = $this->validation();
        Validator::make($request->all(), $rules)->validate();
        $photo = '';
        $photo_path = '';
        if ($request->photo) {
            $photo = $request->photo->store('/', 'users');
            $photo_path = asset(Storage::url('users/' . $photo));
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->position = $request->position;
        $user->photo = $photo;
        $user->photo_path = $photo_path;
        $user->user_type = $request->user_type;
        if ($request->user_type == 'fifth_department') {
            $chance_department = Chance_Amiryat::find($request->dep_id);
            $user->dep_id = $request->dep_id;
            $user->part_name = $chance_department->name;
        }
        if (
            $request->user_type == 'faculty_user'
        ) {
            $faculty = Faculty::find($request->faculty_id);
            $user->faculty_id = $request->faculty_id;
            $user->part_name = $faculty->name;
        }

        if ($request->user_type == 'department_user') {
            $department = Department::find($request->department_id);
            $user->department_id = $request->department_id;
            $user->part_name = $department->name;
            $user->faculty_id = $request->faculty_id;
            $user->dep_id = null;
        }

        if (
            $request->user_type == 'common_department_user'
        ) {
            $department = Department::find($request->department_id);
            $user->department_id = $request->department_id;
            $user->part_name = $department->name;
        }

        
        $user->password = $request->password;
        $result = $user->save();
        if ($result) {
            return response([
                'message' => 'یوزر موفقانه راجستر گردید'
            ]);
        }
    }

    public function edit($id = '')
    {
        return User::find($id);
    }

    public function getChanceDepartment()
    {
        return Chance_Amiryat::all();
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|max:100|string',
            'photo' => 'nullable|image',
            'email' => 'required|email',
            'password' => 'nullable|min:8|string|confirmed',
            'position' => 'required|string|max:100',
            'user_type' => 'required',
            'faculty_id' => 'nullable',
            'dep_id' => 'nullable',
        ]);

        DB::beginTransaction();
        try {

            $user = User::find($request->id);
            $photo = $user->photo;
            $photo_path = $user->photo_path;
            if ($request->photo != '') {
                if (is_file(storage_path('/app/public/users/' . $user->photo))) {
                    unlink(storage_path('app/public/users/' . $user->photo));
                }
                $photo = $request->photo->store('/', 'users');
                $photo_path = asset(Storage::url('users/' . $photo));
            }
            $password = $user->password;
            if ($request->password != '') {
                $password = bcrypt($request->password);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->position = $request->position;
            $user->photo = $photo;
            $user->password = $password;
            $user->photo_path = $photo_path;
            $user->user_type = $request->user_type;
            if ($request->user_type == 'fifth_department') {
                $chance_department = Chance_Amiryat::find($request->dep_id);
                $user->dep_id = $request->dep_id;
                $user->part_name = $chance_department->name;
                $user->faculty_id = null;
                $user->department_id = null;
            }
            if ($request->user_type == 'faculty_user') {
                $faculty = Faculty::find($request->faculty_id);
                $user->faculty_id = $request->faculty_id;
                $user->part_name = $faculty->name;
                $user->dep_id = null;
                $user->department_id = null;
            }
            if ($request->user_type == 'department_user') {
                $department = Department::find($request->department_id);
                $user->department_id = $request->department_id;
                $user->part_name = $department->name;
                $user->faculty_id = $request->faculty_id;
                $user->dep_id = null;
            }

            if ($request->user_type == 'common_department_user') {
                $department = Department::find($request->department_id);
                $user->department_id = $request->department_id;
                $user->part_name = $department->name;
                $user->faculty_id = null;
                $user->dep_id = null;
            }
            $result = $user->save();

            DB::commit();
        } catch (Exception $e) {
            $result = 0;
            return $e;
            DB::rollBack();
        }
        if ($result) {
            return response()->json([
                'message' => 'یوزر موفقانه ویرایش گردید'
            ]);
        }
    }


    public function storePermission(Request $request)
    {
        $result = 0;
        $request->validate([
            'permission_id' => ['required'],
        ]);
        $check_permission = User_Permission::where('permission_id', '=', $request->permission_id)->where('user_id', '=', $request->user_id)->get()->first();
        if ($check_permission != '') {
            return response([
                'res' => 'صلاحیت  از قبلا وجود دارد'
            ], 200);
        }
        $permission = new  User_Permission();
        $permission->permission_id = $request->permission_id;
        $permission->user_id = $request->user_id;
        $result = $permission->save();
        if ($result) {
            return response([
                'message' => 'درخواست موافقانه انجام شد'
            ], 200);
        } else {
            return response([
                'error' => 'درخواست موافقانه انجام نشد !'
            ], 304);
        }
    }

    ///  list user permission
    public function get_user_permission($user_id = '')
    {
        $permissions = Permission::query()
            ->orderBy('id', 'ASC')
            ->get();

        $result = [];
        foreach ($permissions as $permission) {
            $userPermission = User_Permission::where('permission_id', '=', $permission->id)->where('user_id', '=', $user_id)->orderBy('id', 'ASC')->get()->first();
            if ($userPermission != '') {
                continue;
            }
            $result[] = (object) array('id' => $permission->id, 'name' => $permission->permission_name, 'display_name' => $permission->display_name);
        }


        return $result;
    }

    public function user_permission_list()
    {
        $id = request('id');
        $per_page = request('per_page', 10);
        $permissions =  User_Permission::query()
            ->join('users', 'user__permissions.user_id', '=', 'users.id')
            ->join('permissions', 'user__permissions.permission_id', '=', 'permissions.id')
            ->where('user__permissions.user_id', '=', $id)
            ->select('user__permissions.*', 'users.name as uname', 'permissions.display_name')
            ->paginate($per_page);
        return  PermissionResource::collection($permissions);
    }


    public function delete_permission($id = '')
    {
        $result = User_Permission::where('user_id', '=', $id)->delete();
        return $result;
    }


    public function delete_user($id = '')
    {
        $user = User::find($id);
        $result = User::destroy($id);
        if (is_file(storage_path('/app/public/users/' . $user->photo))) {
            unlink(storage_path('/app/public/users/' . $user->photo));
        }
        return $result;
    }


    public function deletePermission($id = '')
    {
        $result = User_Permission::destroy($id);
        return $result;
    }
}
