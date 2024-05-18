<?php

namespace App\Http\Controllers;

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
        $per_page = request('perPage', 10);
        $department_id = request('department_id');
        $search = request('search', '');
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data = Teacher::query()
            ->where('teachers.name', 'like', "%{$search}%")
            ->where('teachers.department_id', '=', $department_id)
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



    public function edit($id = '')
    {
        $data = Teacher::find($id);
        return $data;
    }


    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->id;
            $teacher = Teacher::find($id);
            $photo = null;
            $photo_path = null;
            if ($request->photo != '') {
                if (is_file(storage_path('app/public/teacher_photo/' . $request->photo))) {
                    unlink(storage_path('app/public/teacher_photo/' . $photo));
                }
                $photo = $request->photo->store('/', 'teacher_photo');
                $photo_path = asset(Storage::url('teacher_photo/' . $photo));
            }
            $user_id = Auth::id();
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
                'message' => 'اطلاعات  موفقانه ویرایش  شد'
            ]);
        } else {
            return response([
                'message' => ' دوباره تلاش نماید,اطلاعات موفقانه ویرایش نشد'
            ]);
        }
    }


    // just destory teacher information
    public function destory($id = '')
    {
        $teacher = Teacher::find($id);
        if (is_file(storage_path('app/public/teacher_photo/' . $teacher->photo))) {
            unlink(storage_path('app/public/teacher_photo/' . $teacher->photo));
        }
        $result = Teacher::destroy($id);
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

    public function updateQualification(Request $request, $id = '')
    {
        $request->validate([
            'country' => 'required|string',
            'education_degree' => 'required|string',
            'graduated_year' => 'required|string',
            'university' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $user_id = Auth::id();
        $teacher_qualification = Teacher_qualification::find($id);
        $teacher_qualification->country = $request->country;
        $teacher_qualification->education_degree = $request->education_degree;
        $teacher_qualification->graduated_year = $request->graduated_year;
        $teacher_qualification->university = $request->university;
        $teacher_qualification->description = $request->description;
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

    public function destroyQualification($id = '')
    {
        $result = Teacher_qualification::find($id)->delete();
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
            'type' => 'required|string',
            'document' => 'nullable',
            'description' => 'required|string',
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
            'title' => 'required',
            'date' => 'required|max:100',
            'publisher' => 'required'
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
            'name' => 'required',
            'type' => 'required|max:100',
            'publisher' => 'required',
            'date' => 'required',

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
}
