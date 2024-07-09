<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\GraduatedStudentResource;
use App\Http\Resources\StudentResource;
use App\Models\GraduatedStudent;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $year = request('year', '');
        $data = GraduatedStudent::query()
            ->where('graduated_students.graduated_year', 'like', "%{$year}")
            ->where('graduated_students.name', 'like', "%{$search}")
            ->where('graduated_students.lname', 'like', "%{$search}")
            ->join("users", "graduated_students.user_id", "users.id")
            ->join("post_graduated_programs", "graduated_students.program_id", "post_graduated_programs.id")
            ->join("students", "graduated_students.student_id", "students.id")
            ->select("graduated_students.*", "post_graduated_programs.program_name as program_name", "users.name as uname", "students.name as name", "students.lname as lname", "students.fname as fname")
            ->orderBy("graduated_students.$sortField", $sortDirection)
            ->paginate($per_page);

        return GraduatedStudentResource::collection($data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'percentage' => 'required',
            'graduated_year' => 'required',
            'diplome_id' => 'required',
            'thesis_guide_teacher' => 'required',
            'thesis_mark' => 'required',
            'attribute' => 'required',
        ], [
            'percentage.required' => 'فلید فصدی کلی الزامی می باشد',
            'graduated_year.required' => 'فلید  سال فراغات  الزامی می باشد',
            'fname.required' => 'فلید نام پدر الزامی می باشد',
            'diplome_id.required' => 'فلید  آدی دیپلوم  الزامی می باشد',
            'thesis_guide_teacher.required' => 'فلید شماره تماس الزامی می باشد',
            'attribute.required' => 'فیلد خوصیات الزامی می باشد',
            'thesis_mark.required' => 'فیلد نمره تیسز  الزامی می باشد'
        ]);

        DB::beginTransaction();
        try {
            $user_id = Auth::user()->id;
            $student_id  = $request->student_id;
            $student = Student::find($student_id);
            $student->status = '2';
            $student->save();

            //$check_data = GraduatedStudent::where('student_id', '=', $student->id)->get()->first();
            $graduated_student = new GraduatedStudent();
            $graduated_student->name = $student->name;
            $graduated_student->lname = $student->lname;
            $graduated_student->fname = $student->fname;
            $graduated_student->percentage = $request->percentage;
            $graduated_student->attribute = $request->attribute;
            $graduated_student->graduated_year = $request->graduated_year;
            $graduated_student->diplome_id = $request->diplome_id;
            $graduated_student->thesis_guide_teacher = $request->thesis_guide_teacher;
            $graduated_student->thesis_mark = $request->thesis_mark;
            $graduated_student->student_id = $student->id;
            $graduated_student->program_id = $student->program_id;
            $graduated_student->user_id = $user_id;
            $result = $graduated_student->save();

            DB::commit();
        } catch (Exception  $e) {
            $result = $e;
            DB::rollBack();
            return $result;
        }
        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه راجستر گردید'
            ], 200);
        } else {
            return response([
                'error' => 'اطلاعات موفقانه راجستر  نشد دوباره تلاش نماید'
            ], 304);
        }
    }


    public function edit($id = '')
    {
        $data  = GraduatedStudent::find($id);
        return $data;
    }

    public function update(Request $request)
    {

        $request->validate([
            'percentage' => 'required',
            'graduated_year' => 'required',
            'diplome_id' => 'required',
            'program_id' => 'required',
            'thesis_guide_teacher' => 'required',
            'thesis_mark' => 'required',
            'attribute' => 'required',
        ], [
            'percentage.required' => 'فلید فصدی کلی الزامی می باشد',
            'graduated_year.required' => 'فلید  سال فراغات  الزامی می باشد',
            'diplome_id.required' => 'فلید  آدی دیپلوم  الزامی می باشد',
            'program_id.required' => 'فیلد برنامه تحصیلی الزامی می باشد',
            'thesis_guide_teacher.required' => 'فلید شماره تماس الزامی می باشد',
            'attribute.required' => 'فیلد خوصیات الزامی می باشد',
            'thesis_mark.required' => 'فیلد نمره تیسز  الزامی می باشد'
        ]);

        $graduated_student = GraduatedStudent::find($request->id);
        $graduated_student->percentage = $request->percentage;
        $graduated_student->graduated_year = $request->graduated_year;
        $graduated_student->diplome_id = $request->diplome_id;
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
