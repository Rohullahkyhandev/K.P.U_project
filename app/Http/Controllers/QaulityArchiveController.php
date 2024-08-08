<?php

namespace App\Http\Controllers;

use App\Http\Resources\QualityArchiveResource;
use App\Models\QualityArichve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class QaulityArchiveController extends Controller
{
    public function index()
    {
        $per_page = request('per_page', 10);
        $search  =  request('search', '');
        $sortField  = request('sortField', 'id');
        $sortDirection  = request('sortDirection', 'DESC');

        $data = QualityArichve::query()
            ->whereAny([
                'quality_arichves.date',
                'quality_arichves.type',
            ], 'LIKE', "%{$search}%")
            ->join('users', 'quality_arichves.user_id', 'users.id')
            ->select('quality_arichves.*', 'users.name as uname')
            ->orderBy("quality_arichves.$sortField", $sortDirection)
            ->paginate($per_page);
        return QualityArchiveResource::collection($data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'date' => 'required',
            'type' => 'required',
            'description' => 'required',
            'attachment' => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'year.required' => "فیلد سال  الزامی می باشد",
            'related_part.required' => "فیلد بخش مربوط  الزامی می باشد",
            'number.required' => "فیلد شماره میعار  الزامی می باشد",
            'attachment.mimes' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"
        ]);
        $attachment = null;
        $attachment_path = null;
        if ($request->attachment != '') {
            $attachment = $request->attachment->store('/', 'quality_assurance/archive');
            $attachment_path = asset(Storage::url('quality_assurance/archive' . $attachment));
        }
        $user_id = Auth::id();
        $archive = new QualityArichve();
        $archive->date = $request->date;
        $archive->type = $request->type;
        $archive->description = $request->description;
        $archive->attachment = $attachment;
        $archive->attachment_path = $attachment_path;
        $archive->user_id = $user_id;
        $result = $archive->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات  موفقانه ذخیره گردید'
            ], 200);
        } else {
            return response([
                'error' => 'اطلاعات  ذخیره نشد دوباره تلاش نماید'
            ], 304);
        }
    }


    public function edit($id = '')
    {
        $data = QualityArichve::find($id);
        return $data;
    }

    public function update(Request $request)
    {

        $request->validate([
            'date' => 'required',
            'type' => 'required',
            'description' => 'required',
            'attachment' => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'year.required' => "فیلد سال  الزامی می باشد",
            'related_part.required' => "فیلد بخش مربوط  الزامی می باشد",
            'number.required' => "فیلد شماره میعار  الزامی می باشد",
            'attachment.mimes' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"
        ]);

        $id = $request->id;
        $archive =  QualityArichve::find($id);
        $attachment = $archive->attachment;
        $attachment_path = $archive->attachment_path;
        if ($request->attachment != '') {
            if (is_file(storage_path('/app/public/quality_assurance/archive/' . $attachment))) {
                unlink(storage_path('/app/public/quality_assurance/archive/' . $attachment));
            }
            $attachment = $request->attachment->store('/', 'quality_assurance/archive');
            $attachment_path = asset(Storage::url('quality_assurance/archive/' . $attachment));
        }
        $user_id = Auth::id();
        $archive->date = $request->date;
        $archive->description = $request->description;
        $archive->type = $request->type;
        $archive->attachment = $attachment;
        $archive->attachment_path = $attachment_path;
        $archive->user_id = $user_id;
        $result = $archive->save();

        if ($result) {
            return response([
                'message' => ' موفقانه ویرایش گردید  '
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات   ویرایش نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function destroy($id = '')
    {
        $criteria = QualityArichve::find($id);
        if (is_file(storage_path('/app/public/quality_assurance/archive/' . $criteria->attachment))) {
            unlink(storage_path('/app/public/quality_assurance/archive/' . $criteria->attachment));
        }
        $result = QualityArichve::destroy($id);
        return $result;
    }
}
