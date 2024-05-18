<?php

namespace App\Http\Controllers\PDC;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherInSchalarshipResource;
use App\Models\Department;
use App\Models\Teacher_in_Scholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherInSchalarshipController extends Controller
{

    public function index()
    {
        $per_page = request('perPage', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $search = request('search', '');

        $data = Teacher_in_Scholarship::query()
            ->where('teacher_in__scholarships.name', 'like', "%{$search}%")
            ->orWhere('teacher_in__scholarships.lname', 'like', "%{$search}%")
            ->orWhere('teacher_in__scholarships.send_date', 'like', "%{$search}%")
            ->join('users', 'teacher_in__scholarships.user_id', 'users.id')
            ->join('teachers', 'teacher_in__scholarships.teacher_id', 'teachers.id')
            ->join('faculties', 'teacher_in_scholarships.faculty_id', 'faculties.id')
            ->join('departments', 'teacher_in_scholarships.department_id', 'departments.id')
            ->select("teacher_in_scholarships.*", 'faculties.name as fname', 'departments.name as dname', 'teachers.name as tanme', 'teachers.lname as lname', 'teachers.email as email')
            ->orderBy("teacher_in_scholaships.$sortField", $sortDirection)
            ->paginate($per_page);

        return TeacherInSchalarshipResource::collection($data);
    }


    // get all the commits

    public function getCommit()
    {
        $data = Teacher_in_Scholarship::all();
        return $data;
    }

    // get departments or will call in the fontend route of that give all the departments
    public function getDepartments()
    {
        $data = Department::all();
        return $data;
    }


    public function store(Request $request)
    {

        $request->validate([
            "country_name" => 'required',
            "edu_degree" => 'required',
            "edu_maqta" => 'required',
            "send_date" => 'required',
            "back_date" => 'required',
            "faculty_id" => 'required',
            "department_id" => 'required',
            "teacher_id" => 'required',
            "attachment" => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx"',

        ], [
            'country_name.required' => 'فلد کشور مقصد الزامی می باشد',
            'edu_degree.required' => 'فلد درجه تحصیل الزامی می باشد',
            'edu_maqta.required' => 'فلد مقطع تحصیلی  الزامی می باشد',
            'send_date.required' => 'فلد درجه تحصیل الزامی می باشد',
            'back_date.required' => 'فلد  تاریخ برگشت الزامی می باشد',
            'faculty_id.required' => 'فلد درجه فاکولته الزامی می باشد',
            'department_id.required' => 'فلد درجه دیپارتمنت الزامی می باشد',
            'teacher_id.required' => 'فلد نام استاد  الزامی می باشد',
            'attachment' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"

        ]);

        $attachment = null;
        $attachment_path = null;

        if ($request->attachment != '') {
            $attachment = $request->attachment->store('', 'pdc/teacher_in_scholarship' . $attachment);
            $attachment_path = asset(Storage::url('/pdc/teacher_in_scholarship/' . $attachment));
        }

        $user_id = Auth::id();
        $teacher_in_scholarship = new Teacher_in_Scholarship();
        $teacher_in_scholarship->country_name = $request->country_name;
        $teacher_in_scholarship->edu_degree = $request->edu_degree;
        $teacher_in_scholarship->send_date = $request->send_date;
        $teacher_in_scholarship->back_date = $request->back_date;
        $teacher_in_scholarship->edu_maqta = $request->edu_maqta;
        $teacher_in_scholarship->faculty_id = $request->faculty_id;
        $teacher_in_scholarship->department_id = $request->department_id;
        $teacher_in_scholarship->teacher_id = $request->teacher_id;
        $teacher_in_scholarship->attachment = $attachment;
        $teacher_in_scholarship->attachment_path = $attachment_path;
        $teacher_in_scholarship->user_id = $user_id;
        $result = $teacher_in_scholarship->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه راچستر گردید '
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات موفقانه راجستر نشد دوباره تلاش نماید'
            ], 403);
        }
    }

    public function edit($id = '')
    {
        $data  =  Teacher_in_Scholarship::find($id);
        return $data;
    }

    public function update(Request $request)
    {

        $request->validate([
            "country_name" => 'required',
            "edu_degree" => 'required',
            "edu_maqta" => 'required',
            "send_date" => 'required',
            "back_date" => 'required',
            "faculty_id" => 'required',
            "department_id" => 'required',
            "teacher_id" => 'required',
            "attachment" => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx"',

        ], [
            'country_name.required' => 'فلد کشور مقصد الزامی می باشد',
            'edu_degree.required' => 'فلد درجه تحصیل الزامی می باشد',
            'edu_maqta.required' => 'فلد مقطع تحصیلی  الزامی می باشد',
            'send_date.required' => 'فلد درجه تحصیل الزامی می باشد',
            'back_date.required' => 'فلد  تاریخ برگشت الزامی می باشد',
            'faculty_id.required' => 'فلد درجه فاکولته الزامی می باشد',
            'department_id.required' => 'فلد درجه دیپارتمنت الزامی می باشد',
            'teacher_id.required' => 'فلد نام استاد  الزامی می باشد',
            'attachment' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"

        ]);

        $id = $request->id;
        $teacher_in_scholaship = Teacher_in_Scholarship::find($id);
        $attachment = $teacher_in_scholaship->attachment;
        $attachment_path = $teacher_in_scholaship->attachment_path;
        if ($request->attachment != '') {
            if (is_file(storage_path('app/public/pdc/teacher_in_scholarship/' . $teacher_in_scholaship->attachment))) {
                unlink(storage_path('app/public/pdc/teacher_in_scholarship/' . $teacher_in_scholaship->attachment));
            }
            $attachment = $request->attachment->store('/', 'pdc/teacher_in_scholarship');
            $attachment_path = asset(Storage::url('pdc/teacher_in_scholarship/' . $attachment));
        }
        $user_id = Auth::id();

        $teacher_in_scholaship->teacher_id = $request->teacher_id;
        $teacher_in_scholaship->commit_id = $request->commit_id;
        $teacher_in_scholaship->attachment = $attachment;
        $teacher_in_scholaship->attachment_path = $attachment_path;
        $teacher_in_scholaship->user_id = $user_id;
        $result = $teacher_in_scholaship->save();

        if ($result) {
            return response([
                'message' => 'دیتا در آرشیف موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response([
                'message' => 'دیتا در آرشیف  ویرایش نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function destroy($id = '')
    {
        $teacher_in_scholarship = Teacher_in_Scholarship::find($id);
        if (is_file(storage_path('/app/public/pdc/teacher_in_scholarship/' . $teacher_in_scholarship->attachment_path))) {
            unlink(storage_path('/app/public/pdc/teacher_in_scholarship/' . $teacher_in_scholarship->attachment_path));
        }
        $result = Teacher_in_Scholarship::destroy($id);
        return $result;
    }
}
