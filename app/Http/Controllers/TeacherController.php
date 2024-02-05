<?php

namespace App\Http\Controllers;

use App\Http\Resources\FacultyDepartmentRsource;
use App\Http\Resources\TeacherResource;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Teacher;
use App\Models\Teacher_article as ModelsTeacher_article;
use App\Models\Teacher_document;
use App\Models\Teacher_qualification;
use App\Models\Teacher_article;

use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;

use function PHPUnit\Framework\returnValueMap;

class TeacherController extends Controller
{


    public function validation()
    {
        $rules = [
            'name' => 'required:string:max:100',
            'lname' => 'required:string:max:100',
            'fatherName' => 'required:string:max:100',
            'email' => 'email:string:max:100:unique:teachers',
            'phone' => 'required:string:max:14',
            'gender' => 'required:string',
            'main_address'  => 'required:string:max:100',
            'current_address'  => 'required:string:max:100',
            'birth_date' => 'required:date:max:100',
            'academic_rank' => 'required:string:max:100',
            'hire_date' => 'required:date:max:100',
            'nic' => 'required:string:max:100',

        ];

        return $rules;
    }



    public function index()
    {
        $per_page = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data = Teacher::query()
            ->where('teachers.name', 'like', "%{$search}%")
            ->orWhere('teachers.lname', 'like', "%{$search}%")
            ->join('departments', 'teachers.department_id', 'departments.id')
            ->join('users', 'teachers.user_id', 'users.id')
            ->join('faculties', 'teachers.faculty_id', 'faculties.id')
            ->select('teachers.*', 'faculties.name as faculty', 'departments.name as department', 'users.name as uname')
            ->orderBy("teachers.$sortField", $sortDirection)
            ->paginate($per_page);
        return TeacherResource::collection($data);
    }



    public function store(Request $request)
    {
        $rules = $this->validation();
        Validator::make($request->all(), $rules)->validate();

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
            $teacher->name  = $request->name;
            $teacher->lname = $request->lname;
            $teacher->fatherName = $request->fatherName;
            $teacher->email = $request->email;
            $teacher->phone = $request->phone;
            $teacher->gender = $request->gender;
            $teacher->main_address = $request->main_address;
            $teacher->current_address = $request->current_address;
            $teacher->birth_date = $request->birth_date;
            $teacher->academic_rank = $request->academic_rank;
            $teacher->hire_date = $request->hire_date;
            $teacher->nic = $request->nic;
            $teacher->photo = $photo;
            $teacher->photo_path = $photo_path;
            $teacher->department_id = $request->department_id;
            $teacher->user_id = $user_id;
            $teacher->faculty_id = $request->faculty_id;
            $result = $teacher->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
        if ($result) {
            return response([
                'message' => 'درخواست موفقانه انجام شد'
            ]);
        }
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
            'education_degree' => 'required|string',
            'graduated_year' => 'required|string',
            'university' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $user_id = Auth::id();

        $teacher_qualification = new Teacher_qualification();
        $teacher_qualification->country = $request->country;
        $teacher_qualification->education_degree = $request->education_degree;
        $teacher_qualification->graduated_year = $request->graduated_year;
        $teacher_qualification->university = $request->university;
        $teacher_qualification->description = $request->description;
        $teacher_qualification->teacher_id = $id;
        $teacher_qualification->user_id = $user_id;
        $result = $teacher_qualification->save();

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

    public function getQualify($id = '')
    {
        return Teacher_qualification::where('teacher_id', '=', $id)->get()->first();
    }

    public function updateQualification(Request $request, $id = '')
    {
        $request->validate([
            'country' => 'required|string',
            'education_degree' => 'required|string',
            'educated_year' => 'required|string',
            'university' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $user_id = Auth::id();
        $teacher_qualification = Teacher_qualification::where('teacher_id', '=', $id)->get()->first();
        $teacher_qualification->country = $request->country;
        $teacher_qualification->education_degree = $request->education_degree;
        $teacher_qualification->educated_year = $request->educated_year;
        $teacher_qualification->university = $request->university;
        $teacher_qualification->description = $request->description;
        $teacher_qualification->teacher_id = $id;
        $teacher_qualification->user_id = $user_id;
        $result = $teacher_qualification->update();
        return $result;
    }

    public function destroyQualification($id = '')
    {
        $result = Teacher_qualification::where('teacher_id', '=', $id)->delete();
        return $result;
    }

    // teacher document
    public function storeDocument(Request $request, $id = '')
    {


        $request->validate([
            'type' => 'required|string',
            'document' => 'required|mimes:pdf,jpg,png',
            'description' => 'required|string',
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

    public function getDocument($id = '')
    {
        return Teacher_document::where('teacher_id', '=', $id)->get()->first();
    }

    public function updateDocument(Request $request, $id = '')
    {
        $result = 0;
        $request->validate([
            'type' => 'required|string',
            'document' => 'required|mimes:pdf,jpg,png,',
            'description' => 'required|string',
        ]);



        $user_id = Auth::id();
        $teacher_document = Teacher_document::where('teacher_id', '=', $id)->get()->first();
        $document = $teacher_document->attachment;
        $document_path = $teacher_document->attachment_path;
        if ($request->document != '') {
            if (is_file(storage_path('app/public/teacher_document/' . $document))) {
                unlink(storage_path('app/public/teacher_document/' . $document));
            }
            $document = $request->document->store('', 'teacher_document');
            $document_path = asset(Storage::url('teacher_document/' . $document));
        }
        $document_id = $teacher_document->id;

        $result = Teacher_document::find($document_id)->update([
            'type' => $request->type,
            'attachment' => $document,
            'attachment_path' => $document_path,
            'description' => $request->description
        ]);

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
        $result = Teacher_document::destroy($id);

        return $result;
    }

    //  teacher article
    public function storeArticle(Request $request, $id = '')
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|max:100',
            'description' => 'nullable|string',
            'publisher' => 'url|required'
        ]);

        $user_id = Auth::id();

        $teacher_article = new Teacher_article();
        $teacher_article->title = $request->title;
        $teacher_article->date = $request->date;
        $teacher_article->publisher = $request->publisher;
        $teacher_article->description = $request->description;
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

    public function getArticle($id = '')
    {
        return Teacher_article::find($id);
    }

    public function updateArticle(Request $request, $id = '')
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|max:100',
            'description' => 'nullable|string',
            'publisher' => 'url|required'
        ]);

        $user_id = Auth::id();

        $teacher_article = Teacher_article::where('teacher_id', '=', $id)->get()->first();
        $teacher_article->title = $request->title;
        $teacher_article->date = $request->date;
        $teacher_article->publisher = $request->publisher;
        $teacher_article->description = $request->description;
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
        $result = Teacher_article::destroy($id);
        return $result;
    }
}
