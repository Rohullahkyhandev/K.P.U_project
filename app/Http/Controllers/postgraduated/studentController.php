<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\StudentT;

class studentController extends Controller
{

    // =================================================================================================
    //  status number 1 indicates to the not graduation 2 number means graduation
    // =================================================================
    public function index()
    {

        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sort_Field', 'id');
        $sortDirection = request('sort_direction', 'DESC');
        $program_id = request('program_id', '');
        $year = request('year', date('Y') - 621);

        $data = Student::query()
            ->where('students.program_id', '=', $program_id)
            ->where('students.name', 'like', "%{$search}%")
            ->whereDate('students.admission_year', 'like', "%{$year}%")
            // ->where('students.lname', 'like', "%{$search}%")
            // ->where('students.fname', 'like', "%{$search}%")
            ->join("users", "students.user_id", "users.id")
            ->join("post_graduated_programs", "students.program_id", "post_graduated_programs.id")
            ->select("students.*", "post_graduated_programs.program_name as program_name", "users.name as uname")
            ->orderBy("students.$sortField", $sortDirection)
            ->paginate($per_page);

        return StudentResource::collection($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lname' => 'required',
            'fname' => 'required',
            'program_id' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'kankor_id' => 'required',
            'kankor_mark' => 'required',
            'bachelor_field' => 'required',
            'nic' => 'required',
            'address' => 'required',
            'admission_year' => 'required'
        ], [
            'name.required' => 'فلید نام الزامی می باشد',
            'lname.required' => 'فلید تخلص الزامی می باشد',
            'fname.required' => 'فلید نام پدر الزامی می باشد',
            'program_id.required' => 'فلید ریشته تحصلی  الزامی می باشد',
            'email.required' => 'فلید ایمل الزامی می باشد',
            'phone.required' => 'فلید شماره تماس الزامی می باشد',
            'kankor_id.required' => 'فلید آدی کانکور الزامی می باشد',
            'kankor_mark.required' => 'فلید نمره کانکور الزامی می باشد',
            'bachelor_field.required' => 'فلید ریشته تحصیلی دروه لیسانس الزامی می باشد',
            'nic.required' => 'فلید نمر تذکره الزامی می باشد',
            'address.required' => 'فلید آدرس الزامی می باشد',
            'admission_year.required' => 'فلید نام تاریخ ثبت نام می باشد',
        ]);

        $user_id = Auth::user()->id;
        $student = new Student();
        $student->name = $request->name;
        $student->lname = $request->lname;
        $student->fname = $request->fname;
        $student->program_id = $request->program_id;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->kankor_id = $request->kankor_id;
        $student->kankor_mark = $request->kankor_mark;
        $student->bachelor_field = $request->bachelor_field;
        $student->nic = $request->nic;
        $student->blood_group = $request->blood_group;
        $student->status = '1';
        $student->address = $request->address;
        $student->admission_year = $request->admission_year;
        $student->user_id = $user_id;
        $result = $student->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه راجستر گردید'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات موفقانه راجستر  نشد دوباره تلاش نماید'
            ], 200);
        }
    }


    public function edit($id = '')
    {
        $student = Student::find($id);
        return $student;
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'lname' => 'required',
            'fname' => 'required',
            'program_id' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'kankor_id' => 'required',
            'kankor_mark' => 'required',
            'bachelor_field' => 'required',
            'nic' => 'required',
            'address' => 'required',
            'admission_year' => 'required'
        ], [
            'name.required' => 'فلید نام الزامی می باشد',
            'lname.required' => 'فلید تخلص الزامی می باشد',
            'fname.required' => 'فلید نام پدر الزامی می باشد',
            'program_id.required' => 'فلید ریشته تحصلی  الزامی می باشد',
            'email.required' => 'فلید ایمل الزامی می باشد',
            'phone.required' => 'فلید شماره تماس الزامی می باشد',
            'kankor_id.required' => 'فلید آدی کانکور الزامی می باشد',
            'kankor_mark.required' => 'فلید نمره کانکور الزامی می باشد',
            'bachelor_field.required' => 'فلید ریشته تحصیلی دروه لیسانس الزامی می باشد',
            'nic.required' => 'فلید نمر تذکره الزامی می باشد',
            'address.required' => 'فلید آدرس الزامی می باشد',
            'admission_year.required' => 'فلید نام تاریخ ثبت نام می باشد',
        ]);

        $student = Student::find($request->id);
        $user_id = Auth::user()->id;
        $student->name = $request->name;
        $student->lname = $request->lname;
        $student->fname = $request->fname;
        $student->program_id = $request->program_id;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->kankor_id = $request->kankor_id;
        $student->kankor_mark = $request->kankor_mark;
        $student->bachelor_field = $request->bachelor_field;
        $student->nic = $request->nic;
        $student->nic = $request->nic;
        $student->address = $request->address;
        $student->admission_year = $request->admission_year;
        $student->user_id = $user_id;
        $result = $student->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات موفقانه ویرایش  نشد دوباره تلاش نماید'
            ], 200);
        }
    }


    public function destroy($id)
    {
        $result = Student::destroy($id);
        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه حذف گردید'
            ], 200);
        }
    }
}
