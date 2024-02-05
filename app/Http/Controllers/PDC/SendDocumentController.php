<?php

namespace App\Http\Controllers\PDC;

use App\Http\Controllers\Controller;
use App\Http\Resources\SendDocumentResource;
use App\Models\SendDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;

class SendDocumentController extends Controller
{

    public function validation()
    {
        $rules = [
            'source' => 'required|string|max:100',
            'destination' => 'required|string|max:100',
            'remark' => 'required|string|max:100',
            'description' => 'nullable|string',
            'serial_no' => 'required|max:100',
            'pages_no' => 'required|max:100',
            'volume' => 'required|max:100',
            'perform_branch' => 'required|string|max:100',
            'attachment_branch' => 'required|string|max:100',
            'date_of_sent' => 'required|max:100',
            'document_date' => 'required|max:100',
            'attachment' => 'nullable|mimes:jpg,png,pdf',
        ];

        return $rules;
    }

    public function index()
    {
        $per_page = request('per_page', 10);
        $search  =  request('search', '');
        $sortField  = request('sortField', 'id');
        $sortDirection  = request('sortDirection', 'DESC');

        $data = SendDocument::query()
            ->where('send_documents.document_date', 'like', "%{$search}%")
            ->join('users', 'send_documents.user_id', 'users.id')
            ->select('send_documents.*', 'users.name as uname')
            ->orderBy("send_documents.$sortField", $sortDirection)
            ->paginate($per_page);
        return SendDocumentResource::collection($data);
    }

    public function store(Request $request)
    {
        $result = 0;
        $rules = $this->validation();
        Validator::make($request->all(), $rules)->validate();
        $attachment = null;
        $attachment_path = null;
        if ($request->attachment) {
            $attachment = $request->attachment->store('/', 'send_document');
            $attachment_path = asset(Storage::url('send_document/' . $attachment));
        }
        $user_id = Auth::id();
        $sendDocument = new SendDocument();
        $sendDocument->source = $request->source;
        $sendDocument->destination = $request->destination;
        $sendDocument->remark = $request->remark;
        $sendDocument->description = $request->description;
        $sendDocument->serial_no = $request->serial_no;
        $sendDocument->perform_branch = $request->perform_branch;
        $sendDocument->attachment_branch = $request->attachment_branch;
        $sendDocument->pages_no = $request->pages_no;
        $sendDocument->volume = $request->volume;
        $sendDocument->date_of_sent = $request->date_of_sent;
        $sendDocument->document_date = $request->document_date;
        $sendDocument->attachment = $attachment;
        $sendDocument->attachment_path = $attachment_path;
        $sendDocument->user_id = $user_id;
        $result = $sendDocument->save();

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
        return SendDocument::find($id);
    }

    public function update(Request $request)
    {

        $result = 0;
        $rules = $this->validation();
        DB::beginTransaction();
        try {
            Validator::make($request->all(), $rules)->validate();
            $sendDocument = SendDocument::find($request->id);
            $attachment = $sendDocument->attachment;
            $attachment_path = $sendDocument->attachment_path;
            if ($request->attachment != '') {
                if (is_file(storage_path('app/public/send_document/' . $sendDocument->attachment))) {
                    unlink(storage_path('app/public/send_document/' . $sendDocument->attachment));
                }
                $attachment = $request->attachment->store('/', 'send_document');
                $attachment_path = asset(Storage::url('send_document/' . $attachment));
            }

            $user_id = Auth::id();
            SendDocument::find($request->id)->update([
                'serial_no' => $request->serial_no,
                'source' => $request->source,
                'destination' => $request->destination,
                'remark' => $request->remark,
                'description' =>  $request->description,
                'perform_branch' => $request->perform_branch,
                'attachment_branch' => $request->attachment_branch,
                'pages_no' => $request->pages_no,
                'volume' => $request->volume,
                'date_of_sent' => $request->date_of_sent,
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
        $sendDocument = SendDocument::find($id);
        $result = SendDocument::destroy($id);
        if ($result) {
            if (storage_path('/app/public/received_document/' . $sendDocument->attachment)) {
                unlink(storage_path('/app/public/received_document/' . $sendDocument->attachment));
            }
        }
        return $result;
    }
}
