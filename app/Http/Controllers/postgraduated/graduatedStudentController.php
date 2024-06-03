<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\GraduatedStudentResource;
use App\Http\Resources\StudentResource;
use App\Models\GraduatedStudent;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class graduatedStudentController extends Controller
{


    // =================================================================================================
    //  status number 1 indicates to the not graduation 2 number means graduation
    // =================================================================

    public function index()
    {

        $search = request('');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $data = GraduatedStudent::query()
            ->where('phone', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('address', 'like', "%{$search}%")
            ->join("users", "students.user_id", "users.user_id")
            ->join("post_programs", "students.program_id", "post_programs.id")
            ->select("students.*", "post_programs.program_name as program_name", "users.name as uname")
            ->orderBy("post_programs.$sortField", $sortDirection)
            ->paginate($per_page);

        return GraduatedStudentResource::collection($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'percentage' => 'required',
            'graduation_year' => 'required',
            'diploma_id' => 'required',
            'program_id' => 'required',
            'thesis_guide_teacher' => 'required',
            'thesis_mark' => 'required',
            'attribute' => 'required',
        ], [
            'percentage.required' => 'فلید فصدی کلی الزامی می باشد',
            'graduation_year.required' => 'فلید تخلص سال فراغات  الزامی می باشد',
            'fname.required' => 'فلید نام پدر الزامی می باشد',
            'diploma_id.required' => 'فلید  آدی دیپلوم  الزامی می باشد',
            'thesis_guide_teacher.required' => 'فلید شماره تماس الزامی می باشد',
            'attribute.required' => 'فیلد خوصیات الزامی می باشد',
            'thesis_mark.required' => 'فیلد نمره تیسز  الزامی می باشد'
        ]);


        $user_id = Auth::user()->id;
        $student_id  = $request->student_id;
        $student = Student::find($student_id);
        $graduated_student = new GraduatedStudent();
        $graduated_student->email = $student->email;
        $graduated_student->phone = $student->phone;
        $graduated_student->percentage = $request->percentage;
        $graduated_student->graduation_year = $request->graduation_year;
        $graduated_student->diploma_id = $request->diploma_id;
        $graduated_student->thesis_guide_teacher = $request->thesis_guide_teacher;
        $graduated_student->thesis_mark = $request->thesis_mark;
        $graduated_student->studnet_id = $request->studnet_id;
        $graduated_student->user_id = $request->user_id;
        $result = $graduated_student->save();

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
        return new StudentResource($student);
    }

    public function update(Request $request)
    {

        $request->validate([
            'percentage' => 'required',
            'graduation_year' => 'required',
            'diploma_id' => 'required',
            'program_id' => 'required',
            'thesis_guide_teacher' => 'required',
            'thesis_mark' => 'required',
            'attribute' => 'required',
        ], [
            'percentage.required' => 'فلید فصدی کلی الزامی می باشد',
            'graduation_year.required' => 'فلید تخلص سال فراغات  الزامی می باشد',
            'diploma_id.required' => 'فلید  آدی دیپلوم  الزامی می باشد',
            'program_id.required' => 'فیلد برنامه تحصیلی الزامی می باشد',
            'thesis_guide_teacher.required' => 'فلید شماره تماس الزامی می باشد',
            'attribute.required' => 'فیلد خوصیات الزامی می باشد',
            'thesis_mark.required' => 'فیلد نمره تیسز  الزامی می باشد'
        ]);

        $graduated_student = GraduatedStudent::find($request->id);

        $graduated_student->percentage = $request->percentage;
        $graduated_student->graduation_year = $request->graduation_year;
        $graduated_student->diploma_id = $request->diploma_id;
        $graduated_student->program_id = $request->program_id;
        $graduated_student->thesis_guide_teacher = $request->thesis_guide_teacher;
        $graduated_student->thesis_mark = $request->thesis_mark;
        $graduated_student->attribute = $request->attribute;
        $result = $graduated_student->save();

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
        $result = GraduatedStudent::destroy($id);
        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه حذف گردید'
            ], 200);
        }
    }
}
