<?php

namespace App\Http\Controllers\PDC;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReceivedDocumentResource;
use App\Models\ReceivedDocument;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;

class ReceivedController extends Controller
{


    public function validation()
    {
        $rules = [
            'source' => 'required|string|max:100',
            'destination' => 'required|string|max:100',
            'remark' => 'required|string|max:100',
            'description' => 'nullable|string',
            'iqdam_no' => 'required|max:100',
            'pages_no' => 'required|max:100',
            'volume' => 'required|max:100',
            'entered_no' => 'required|max:100',
            'date_of_entered' => 'required|max:100',
            'document_date' => 'required|max:100',
            'attachment' => 'required|mimes:jpg,png,pdf',
        ];

        return $rules;
    }

    public function index()
    {
        $per_page = request('per_page', 10);
        $search  =  request('search', '');
        $sortField  = request('sortField', 'id');
        $sortDirection  = request('sortDirection', 'DESC');

        $data = ReceivedDocument::query()
            ->where('received_documents.document_date', 'like', "%{$search}%")
            ->join('users', 'received_documents.user_id', 'users.id')
            ->select('received_documents.*', 'users.name as uname')
            ->orderBy("received_documents.$sortField", $sortDirection)
            ->paginate($per_page);
        return ReceivedDocumentResource::collection($data);
    }

    public function store(Request $request)
    {
        $result = 0;
        $rules = $this->validation();
        Validator::make($request->all(), $rules)->validate();
        $attachment = null;
        $attachment_path = null;
        if ($request->attachment) {
            $attachment = $request->attachment->store('/', 'received_document');
            $attachment_path = asset(Storage::url('received_document/' . $attachment));
        }
        $user_id = Auth::id();
        $receivedDocument = new ReceivedDocument();
        $receivedDocument->source = $request->source;
        $receivedDocument->destination = $request->destination;
        $receivedDocument->remark = $request->remark;
        $receivedDocument->description = $request->description;
        $receivedDocument->iqdam_no = $request->iqdam_no;
        $receivedDocument->entered_no = $request->entered_no;
        $receivedDocument->pages_no = $request->pages_no;
        $receivedDocument->volume = $request->volume;
        $receivedDocument->date_of_entered = $request->date_of_entered;
        $receivedDocument->document_date = $request->document_date;
        $receivedDocument->attachment = $attachment;
        $receivedDocument->attachment_path = $attachment_path;
        $receivedDocument->user_id = $user_id;
        $result = $receivedDocument->save();

        if ($result) {
            return response([
                'message' => 'موفقانه ذخیره گرید'
            ], 200);
        } else {
            return response([
                'error' => 'ذخیره نشد دوباره تلاش نماید'
            ], 403);
        }
    }

    public function edit($id = '')
    {
        return ReceivedDocument::find($id);
    }

    public function update(Request $request)
    {

        $result = 0;
        $rules = $this->validation();
        DB::beginTransaction();
        try {
            Validator::make($request->all(), $rules)->validate();
            $receivedDocument = ReceivedDocument::find($request->id);
            $attachment = $receivedDocument->attachment;
            $attachment_path = $receivedDocument->attachment_path;
            if (is_file(storage_path('app/public/received_document/' . $receivedDocument->attachment))) {
                unlink(storage_path('app/public/received_document/' . $receivedDocument->attachment));
                $attachment = $request->attachment->store('/', 'received_document');
                $attachment_path = asset(Storage::url('received_document/' . $attachment));
            }

            $user_id = Auth::id();
            ReceivedDocument::find($request->id)->update([
                'source' => $request->source,
                'destination' => $request->destination,
                'remark' => $request->remark,
                'description' =>  $request->description,
                'iqdam_no' => $request->iqdam_no,
                'entered_no' => $request->entered_no,
                'pages_no' => $request->pages_no,
                'volume' => $request->volume,
                'date_of_entered' => $request->date_of_entered,
                'document_date' => $request->document_date,
                'attachment' => $attachment,
                'attachment_path' => $attachment_path,
                'user_id' => $user_id
            ]);
            DB::commit();
            $result = 1;
        } catch (Exception $e) {
            $result = 0;
            DB::rollBack();
            return $e;
        }

        if ($result) {
            return response([
                'message' => 'ویرایش موفقانه انجام شد'
            ]);
        }
    }


    public function destroy($id = '')
    {
        $receivedDocument = ReceivedDocument::find($id);
        if (storage_path('/app/public/received_document/' . $receivedDocument->attachment)) {
            unlink(storage_path('/app/public/received_document/' . $receivedDocument->attachment));
        }
        $result = ReceivedDocument::destroy($id);
        return $result;
    }
}
