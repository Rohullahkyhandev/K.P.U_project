<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentResource;
use App\Http\Resources\FarwardedDocumentResource;
use App\Models\Chance_Amiryat;
use App\Models\Department;
use App\Models\Document;
use App\Models\Faculty;
use App\Models\FarwardDocument;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Comment\Doc;

class DocumentController extends Controller
{



    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $currentUser = Auth::user();

        if ($currentUser->user_type == 'faculty_user') {
            $data = Document::query()
                ->whereAny([
                    'documents.number',
                    'documents.title',
                    'documents.date',
                    'documents.type',
                    'documents.source',
                    'documents.destination',
                ], 'LIKE', "%{$search}%")
                ->join('users', 'documents.user_id', 'users.id')
                ->select('documents.*', 'users.name as uname')
                ->where('documents.faculty_id', '=', $currentUser->faculty_id)
                ->orderBy("documents.$sortField", $sortDirection)
                ->paginate($per_page);
            return DocumentResource::collection($data);
        }

        if ($currentUser->user_type == 'fifth_department') {
            $data = Document::query()
                ->whereAny([
                    'documents.number',
                    'documents.title',
                    'documents.date',
                    'documents.type',
                    'documents.source',
                    'documents.destination',
                ], 'LIKE', "%{$search}%")
                ->join('users', 'documents.user_id', 'users.id')
                ->select('documents.*', 'users.name as uname')
                ->where('documents.dep_id', $currentUser->dep_id)
                ->orderBy("documents.$sortField", $sortDirection)
                ->paginate($per_page);
            return DocumentResource::collection($data);
        }


        if ($currentUser->user_type == 'faculty_user') {
            $data = Document::query()
                ->whereAny([
                    'documents.number',
                    'documents.title',
                    'documents.date',
                    'documents.type',
                    'documents.source',
                    'documents.destination',
                ], 'LIKE', "%{$search}%")
                ->join('users', 'documents.user_id', 'users.id')
                ->select('documents.*', 'users.name as uname')
                ->where('documents.faculty_id', $currentUser->faculty_id)
                ->orderBy("documents.$sortField", $sortDirection)
                ->paginate($per_page);
            return DocumentResource::collection($data);
        }


        if ($currentUser->user_type == 'department_user') {
            $data = Document::query()
                ->whereAny([
                    'documents.number',
                    'documents.title',
                    'documents.date',
                    'documents.type',
                    'documents.source',
                    'documents.destination',
                ], 'LIKE', "%{$search}%")
                ->join('users', 'documents.user_id', 'users.id')
                ->select('documents.*', 'users.name as uname')
                ->where('documents.department_id', $currentUser->department_id)
                ->orderBy("documents.$sortField", $sortDirection)
                ->paginate($per_page);
            return DocumentResource::collection($data);
        }

        if ($currentUser->user_type == 'common_department_user') {
            $data = Document::query()
                ->whereAny([
                    'documents.number',
                    'documents.title',
                    'documents.date',
                    'documents.type',
                    'documents.source',
                    'documents.destination',
                ], 'LIKE', "%{$search}%")
                ->join('users', 'documents.user_id', 'users.id')
                ->select('documents.*', 'users.name as uname')
                ->where('documents.department_id', $currentUser->department_id)
                ->orderBy("documents.$sortField", $sortDirection)
                ->paginate($per_page);
            return DocumentResource::collection($data);
        }
    }


    // farwared the documentation

    public function farwardParts()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $currentUser = Auth::user();
        if ($currentUser->user_type == 'faculty_user') {
            $data  =  FarwardDocument::query()
                ->where('farward_documents.farwarded_part', '=', $currentUser->faculty_id)
                ->where('farward_documents.status', '=', 1)
                ->join('documents', 'farward_documents.document_id', 'documents.id')
                ->join('users', 'farward_documents.user_id', 'users.id')
                ->join('faculties', 'farward_documents.farwarded_part', '=', 'faculties.id')
                ->select('farward_documents.*', 'documents.id as document_id', 'documents.attachment_path as attachment_path', 'documents.number as number', 'documents.title as title',  'users.name as uname')
                ->orderBy("farward_documents.$sortField", $sortDirection)
                ->paginate($per_page);

            return FarwardedDocumentResource::collection($data);
        }

        if ($currentUser->user_type == 'fifth_department') {
            $data =  FarwardDocument::query()
                ->where('farward_documents.farwarded_part', '=', $currentUser->dep_id)
                ->where('farward_documents.status', '=', 1)
                ->join('documents', 'farward_documents.document_id', 'documents.id')
                ->join('users', 'farward_documents.user_id', 'users.id')
                ->select('farward_documents.*', 'documents.id as document_id', 'documents.attachment_path as attachment_path',  'documents.date as date', 'documents.number as number', 'documents.title as title', 'users.name as uname')
                ->paginate($per_page);
            return FarwardedDocumentResource::collection($data);
        }

        if ($currentUser->user_type == 'common_department_user') {
            $data =  FarwardDocument::query()
                ->where('farward_documents.farwarded_part', '=', $currentUser->department_id)
                ->where('farward_documents.status', '=', 1)
                ->join('documents', 'farward_documents.document_id', 'documents.id')
                ->join('users', 'farward_documents.user_id', 'users.id')
                ->select('farward_documents.*', 'documents.id as document_id', 'documents.attachment_path as attachment_path', 'documents.date as date',  'documents.number as number', 'documents.title as title', 'users.name as uname')
                ->paginate($per_page);
            return FarwardedDocumentResource::collection($data);
        }

        if ($currentUser->user_type == 'department_user') {
            $data =  FarwardDocument::query()
                ->where('farward_documents.farwarded_part', '=', $currentUser->department_id)
                ->where('farward_documents.status', '=', 1)
                ->join('documents', 'farward_documents.document_id', 'documents.id')
                ->join('users', 'farward_documents.user_id', 'users.id')
                ->join('departments', '')
                ->select('farward_documents.*', 'documents.id as document_id', 'documents.attachment_path as attachment_path', 'documents.date as date',  'documents.number as number', 'documents.title as title', 'users.name as uname')
                ->paginate($per_page);
            return FarwardedDocumentResource::collection($data);
        }
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'number' => 'required|max:100',
            'source' => 'required|string',
            'destination' => 'required|string',
            'type' => 'required',
            'date' => 'required|max:100',
            'attachment' => 'required|mimes:pdf,png,jpg,jpeg,gif',
            'remark' => 'required|string',
            'description' => 'nullable|string',
            // 'part_type' => 'nullabe|string',
            'farwarded_parts.*' => 'nullable|string',
        ]);

        DB::beginTransaction(); //
        try {

            $attachment = null;
            $attachment_path = null;
            // for documentation clearance must store according to name of the department or faculty
            $attachment = $request->attachment->store('/', "document/attachment");
            $attachment_path = asset(Storage::url("document/attachment/" . $attachment));
            $user = Auth::user();
            $document = new Document();
            $document->number = $request->number;
            $document->title = $request->title;
            $document->source = $request->source;
            $document->destination = $request->destination;
            $document->date = $request->date;
            $document->type = $request->type;
            $document->part_type = $request->department_part;
            $document->user_id = $user->id;
            $document->attachment = $attachment;
            $document->attachment_path = $attachment_path;
            $document->remark = $request->remark;
            $document->description = $request->description;

            if ($user->user_type == 'faculty_user') {
                $document->faculty_id = $user->faculty_id;
            }
            if ($user->user_type == 'fifth_department') {
                $document->dep_id = $user->dep_id;
            }
            if ($user->user_type == 'department_user') {
                $document->department_id = $user->department_id;
            }

            $result =  $document->save();
            $document_id = $document->id;

            if ($request->department_part == 'all') {
                $faculties = Faculty::all();
                $fifth_departments = Chance_Amiryat::all();
                $common_departments = Department::where('faculty_id', '=', null)->get();
                $departments = Department::where('faculty_id', '<>', null)->get();

                foreach ($faculties as $faculty) {
                    if ($user->faculty_id != $faculty->id) {
                        $document_farwarded = new FarwardDocument();
                        $document_farwarded->document_id = $document_id;
                        $document_farwarded->user_id = $user->id;
                        $document_farwarded->farwarded_part = $faculty->id;
                        $result = $document_farwarded->save();
                    }
                }

                foreach ($fifth_departments as $fifth_department) {
                    if ($user->dep_id != $fifth_department->id) {
                        $document_farwarded = new FarwardDocument();
                        $document_farwarded->document_id = $document_id;
                        $document_farwarded->user_id = $user->id;
                        $document_farwarded->farwarded_part = $fifth_department->id;
                        $result = $document_farwarded->save();
                    }
                }

                foreach ($common_departments as $common_department) {
                    if ($user->deaprtment_id != $common_department->id) {
                        $document_farwarded = new FarwardDocument();
                        $document_farwarded->document_id = $document_id;
                        $document_farwarded->user_id = $user->id;
                        $document_farwarded->farwarded_part = $common_department->id;
                        $result = $document_farwarded->save();
                    }
                }

                // foreach ($departments as $department) {
                //     if ($user->department_id != $department->id) {
                //         $document_farwarded = new FarwardDocument();
                //         $document_farwarded->document_id = $document_id;
                //         $document_farwarded->user_id = $user->id;
                //         $document_farwarded->farwarded_part = $department->id;
                //         $result = $document_farwarded->save();
                //     }
                // }
            }

            if ($request->type == 'صادره' && $request->department_part != 'all') {

                //  farwarded parts
                foreach ($request->farwarded_parts as $farwarded_part) {
                    if ($user->faculty_id != $farwarded_part || $user->dep_id != $farwarded_part || $user->department_id != $farwarded_part) {
                        $document_farwarded = new FarwardDocument();
                        $document_farwarded->document_id = $document_id;
                        $document_farwarded->user_id = $user->id;
                        $document_farwarded->farwarded_part = $farwarded_part;
                        $result = $document_farwarded->save();
                    }
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }

        if ($result) {
            return response([
                "message" => "مکتوب موفقانه ذخیره گردید"
            ], 200);
        } else {
            return response([
                "error" => "مکتوب موفقانه ذخیره نشد"
            ], 304);
        }
    }

    public function SaveAsEnterDocument(Request $request)
    {

        $request->validate([
            'date' => 'required|date',
            'remark' => 'required',
            'number' => 'required'
        ], [
            'number.required' => 'شماره مکتوب الزامی می باشد ',
            'date.required' => 'تاریخ الزامی می باشد ',
            'remark.required' => 'ملاحظات الزامی می باشد'
        ]);
        DB::beginTransaction();
        try {

            $user = Auth::user();
            $farwarded_doc = FarwardDocument::find($request->farward_id);
            $document = Document::find($request->d_id);
            $newDocument = new Document();
            $newDocument->number = $request->number;
            $newDocument->title = $document->title;
            $newDocument->source = $document->source;
            $newDocument->destination = $document->destination;
            $newDocument->date = $document->date;
            $newDocument->type = 'وارده';
            $newDocument->part_type = $document->department_part;
            $newDocument->user_id = $user->id;
            $newDocument->attachment = $document->attachment;
            $newDocument->attachment_path = $document->attachment_path;
            $newDocument->remark = $request->remark;

            $newDocument->description = $request->description;
            if ($user->user_type == 'faculty_user') {
                $newDocument->faculty_id = $user->faculty_id;
            }
            if ($user->user_type == 'fifth_department') {
                $newDocument->dep_id = $user->dep_id;
            }
            if ($user->user_type == 'department_user') {
                $newDocument->department_id = $user->department_id;
            }

            if ($user->user_type == 'common_department_user') {
                $newDocument->department_id = $user->department_id;
            }

            $newDocument->save();
            $farwarded_doc->status = '2';
            $result = $farwarded_doc->save();

            DB::commit();

            if ($result) {
                return response([
                    "message" => "مکتوب موفقنانه ��خیره گردید"
                ], 200);
            } else {
                return response([
                    "error" => "مکتوب موفقنانه ��خیره نشد"
                ], 304);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }







    public function destroy($id)
    {
        $document = Document::find($id);
        if (is_file(storage_path('app/public/document/attachment/' . $document->attachment))) {
            unlink(storage_path('app/public/document/attachment/' . $document->attachment));
        }

        $result = $document->delete();
        return  $result;
    }
}
