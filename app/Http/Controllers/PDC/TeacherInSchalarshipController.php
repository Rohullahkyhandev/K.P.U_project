<?php

namespace App\Http\Controllers\PDC;

use App\Exports\TeacherInScholarship;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScholarshipResource;
use App\Http\Resources\TeacherInSchalarshipResource;
use App\Models\Department;
use App\Models\Scholarship;
use App\Models\Teacher;
use App\Models\Teacher_in_Scholarship;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Excel;

class TeacherInSchalarshipController extends Controller
{


    /*
     # --------------------------------
        if teacher status be 1 is teaching
        if teacher status be 2 is in scholarship
        if teacher status be 3  come back
        if teacher status be 4 is retaired
     #
    */
    public function index()
    {
        $per_page = request('perPage', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $search = request('search', '');

        $data = Scholarship::query()
            ->where('scholarships.country_name', 'like', "%{$search}%")
            ->orWhere('scholarships.edu_degree', 'like', "%{$search}%")
            ->orWhere('scholarships.sent_date', 'like', "%{$search}%")
            ->join('users', 'scholarships.user_id', 'users.id')
            ->join('teachers', 'scholarships.teacher_id', 'teachers.id')
            ->join('faculties', 'scholarships.faculty_id', 'faculties.id')
            ->join('departments', 'scholarships.department_id', 'departments.id')
            ->select("scholarships.*", "users.name as uname ", 'faculties.name as faculty', 'faculties.id as faculty_id', 'departments.name as department', 'teachers.name as name', 'teachers.lname as lname', 'teachers.email as email')
            ->orderBy("scholarships.$sortField", $sortDirection)
            ->paginate($per_page);

        return ScholarshipResource::collection($data);
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


    public function updateStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $teacher_in_scholarship = Scholarship::find($request->id);
            $teacher_in_scholarship->back_date = $request->back_date;
            $teacher_in_scholarship->status = '2';
            $teacher_in_scholarship->save();
            $teacher = Teacher::find($teacher_in_scholarship->id);
            $teacher->status = '1';
            $result = $teacher->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $result = $e;
        }
        if ($result) {
            return response([
                'message' => 'موفقانه دیتا ویرایش گردید'
            ], 200);
        } else {
            return response([
                'error' => 'موفقانه دیتا ویرایش نشد دوباره تلاش نماید'
            ], 403);
        }
    }


    public function store(Request $request)
    {

        $request->validate([
            "country_name" => 'required',
            // "edu_degree" => 'required',
            "edu_maqta" => 'required',
            "sent_date" => 'required',
            "back_date" => 'nullable',
            "faculty_id" => 'nullable',
            "department_id" => 'required',
            "teacher_id" => 'required',
            "document" => 'required|mimes:png,jpg,mp3,mp4,pdf,docx',
        ], [
            'country_name.required' => 'فلید کشور مقصد الزامی می باشد',
            // 'edu_degree.required' => 'فلید درجه تحصیل الزامی می باشد',
            'edu_maqta.required' => 'فلید مقطع تحصیلی  الزامی می باشد',
            'sent_date.required' => 'فلید درجه تحصیل الزامی می باشد',
            'back_date.nullable' => 'فلید  تاریخ برگشت الزامی می باشد',
            'faculty_id.required' => 'فلید درجه فاکولته الزامی می باشد',
            'department_id.required' => 'فلید درجه دیپارتمنت الزامی می باشد',
            'teacher_id.required' => 'فلید نام استاد  الزامی می باشد',
            'document.mimes' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"
        ]);
        // return $request->edu_degree;


        DB::beginTransaction();
        try {

            $attachment = null;
            $attachment_path = null;

            if ($request->document != '') {
                $attachment = $request->document->store('', 'pdc/teacher_in_scholarship' . $attachment);
                $attachment_path = asset(Storage::url('/pdc/teacher_in_scholarship/' . $attachment));
            }
            // change the teacher status
            $teacher =  Teacher::find($request->teacher_id);
            $teacher->status = '2';
            $user_id = Auth::id();
            $teacher_in_scholarship = new Scholarship();
            $teacher_in_scholarship->country_name = $request->country_name;
            $teacher_in_scholarship->edu_degree = $request->edu_degree;
            $teacher_in_scholarship->sent_date = $request->sent_date;
            $teacher_in_scholarship->back_date = $request->back_date;
            $teacher_in_scholarship->edu_maqta = $request->edu_maqta;
            $teacher_in_scholarship->faculty_id = $request->faculty_id;
            $teacher_in_scholarship->department_id = $request->department_id;
            $teacher_in_scholarship->teacher_id = $request->teacher_id;
            $teacher_in_scholarship->documents = $attachment;
            $teacher_in_scholarship->document_path = $attachment_path;
            $teacher_in_scholarship->user_id = $user_id;
            $result = $teacher_in_scholarship->save();
            $teacher->save();
            DB::commit();
        } catch (Exception $e) {
            $result = $e;
            DB::rollBack();
        }
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
        $data  =  Scholarship::find($id);
        return $data;
    }

    public function update(Request $request)
    {



        $request->validate([
            "country_name" => 'required',
            // "edu_degree" => 'required',
            "edu_maqta" => 'required',
            "sent_date" => 'required',
            "back_date" => 'required',
            "faculty_id" => 'required',
            "department_id" => 'required',
            "teacher_id" => 'required',
            "attachment" => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx"',

        ], [
            'country_name.required' => 'فلد کشور مقصد الزامی می باشد',
            // 'edu_degree.required' => 'فلد درجه تحصیل الزامی می باشد',
            'edu_maqta.required' => 'فلد مقطع تحصیلی  الزامی می باشد',
            'sent_date.required' => 'فلد تاریخ رفت الزامی می باشد',
            'back_date.required' => 'فلد  تاریخ برگشت الزامی می باشد',
            'faculty_id.required' => 'فلد درجه فاکولته الزامی می باشد',
            'department_id.required' => 'فلد درجه دیپارتمنت الزامی می باشد',
            'teacher_id.required' => 'فلد نام استاد  الزامی می باشد',
            'attachment' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"

        ]);

        $id = $request->id;
        $teacher_in_scholaship = Scholarship::find($id);
        $attachment = $teacher_in_scholaship->documents;
        $attachment_path = $teacher_in_scholaship->document_path;
        if ($request->attachment != '') {
            if (is_file(storage_path('app/public/pdc/teacher_in_scholarship/' . $teacher_in_scholaship->attachment))) {
                unlink(storage_path('app/public/pdc/teacher_in_scholarship/' . $teacher_in_scholaship->attachment));
            }
            $attachment = $request->attachment->store('/', 'pdc/teacher_in_scholarship');
            $attachment_path = asset(Storage::url('pdc/teacher_in_scholarship/' . $attachment));
        }
        $user_id = Auth::id();

        $teacher_in_scholaship->country_name = $request->country_name;
        $teacher_in_scholaship->edu_degree = $request->edu_degree;
        $teacher_in_scholaship->sent_date = $request->sent_date;
        $teacher_in_scholaship->back_date = $request->back_date;
        $teacher_in_scholaship->edu_maqta = $request->edu_maqta;
        $teacher_in_scholaship->faculty_id = $request->faculty_id;
        $teacher_in_scholaship->department_id = $request->department_id;
        $teacher_in_scholaship->teacher_id = $request->teacher_id;
        $teacher_in_scholaship->documents = $attachment;
        $teacher_in_scholaship->document_path = $attachment_path;
        $teacher_in_scholaship->user_id = $user_id;
        $result = $teacher_in_scholaship->save();

        if ($result) {
            return response([
                'message' => 'دیتا   موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response([
                'message' => 'دیتا    ویرایش نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function destroy($id = '')
    {
        $teacher_in_scholarship = Scholarship::find($id);
        if (is_file(storage_path('/app/public/pdc/teacher_in_scholarship/' . $teacher_in_scholarship->attachment_path))) {
            unlink(storage_path('/app/public/pdc/teacher_in_scholarship/' . $teacher_in_scholarship->attachment_path));
        }
        $result = Scholarship::destroy($id);
        return $result;
    }


    // count the teacher in overs year receive  scholarships
    public function getTeacherInScholarship($year)
    {
        $year = '1403';
        $from_year = '1400';
        $master = Scholarship::between('sent_date', 'like', "%{$year}%")->where('edu_maqta', 'ماستر')->get()->count();
        $doctor = Scholarship::where('sent_date', 'like', "%{$year}%")->where('edu_maqta', 'دوکتورا')->get()->count();
        return [
            'ماستر' => $master,
            'داکتر' => $doctor,
            'year' => $year,
        ];
    }

    public function generateReport($format_type, $year)
    {
        return  Excel::download((new TeacherInScholarship)->getData($year), "teacher in scholarship.$format_type");
    }
}
