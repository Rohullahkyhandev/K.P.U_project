<?php

namespace App\Http\Controllers;

use App\Exports\TeachersExport;
use App\Http\Resources\FacultyDepartmentRsource;
use App\Http\Resources\TeacherArticleResource;
use App\Http\Resources\TeacherDocumentResource;
use App\Http\Resources\TeacherLiteratureResource;
use App\Http\Resources\TeacherQualificationResource;
use App\Http\Resources\TeacherResource;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Teacher;
use App\Models\Teacher_document;
use App\Models\Teacher_qualification;
use App\Models\Teacher_article;
use App\Models\Teacher_Literature;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mpdf\Tag\U;
use Validator;
use Excel;

use function PHPUnit\Framework\returnValueMap;

class TeacherController extends Controller
{


    public function validation()
    {
        $rules = [
            'code_bast' => 'required:string:max:13',
            'code_bast_in_letter' => 'nullable',
            'name' => 'required:string:max:100',
            'lname' => 'required:string:max:100',
            'fatherName' => 'required:string:max:100',
            'grandFathername' => 'required:string:max:100',
            'email' => 'email:string:max:100:unique:teachers',
            'phone' => 'required:string:max:14',
            'gender' => 'required:string',
            'main_address'  => 'required:string:max:100',
            'current_address'  => 'required:string:max:100',
            'birth_date' => 'required:date:max:100',
            'academic_rank' => 'required:string:max:100',
            'hire_date' => 'required:date:max:100',
            'nic' => 'required:string:max:100|unique:teachers',
            'education_field' => 'required:string:max:100',
        ];

        return $rules;
    }



    public function index()
    {
        $per_page = request('per_page', 10);
        $department_id = request('department_id', '');
        $program_id = request('program_id');
        $search = request('search', '');
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $currentUser = Auth::user();

        $view_postgraduated = false;
        $administrator = false;

        foreach (Auth::user()->permissions as $permission) {
            if ($permission->permission_name == 'view_postgraduated') {
                $view_postgraduated = true;
            } else if ($permission->permission_name == 'administrator') {
                $administrator = true;
            }
        }

        if ($view_postgraduated == true || $administrator == true) {

            $data = Teacher::query()
                ->distinct()
                ->where('teachers.program_id', 'like', "%{$program_id}%")
                ->whereAny([
                    'teachers.name',
                    'teachers.lname',
                    'teachers.fatherName',
                    'teachers.code_bast',
                    'teachers.nic',
                ], 'LIKE',  "%{$search}%")
                ->join('departments', 'teachers.department_id', 'departments.id')
                ->join('post_graduated_programs', 'teachers.program_id', 'post_graduated_programs.id')
                ->join('users', 'teachers.user_id', 'users.id')
                ->join('teacher_qualifications', 'teachers.id', 'teacher_qualifications.teacher_id')
                ->leftJoin('faculties', 'teachers.faculty_id', 'faculties.id')
                ->select('teachers.*', 'post_graduated_programs.program_name as pname',  'post_graduated_programs.degree_type as degree_type',   'faculties.name as faculty', 'departments.name as department', 'teacher_qualifications.education_ as education', 'users.name as uname')
                ->whereIn('teachers.teaching_status',  ['post-graduated', 'both'])
                ->orderBy("teachers.$sortField", $sortDirection)
                ->paginate($per_page);
        } else {

            $data = DB::table('teachers')
                ->where('teachers.department_id', 'like', "%{$department_id}%")
                ->whereAny([
                    'teachers.name',
                    'teachers.lname',
                    'teachers.fatherName',
                    'teachers.code_bast',
                    'teachers.nic',
                ], 'LIKE',  "%{$search}%")
                ->leftJoin('departments', 'teachers.department_id', 'departments.id')
                ->leftJoin('post_graduated_programs', 'teachers.program_id', 'post_graduated_programs.id')
                ->leftJoin('users', 'teachers.user_id', 'users.id')
                ->leftJoin('promotions', function ($join) {
                    $join->on('teachers.id', '=', 'promotions.teacher_id')
                        ->whereIn('promotions.id', function ($query) {
                            $query->select(DB::raw('MAX(id)'))
                                ->from('promotions')
                                ->groupBy('teacher_id');
                        });
                })
                ->leftJoin('scholarships', function ($join) {
                    $join->on('teachers.id', '=', 'scholarships.teacher_id')
                        ->whereIn('scholarships.id', function ($query) {
                            $query->select(DB::raw('MAX(id)'))
                                ->from('scholarships')
                                ->groupBy('teacher_id');
                        });
                })
                ->leftJoin('teacher_qualifications', function ($join) {
                    $join->on('teachers.id', '=', 'teacher_qualifications.teacher_id')
                        ->whereIn('teacher_qualifications.id', function ($query) {
                            $query->select(DB::raw('MAX(id)'))
                                ->from('teacher_qualifications')
                                ->groupBy('teacher_id');
                        });
                })
                ->leftJoin('faculties', 'teachers.faculty_id', 'faculties.id')
                ->select('teachers.*', 'scholarships.country_name as country', 'scholarships.edu_maqta as edu_maqta', 'scholarships.sent_date as sent_date', 'scholarships.back_date as back_date', 'promotions.date as date', 'post_graduated_programs.program_name as pname', 'teacher_qualifications.education_ as education', 'post_graduated_programs.degree_type as degree_type', 'promotions.attachment_path as attachment_path', 'promotions.last_academic_rank as last_rank', 'promotions.now_academic_rank as now_rank', 'faculties.name as faculty', 'departments.name as department',  'users.name as uname')
            ->orderBy("teachers.$sortField", $sortDirection)
                ->distinct()
                ->paginate($per_page);
        }
        return TeacherResource::collection($data);
    }


    // get the teache information acc specific department
    public function getDepartmentTeacher($id)
    {
        $data = Teacher::where('department_id', '= ', $id)->get();
        return $data;
    }


    public function store(Request $request)
    {

        $year = (date('Y') - 621);
        $validate_date_of_birth = ($year - substr($request->birth_date, 0, 3));
        if ($validate_date_of_birth < 25) {
            return response([
                'error' => 'سن  کوچکتر از حد قابل قبول است'
            ], 304);
        }

        $request->validate([
            'code_bast' => 'required|string|max:10|unique:teachers,code_bast',
            'code_bast_in_letter' => 'nullable',
            'name' => 'required|string|max:100',
            'lname' => 'required|string|max:100',
            'fatherName' => 'required|string|max:100',
            'grandFathername' => 'required|string|max:100',
            'email' => 'email|string|max:100|unique:teachers',
            'phone' => 'required|string|max:14',
            'gender' => 'required|string',
            'main_address'  => 'required|string|max:100',
            'current_address'  => 'required|string|max:100',
            'birth_date' => 'required|date|max:100',
            'academic_rank' => 'required|string|max:100',
            'hire_date' => 'required|date|max:100',
            'nic' => 'required|string|max:13',
            'teaching_status' => 'required',
            // 'related_part' => 'required',
            // 'program_id' => 'required',
            // 'department_id' => 'required',
            'foreign_languages.*' => 'required',
            'education_field' => 'required|string|max:100',
        ], [
            'code_bast.unique' => 'این کود بست از قبل در سیستم ثبت شده است',
            'email.unique' => 'این ایمیل  از قبل در سیستم ثبت شده است',
            'name.required' => 'وارد کردن نام الزامی میباشد',
            'lname.required' => 'وارد کردن تخلص الزامی میباشد',
            'fatherName.required' => 'وارد کردن نام پدر الزامی میباشد',
            'grandFatherName.required' => 'وارد کردن نام پدرکلان الزامی میباشد',
            'email.required' => 'وارد کردن ایمیل الزامی میباشد',
            'main_address.required' => 'وارد کردن آدرس اصلی الزامی میباشد',
            'current_address.required' => 'وارد کردن آدرس فعلی الزامی میباشد',
            'birth_date.required' => 'وارد کردن تاریخ تولد الزامی میباشد',
            'academic_rank.required' => 'وارد کردن رتبه علمی الزامی میباشد',
            'hire_date.required' => 'وارد کردن تاریخ استخدام الزامی میباشد',
            'nic.required' => 'وارد کردن نمبر تذکزه الزامی میباشد',
            'teaching_status.required' => 'وارد کردن وضعیت استاد الزامی میباشد',
        ]);

        DB::beginTransaction();
        try {
            $photo = null;
            $photo_path = null;
            if ($request->photo != '') {
                $photo = $request->photo->store('/', 'teacher_photo');
                $photo_path = asset(Storage::url('teacher_photo/' . $photo));
            }
            $user_id = Auth::id();
            $teacher = new Teacher();
            $teacher->code_bast  = $request->code_bast;
            $teacher->code_bast_in_letter  = $request->code_bast_in_letter;
            $teacher->name  = $request->name;
            $teacher->lname = $request->lname;
            $teacher->fatherName = $request->fatherName;
            $teacher->grandFathername = $request->grandFathername;
            $teacher->email = $request->email;
            $teacher->phone = $request->phone;
            $teacher->gender = $request->gender;
            $teacher->main_address = $request->main_address;
            $teacher->current_address = $request->current_address;
            $teacher->birth_date = $request->birth_date;
            $teacher->academic_rank = $request->academic_rank;
            $teacher->hire_date = $request->hire_date;
            $teacher->teaching_status = $request->teaching_status;
            $teacher->related_part = $request->related_part;
            $teacher->nic = $request->nic;
            $teacher->languages = json_encode($request->foreign_languages);
            $teacher->education_field = $request->education_field;
            $teacher->photo = $photo;
            $teacher->photo_path = $photo_path;
            if ($request->teaching_status == 'bachelor' || $request->teaching_status == 'both' || $request->teaching_status == 'post-graduated' || $request->related_part == 'common_department') {
                $teacher->department_id = $request->department_id;
            }
            if (($request->teaching_status == 'bachelor' || $request->teaching_status == 'both' || $request->teaching_status == 'post-graduated') || $request->related_part == 'faculty') {
                $teacher->faculty_id = $request->faculty_id;
            }
            if (($request->teaching_status == 'post-graduated' || $request->teaching_status == 'both')) {
                $teacher->program_id = $request->program_id;
            }
            $teacher->user_id = $user_id;
            $result = $teacher->save();
            DB::commit();
            $teacher_id  = $teacher->id;
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
        if ($result) {
            return response([
                'message' => 'درخواست موفقانه انجام شد',
                'teacher_id' => $teacher_id,
            ]);
        }
    }



    public function edit($id = '')
    {
        $data = Teacher::find($id);
        return $data;
    }


    public function update(Request $request)
    {

        $request->validate([
            'code_bast' => 'required|string|max:10|unique:teachers,code_bast',
            'code_bast_in_letter' => 'nullable',
            'name' => 'required|string|max:100',
            'lname' => 'required|string|max:100',
            'fatherName' => 'required|string|max:100',
            'grandFathername' => 'required|string|max:100',
            'email' => 'email|string|max:100|unique:teachers',
            'phone' => 'required|string|max:14',
            'gender' => 'required|string',
            'main_address'  => 'required|string|max:100',
            'current_address'  => 'required|string|max:100',
            'birth_date' => 'required|date|max:100',
            'academic_rank' => 'required|string|max:100',
            'hire_date' => 'required|date|max:100',
            'nic' => 'required|string|max:13',
            'teaching_status' => 'required',
            // 'related_part' => 'required',
            // 'program_id' => 'required',
            // 'department_id' => 'required',
            'foreign_languages.*' => 'required',
            'education_field' => 'required|string|max:100',
            'photo' => 'required|mimes:jpg,png,jpeg,gif,pdf|max:6000'
        ], [
            'code_bast.unique' => 'این کود بست از قبل در سیستم ثبت شده است',
            'email.unique' => 'این ایمیل  از قبل در سیستم ثبت شده است',
            'name.required' => 'وارد کردن نام الزامی میباشد',
            'lname.required' => 'وارد کردن تخلص الزامی میباشد',
            'fatherName.required' => 'وارد کردن نام پدر الزامی میباشد',
            'grandFatherName.required' => 'وارد کردن نام پدرکلان الزامی میباشد',
            'email.required' => 'وارد کردن ایمیل الزامی میباشد',
            'main_address.required' => 'وارد کردن آدرس اصلی الزامی میباشد',
            'current_address.required' => 'وارد کردن آدرس فعلی الزامی میباشد',
            'birth_date.required' => 'وارد کردن تاریخ تولد الزامی میباشد',
            'academic_rank.required' => 'وارد کردن رتبه علمی الزامی میباشد',
            'hire_date.required' => 'وارد کردن تاریخ استخدام الزامی میباشد',
            'nic.required' => 'وارد کردن نمبر تذکزه الزامی میباشد',
            'teaching_status.required' => 'وارد کردن وضعیت استاد الزامی میباشد',
            'photo.required' => ' عکس الزامی میباشد',
            'photo.mimes' => ' عکس باید یکی از این فارمت راjpg,png,jpeg,gif,pdf  داشته باشد میباشد',
            'photo.max' => 'حجم عکس نباید بیشتر از 6 مگابایت باشد',
            'foreign_languages.*.required' => 'وارد کردن لسان های خارجی الزامی میباشد',
        ]);

        DB::beginTransaction();
        try {
            $id = $request->id;
            $teacher = Teacher::find($id);
            $photo = $teacher->photo;
            $photo_path = $teacher->photo_path;
            if ($request->photo != null) {
                if (is_file(storage_path('app/public/teacher_photo/' . $photo))) {
                    unlink(storage_path('app/public/teacher_photo/' . $photo));
                }
                $photo = $request->photo->store('/', 'teacher_photo');
                $photo_path = asset(Storage::url('teacher_photo/' . $photo));
            }
            //$user_id = Auth::id();
            $teacher->code_bast  = $request->code_bast;
            $teacher->code_bast_in_letter  = $request->code_bast_in_letter;
            $teacher->name  = $request->name;
            $teacher->lname = $request->lname;
            $teacher->fatherName = $request->fatherName;
            $teacher->grandFathername = $request->grandFathername;
            $teacher->email = $request->email;
            $teacher->phone = $request->phone;
            $teacher->gender = $request->gender;
            $teacher->main_address = $request->main_address;
            $teacher->current_address = $request->current_address;
            $teacher->birth_date = $request->birth_date;
            $teacher->academic_rank = $request->academic_rank;
            $teacher->hire_date = $request->hire_date;
            $teacher->teaching_status = $request->teaching_status;
            $teacher->related_part = $request->related_part;
            $teacher->nic = $request->nic;
            $teacher->education_field = $request->education_field;
            $teacher->languages = $request->forign_languages;
            $teacher->photo = $photo;
            $teacher->photo_path = $photo_path;
            if ($request->teaching_status == 'bachelor' || $request->teaching_status == 'both' || $request->teaching_status == 'post-graduated' || $request->related_part == 'common_department') {
                $teacher->department_id = $request->department_id;
            }
            if (($request->teaching_status == 'bachelor' || $request->teaching_status == 'both' || $request->teaching_status == 'post-graduated') || $request->related_part == 'faculty') {
                $teacher->faculty_id = $request->faculty_id;
            }
            if (($request->teaching_status == 'post-graduated' || $request->teaching_status == 'both')) {
                $teacher->program_id = $request->program_id;
            }
            $result = $teacher->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
        if ($result) {
            return response([
                'message' => 'اطلاعات  موفقانه ویرایش  شد'
            ]);
        } else {
            return response([
                'message' => ' دوباره تلاش نماید,اطلاعات موفقانه ویرایش نشد'
            ]);
        }
    }


    // just destory teacher information
    public function destroy($id = '')
    {
        $teacher = Teacher::find($id);
        if (is_file(storage_path('app/public/teacher_photo/' . $teacher->photo))) {
            unlink(storage_path('app/public/teacher_photo/' . $teacher->photo));
        }
        $result = $teacher->delete();
        return $result;
    }

    public function getTeacher($id = '')
    {
        return Teacher::find($id);
    }

    // qualification
    public function storeQualification(Request $request, $id = '')
    {

        $request->validate([
            'country' => 'required|string',
            'education_' => 'required|string',
            'education_field' => 'required|string',
            'admission_year' => 'required',
            'graduated_year' => 'required',
            'university' => 'required|string',
            'description' => 'nullable|string'
        ], [
            'country.required' => 'وارد نمودن نام کشور الزامی میباشد.',
            'education_.required' => 'وارد نمودن  مقطع تحصیلی الزامی میباشد.',
            'admission_year.required' => 'وارد نمودن سال شولیت الزامی میباشد.',
            'graduated_year.required' => 'وارد نمودن سال فراغت الزامی میباشد.',
            'education_field.required' => 'وارد نمودن ریشته تحصیلی الزامی میباشد.',
            'uuniversity.required' => 'وارد نمودن نام پوهنتون الزامی میباشد.',
            'country.string' => '  کشور باید حرف  میباشد.',
            'education_.string' => '  مقطع تحصیلی باید حرف  میباشد.',
            'university.string' => ' نام پوهنتون باید حرف  میباشد.',
            'description.string' => '  توضیحات باید حرف  میباشد.',
        ]);

        DB::beginTransaction();
        try {

            $user_id = Auth::id();
            $teacher_qualification = new Teacher_qualification();
            $teacher_qualification->country = $request->country;
            $teacher_qualification->edu_field = $request->education_field;
            $teacher_qualification->education_ = $request->education_;
            $teacher_qualification->admission_year = $request->admission_year;
            $teacher_qualification->graduated_year = $request->graduated_year;
            $teacher_qualification->university = $request->university;
            $teacher_qualification->description = $request->description;
            $teacher_qualification->teacher_id = $id;
            $teacher_qualification->user_id = $user_id;
            $result = $teacher_qualification->save();

            // Update the teacher education degree
            $teacher = Teacher::find($id);
            $teacher->education_degree = $request->education_;
            $result = $teacher->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }

        if ($result) {
            return response([
                'message' => 'درخواست موفقانه انجام شد'
            ], 200);
        } else {
            return response([
                'message' => 'رخواست موفقانه انجام نشد'
            ], 304);
        }
    }

    public function getQualify()
    {
        $id = request('id');
        $per_page = request('perPage', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $search = request('search', '');
        $data =  Teacher_qualification::query()
            ->where('teacher_qualifications.country', 'like', "%$search%")
            ->join('users', 'teacher_qualifications.user_id', 'users.id')
            ->select('teacher_qualifications.*', 'users.name as uname')
            ->where('teacher_qualifications.teacher_id', $id)
            ->orderBy("teacher_qualifications.$sortField", $sortDirection)
            ->paginate($per_page);
        return TeacherQualificationResource::collection($data);
    }

    public function editQualification($id = '')
    {
        return Teacher_qualification::where('teacher_id', '=', $id)->first();
    }

    public function updateQualification(Request $request, $id = ' ')
    {

        $request->validate([
            'country' => 'required|string',
            'education_' => 'required|string','education_field' => 'required|string',
            'admission_year' => 'required|date',
            'graduated_year' => 'required|‌date',
            'university' => 'required|string',
            'description' => 'nullable|string'
        ], [
            'country.required' => 'وارد نمودن نام کشور الزامی میباشد.',
            'education_.required' => 'وارد نمودن  مقطع تحصیلی الزامی میباشد.',
            'admission_year.required' => 'وارد نمودن سال شولیت الزامی میباشد.',
            'graduated_year.required' => 'وارد نمودن سال فراغت الزامی میباشد.',
            'education_field.required' => 'وارد نمودن ریشته تحصیلی الزامی میباشد.',
            'uuniversity.required' => 'وارد نمودن نام پوهنتون الزامی میباشد.',
            'country.string' => '  کشور باید حرف  میباشد.',
            'education_.string' => '  مقطع تحصیلی باید حرف  میباشد.',
            'university.string' => ' نام پوهنتون باید حرف  میباشد.',
            'description.string' => '  توضیحات باید حرف  میباشد.',
        ]);

        DB::beginTransaction();

        try {

            $user_id = Auth::id();
            $teacher_qualification = Teacher_qualification::find($id);
            $teacher_qualification->country = $request->country;
            $teacher_qualification->edu_field = $request->education_field;
            $teacher_qualification->education_ = $request->education_;
            $teacher_qualification->admission_year = $request->admission_year;
            $teacher_qualification->graduated_year = $request->graduated_year;
            $teacher_qualification->university = $request->university;
            $teacher_qualification->description = $request->description;
            $teacher_qualification->user_id = $user_id;
            $result = $teacher_qualification->save();
            // Update the teacher education degree
            $teacher = Teacher::find($teacher_qualification->teacher_id);
            $teacher->education_degree = $teacher_qualification->education_;
            $result = $teacher->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
        if ($result) {
            return response([
                'message' => 'درخواست موفقانه انجام شد'
            ], 200);
        } else {
            return response([
                'message' => 'رخواست موفقانه انجام نشد'
            ], 304);
        }
    }

    public function destroyQualification($id = '')
    {
        $result = Teacher_qualification::find($id)->delete();
        return $result;
    }

    // teacher document
    public function storeDocument(Request $request, $id = '')
    {

        $request->validate([
            'type' => 'required|string','document' => 'required|mimes:pdf,jpg,png|max:8000',
            'description' => 'nullable|string',
        ], [
            'type.required' => ' وارد نمودن نوع سند الزامی میباشد',
            'document.required' => ' وارد نمودن  سند الزامی میباشد',
            'description' => 'وارد نمودن توضیحات لزامی میباشد',
            'document.mimes' => 'سند باید در یکی از این فارمت ها jpg,png,jpg,jpeg,gif,pdf باشد.',
            'document.max' => 'حجم سند نمیتواند بیشتر ا�� 8 مگابایت نباشد.',
        ]);

        $user_id = Auth::id();

        $document = null;
        $document_path = null;
        if ($request->document != '') {
            $document = $request->document->store('', 'teacher_document');
            $document_path = asset(Storage::url('teacher_document/' . $document));
        }
        $teacher_document = new Teacher_document();
        $teacher_document->type = $request->type;
        $teacher_document->attachment = $document;
        $teacher_document->attachment_path = $document_path;
        $teacher_document->description = $request->description;
        $teacher_document->teacher_id = $id;
        $teacher_document->user_id = $user_id;
        $result = $teacher_document->save();

        if ($result) {
            return response([
                'message' => 'درخواست موفقانه انجام شد'
            ], 200);
        } else {
            return response([
                'message' => 'رخواست موفقانه انجام نشد'
            ], 304);
        }
    }

    public function getDocument()
    {
        $id = request('id');
        $per_page = request('perPage', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', "DESC");
        $search = request('search', '');
        $data = Teacher_document::query()
            ->where('teacher_documents.type', 'like', "%{$search}%")
            ->where('teacher_documents.teacher_id', $id)
            ->join('users', 'teacher_documents.user_id', 'users.id')
            ->select("teacher_documents.*", 'users.name as uname')
            ->orderBy("teacher_documents.$sortField", $sortDirection)
            ->paginate($per_page);
        return TeacherDocumentResource::collection($data);
    }

    public function editDocument($id = '')
    {
        return Teacher_document::find($id);
    }

    public function updateDocument(Request $request, $id = '')
    {
        $result = 0;
        $request->validate([
            'type' => 'required|string','document' => 'required|mimes:pdf,jpg,png|max:8000',
            'description' => 'nullable|string',
        ], [
            'type.required' => ' وارد نمودن نوع سند الزامی میباشد',
            'document.required' => ' وارد نمودن  سند الزامی میباشد',
            'description' => 'وارد نمودن توضیحات لزامی میباشد',
            'document.mimes' => 'سند باید در یکی از این فارمت ها jpg,png,jpg,jpeg,gif,pdf باشد.',
            'document.max' => 'حجم سند نمیتواند بیشتر ا�� 8 مگابایت نباشد.',
        ]);

        $user_id = Auth::id();
        $teacher_document = Teacher_document::find($id);
        $document = $teacher_document->attachment;
        $document_path = $teacher_document->attachment_path;
        if ($request->document != "") {
            if (is_file(storage_path('app/public/teacher_document/' . $document))) {
                unlink(storage_path('app/public/teacher_document/' . $document));
            }
            $document = $request->document->store('', 'teacher_document');
            $document_path = asset(Storage::url('teacher_document/' . $document));
        }

        $teacher_document->type = $request->type;
        $teacher_document->description = $request->description;
        $teacher_document->attachment = $document;
        $teacher_document->attachment_path = $document_path;
        $result =  $teacher_document->save();

        if ($result) {
            return response([
                'message' => 'درخواست موفقانه انجام شد'
            ], 200);
        } else {
            return response([
                'message' => 'رخواست موفقانه انجام نشد'
            ], 304);
        }
    }

    public function destroyDocument($id = '')
    {

        $teacher_document = Teacher_document::find($id);
        if (is_file(storage_path('app/public/teacher_document/' . $teacher_document->document))) {
            unlink(storage_path('app/public/teacher_path/' . $teacher_document->document));
        }
        $result = Teacher_document::find($id)->delete();

        return $result;
    }

    //  teacher article
    public function storeArticle(Request $request, $id = '')
    {
        $request->validate([
            'title' => 'required:string',
            'date' => 'required|max:100',
            'publisher' => 'required|string'
        ], [
            'title.required' => ' وارد نمودن  عنوان الزامی میباشد',
            'title.string' => 'عنوان باید حروف باشد',
            'publisher.required' => ' وارد نمودن ناشرالزامی میباشد',
            'publisher.required' => 'ناشر باید حروف باشد',

        ]);

        $user_id = Auth::id();

        $teacher_article = new Teacher_article();
        $teacher_article->title = $request->title;
        $teacher_article->date = $request->date;
        $teacher_article->publisher = $request->publisher;
        $teacher_article->teacher_id = $id;
        $teacher_article->user_id = $user_id;
        $result = $teacher_article->save();

        if ($result) {
            return response([
                'message' => 'درخواست موفقانه انجام شد'
            ], 200);
        } else {
            return response([
                'message' => 'رخواست موفقانه انجام نشد'
            ], 304);
        }
    }

    public function getArticle()
    {
        $id = request('id');
        $per_page = request('perPage', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $search = request('search', '');
        $data =  Teacher_article::query()
            ->where('teacher_articles.title', 'like', "%{$search}%")
            ->join('users', 'teacher_articles.user_id', 'users.id')
            ->select('teacher_articles.*', 'users.name as uname')
            ->where('teacher_articles.teacher_id', $id)
            ->orderBy("teacher_articles.$sortField", $sortDirection)
            ->paginate($per_page);
        return TeacherArticleResource::collection($data);
    }

    public function editArticle($id)
    {
        return Teacher_Article::find($id);
    }

    public function updateArticle(Request $request, $id = '')
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|max:100',
            'publisher' => 'required'
        ], [
            'title.required' => ' وارد نمودن  عنوان الزامی میباشد',
            'title.string' => 'عنوان باید حروف باشد',
            'publisher.required' => ' وارد نمودن ناشرالزامی میباشد',
            'publisher.required' => 'ناشر باید حروف باشد',

        ]);

        $user_id = Auth::id();

        $teacher_article = Teacher_article::where('teacher_id', '=', $id)->get()->first();
        $teacher_article->title = $request->title;
        $teacher_article->date = $request->date;
        $teacher_article->publisher = $request->publisher;
        $teacher_article->user_id = $user_id;
        $result = $teacher_article->update();

        if ($result) {
            return response([
                'message' => 'درخواست موفقانه انجام شد'
            ], 200);
        } else {
            return response([
                'message' => 'رخواست موفقانه انجام نشد'
            ], 304);
        }
    }

    public function destroyArticle($id = '')
    {
        $result = Teacher_article::find($id)->delete();
        return $result;
    }


    // teacher literature

    public function storeLiterature(Request $request, $id = '')
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|max:100|string',
            'publisher' => 'required|string',
            'date' => 'required|date',
        ], [
            'type.required' => ' وارد نمودن  نوع اثر الزامی میباشد',
            'type.string' => 'نوع اثر باید حروف باشد',
            'publisher.required' => ' وارد نمودن ناشرالزامی میباشد',
            'publisher.required' => 'ناشر باید حروف باشد',

        ]);

        $user_id = Auth::id();

        $teacher_literature = new Teacher_literature();
        $teacher_literature->name = $request->name;
        $teacher_literature->type = $request->type;
        $teacher_literature->date = $request->date;
        $teacher_literature->publisher = $request->publisher;
        $teacher_literature->teacher_id = $id;
        $teacher_literature->user_id = $user_id;
        $result = $teacher_literature->save();

        if ($result) {
            return response([
                'message' => 'درخواست موفقانه انجام شد'
            ], 200);
        } else {
            return response([
                'message' => 'رخواست موفقانه انجام نشد'
            ], 304);
        }
    }

    public function getLiterature()
    {
        $id = request('id');
        $per_page = request('perPage', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $search = request('search', '');
        $data = Teacher_Literature::query()
            ->where('teacher__literatures.name', 'like', "%{$search}%")
            ->join('users', 'teacher__literatures.user_id', 'users.id')
            ->select('teacher__literatures.*', 'users.name as uname')
            ->where('teacher__literatures.teacher_id', $id)
            ->orderBy("teacher__literatures.$sortField", $sortDirection)
            ->paginate($per_page);
        return TeacherLiteratureResource::collection($data);
    }

    public function editLiterature($id = '')
    {
        return Teacher_Literature::find($id);
    }

    public function updateLiterature(Request $request, $id = '')
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'date' => 'required|max:100',
            'publisher' => 'required'
        ]);

        $user_id = Auth::id();

        $teacher_literature = Teacher_literature::find($id);
        $teacher_literature->name = $request->name;
        $teacher_literature->type = $request->type;
        $teacher_literature->date = $request->date;
        $teacher_literature->publisher = $request->publisher;
        $teacher_literature->user_id = $user_id;
        $result = $teacher_literature->save();

        if ($result) {
            return response([
                'message' => 'درخواست موفقانه انجام شد'
            ], 200);
        } else {
            return response([
                'message' => 'رخواست موفقانه انجام نشد'
            ], 304);
        }
    }

    public function destroyLiterature($id = '')
    {
        $result = Teacher_literature::find($id)->delete();
        return $result;
    }

    public function generateReport() {}

    public function downloadTeacher()
    {
        // $data = Teacher::all();
        return Excel::download(new TeachersExport(), 'teacher.pdf', \Maatwebsite\Excel\Excel::MPDF);
    }
}




// download all the teacher information
