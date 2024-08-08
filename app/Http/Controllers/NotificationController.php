<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FarwardDocument;
use App\Http\Resources\FarwardedDocumentResource;


class NotificationController extends Controller
{



    public function Notify()
    {
        $currentUser = Auth::user();
        if ($currentUser->user_type == 'faculty_user') {
            $data  =  FarwardDocument::query()
                ->where('farward_documents.farwarded_part', '=', $currentUser->faculty_id)
                ->where('farward_documents.status', '=', 0)
                ->join('documents', 'farward_documents.document_id', 'documents.id')
                ->join('users', 'farward_documents.user_id', 'users.id')
                ->join('faculties', 'farward_documents.farwarded_part', '=', 'faculties.id')
            ->select('farward_documents.*', 'documents.attachment_path as attachment_path', 'documents.date as date', 'documents.number as number', 'documents.title as title', 'users.name as uname', 'users.photo_path as photo_path', 'faculties.name  as cname',)
                ->get();
            return FarwardedDocumentResource::collection($data);
        }

        if ($currentUser->user_type == 'fifth_department') {
            $data  =  FarwardDocument::query()
                ->where('farward_documents.farwarded_part', '=', $currentUser->dep_id)
                ->where('farward_documents.status', '=', 0)
                ->join('documents', 'farward_documents.document_id', 'documents.id')
                ->join('users', 'farward_documents.user_id', 'users.id')
                ->join('chance__amiryats', 'farward_documents.farwarded_part', '=', 'chance__amiryats.id')
                ->select('farward_documents.*', 'documents.attachment_path as attachment_path', 'documents.number as number', 'documents.date as date', 'documents.title as title', 'users.name as uname', 'users.photo_path as photo_path', 'chance__amiryats.display_name  as cname',)
                ->get();
            return FarwardedDocumentResource::collection($data);
        }

        if ($currentUser->user_type == 'department_user') {
            $data  =  FarwardDocument::query()
                ->where('farward_documents.farwarded_part', '=', $currentUser->department_id)
                ->where('farward_documents.status', '=', 0)
                ->join('documents', 'farward_documents.document_id', 'documents.id')
                ->join('users', 'farward_documents.user_id', 'users.id')
                ->join('departments', 'farward_documents.farwarded_part', '=', 'departments.id')
                ->select('farward_documents.*', 'documents.attachment_path as attachment_path', 'documents.number as number', 'documents.title as title', 'documents.date as date', 'users.name as uname', 'users.photo_path as photo_path', 'departments.name  as cname',)
                ->get();
            return FarwardedDocumentResource::collection($data);
        }

        if ($currentUser->user_type == 'common_department_user') {
            $data  =  FarwardDocument::query()
                ->where('farward_documents.farwarded_part', '=', $currentUser->department_id)
                ->where('farward_documents.status', '=', 0)
                ->join('documents', 'farward_documents.document_id', 'documents.id')
                ->join('users', 'farward_documents.user_id', 'users.id')
                ->join('departments', 'farward_documents.farwarded_part', '=', 'departments.id')
                ->select('farward_documents.*', 'documents.attachment_path as attachment_path', 'documents.number as number', 'documents.title as title', 'documents.date as date', 'users.name as uname', 'users.photo_path as photo_path', 'departments.name  as cname',)
                ->get();
            return FarwardedDocumentResource::collection($data);
        }
    }

    public function countNotification()
    {
        $currentUser  = Auth::user();
        if ($currentUser->user_type == 'faculty_user') {
            $counter =  FarwardDocument::where('status', '=', 0)->where('farwarded_part', '=', $currentUser->faculty_id)->get()->count();
            return $counter;
        } else if ($currentUser->user_type == 'fifth_department') {
            $counter =  FarwardDocument::where('status', '=', 0)->where('farwarded_part', '=', $currentUser->dep_id)->get()->count();
            return $counter;
        } else if ($currentUser->user_type == 'department_user') {
            $counter =  FarwardDocument::where('status', '=', 0)->where('farwarded_part', '=', $currentUser->department_id)->get()->count();
            return $counter;
        } else if ($currentUser->user_type == 'common_department_user') {
            $counter =  FarwardDocument::where('status', '=', 0)->where('farwarded_part', '=', $currentUser->department_id)->get()->count();
            return $counter;
        }
    }

    public function updateNotification($id)
    {
        $notification = FarwardDocument::find($id);
        $notification->status = '1';
        $result =  $notification->save();
        if ($result) {
            return response([
                'message' => $result
            ], 200);
        }
    }
}
