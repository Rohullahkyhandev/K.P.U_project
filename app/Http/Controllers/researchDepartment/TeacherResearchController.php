<?php

namespace App\Http\Controllers\researchDepartment;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherRessearchResource;
use App\Models\TeacherResearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherResearchController extends Controller
{



    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data = TeacherResearch::query()
            ->where('teacher_researchs.name', 'like', "%{$search}%")
            ->orWhere('teacher_researchs.lname', 'like', "%{$search}%")
            ->orWhere('teacher_researchs.research_title', 'like', "%{$search}%")
            ->join('users', 'teacher_researchs.user_id', 'users.id')
            ->join('faculties', 'teacher_researchs.faculty_id', 'faculties.id')
            ->join('departments', 'teacher_researchs.department_id', 'departments.id')
            ->select('teacher_researchs.*', 'users.name as uname', 'faculties.name as faculty', 'departments.name as department')
            ->orderBy("teacher_researchs.$sortField", $sortDirection)
            ->paginate($per_page);
        return  TeacherRessearchResource::collection($data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'lname' => 'required',
            'fname' => 'required',
            'title' => 'required',
            'academic_rank' => 'required',
            'education_degree' => 'required',
            'date' => 'required',
            'faculty_id' => 'required',
            'department_id' => 'required',
        ], [
            'name.required' => 'فیلد نام الزامی میباشد',
            'lname.required' => 'فیلد نام خانوادگی الزامی میباشد',
            'research_title.required' => 'فیلد عنوان تحقیق الزامی میباشد',
            'academic_rank.required' => 'فیلد رتبه علمی الزامی میباشد',
            'education_degree.required' => 'فیلد سویه تحصیلی الزامی میباشد',
            'date.required' => 'فیلد تاریخ الزامی میباشد',
            'faculty_id.required' => 'فیلد دانشکده الزامی میباشد',
            'department_id.required' => 'فیلد دیپارتمنت الزامی میباشد',
        ]);

        $user_id = Auth::user()->id;
        $teacher_research = new TeacherResearch();
        $teacher_research->name = $request->name;
        $teacher_research->lname = $request->lname;
        $teacher_research->fname = $request->fname;
        $teacher_research->research_title = $request->title;
        $teacher_research->academic_rank = $request->academic_rank;
        $teacher_research->education_degree = $request->education_degree;
        $teacher_research->date = $request->date;
        $teacher_research->faculty_id = $request->faculty_id;
        $teacher_research->department_id = $request->department_id;
        $teacher_research->user_id = $user_id;
        $result = $teacher_research->save();

        if ($result) {
            return response([
                'message' => 'موفقانه ذخیره شد'
            ], 200);
        } else {
            return response([
                'message' => 'موفقانه ذخیره نشد دوباره تلاش نماید'
            ], 304);
        }
    }


    public function edit($id = '')
    {
        return TeacherResearch::find($id);
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'lname' => 'required',
            'fname' => 'required',
            'title' => 'required',
            'academic_rank' => 'required',
            'education_degree' => 'required',
            'date' => 'required',
            'faculty_id' => 'required',
            'department_id' => 'required',
        ], [
            'name.required' => 'فیلد نام الزامی میباشد',
            'lname.required' => 'فیلد نام خانوادگی الزامی میباشد',
            'research_title.required' => 'فیلد عنوان تحقیق الزامی میباشد',
            'academic_rank.required' => 'فیلد رتبه علمی الزامی میباشد',
            'education_degree.required' => 'فیلد سویه تحصیلی الزامی میباشد',
            'date.required' => 'فیلد تاریخ الزامی میباشد',
            'faculty_id.required' => 'فیلد دانشکده الزامی میباشد',
            'department_id.required' => 'فیلد دیپارتمنت الزامی میباشد',
        ]);


        $teacher_research = TeacherResearch::find($request->id);
        $teacher_research->name = $request->name;
        $teacher_research->lname = $request->lname;
        $teacher_research->fname = $request->fname;
        $teacher_research->research_title = $request->title;
        $teacher_research->academic_rank = $request->academic_rank;
        $teacher_research->education_degree = $request->education_degree;
        $teacher_research->date = $request->date;
        $teacher_research->faculty_id = $request->faculty_id;
        $teacher_research->department_id = $request->department_id;
        $teacher_research->user_id = Auth::id();
        $result = $teacher_research->save();

        if ($result) {
            return response([
                'message' => 'موفقانه ویرایش شد'
            ], 200);
        } else {
            return response([
                'message' => 'موفقانه ویرایش نشد دوباره تلاش نماید'
            ], 304);
        }
    }


    public function destory($id = '')
    {
        $teacher_research = TeacherResearch::find($id);
        $result = $teacher_research->delete();
        if ($result) {
            return response([
                'message' => 'موفقانه حذف شد'
            ], 200);
        } else {
            return response([
                'message' => 'موفقانه حذف نشد دوباره تلاش نماید'
            ], 304);
        }
    }
}
