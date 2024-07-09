<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentResource;
use App\Http\Resources\FarwardedDocumentResource;
use App\Models\Chance_Amiryat;
use App\Models\Department;
use App\Models\Document;
use App\Models\Faculty;
use App\Models\FarwardDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{



    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $currentUser = Auth::user();
        $document_view = false;
        $document_edit = false;
        $document_delete = false;
        $document_create = false;
        // all the staff about
        // foreach (Auth::user()->permissions as $permission) {
        //     if ($permission == 'document_create') {
        //         $document_create = true;
        //     } else if ($permission == 'document_view') {
        //         $document_view = true;
        //     } else if ($permission == 'document_edit') {
        //         $document_view = true;
        //     } else {
        //         $document_delete = true;
        //     }
        // }

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
                ->select('farward_documents.*', 'documents.attachment_path as attachment_path', 'documents.number as number', 'documents.title as title',  'users.name as uname')
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
                ->select('farward_documents.*', 'documents.attachment_path as attachment_path',  'documents.number as number', 'documents.title as title', 'users.name as uname')
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
            if ($request->type == 'صادره') {
                //  farwarded parts
                foreach ($request->farwarded_parts as $farwarded_part) {
                    $document_farwarded = new FarwardDocument();
                    $document_farwarded->document_id = $document_id;
                    $document_farwarded->user_id = $user->id;
                    $document_farwarded->farwarded_part = $farwarded_part;
                    $result = $document_farwarded->save();
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }

        if ($result) {
            return response([
                "message" => "مکتوب موفقنانه ذخیره گردید"
            ], 200);
        } else {
            return response([
                "error" => "مکتوب موفقنانه ذخیره نشد"
            ], 304);
        }
    }
}
