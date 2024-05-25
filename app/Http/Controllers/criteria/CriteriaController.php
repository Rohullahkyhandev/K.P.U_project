<?php

namespace App\Http\Controllers\criteria;

use App\Http\Controllers\Controller;
use App\Http\Resources\CriteriaResource;
use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CriteriaController extends Controller
{

    public function index()
    {
        $per_page = request('per_page', 10);
        $search  =  request('search', '');
        $sortField  = request('sortField', 'id');
        $sortDirection  = request('sortDirection', 'DESC');

        $data = Criteria::query()
            ->where('criterias.year', 'like', "%{$search}%")
            ->join('users', 'criterias.user_id', 'users.id')
            ->select('criterias.*', 'users.name as uname')
            ->orderBy("criterias.$sortField", $sortDirection)
            ->paginate($per_page);
        return CriteriaResource::collection($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'description' => 'required',
            'attachment' => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'year.required' => "فیلد سال  الزامی می باشد",
            'attachment.mimes' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"
        ]);
        $attachment = null;
        $attachment_path = null;
        if ($request->attachment != '') {
            $attachment = $request->attachment->store('/', 'quality_assurance/document');
            $attachment_path = asset(Storage::url('quality_assurance/document' . $attachment));
        }
        $user_id = Auth::id();
        $criteria = new Criteria();
        $criteria->year = $request->year;
        $criteria->description = $request->description;
        $criteria->attachment = $attachment;
        $criteria->attachment_path = $attachment_path;
        $criteria->user_id = $user_id;
        $result = $criteria->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات  موفقانه ذخیره گردید'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات  ذخیره نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function getAllCriteria()
    {
        $data = Criteria::all();
        return $data;
    }

    public function edit($id = '')
    {
        $data = Criteria::find($id);
        return $data;
    }

    public function update(Request $request)
    {

        $request->validate([
            'year' => 'required',
            'description' => 'nullable',
            'attachment' => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'year.required' => "فیلد  سال الزامی می باشد",
            'attachment' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"
        ]);

        $id = $request->id;
        $criteria =  Criteria::find($id);
        $attachment = $criteria->attachment;
        $attachment_path = $criteria->attachment_path;
        if ($request->attachment != '') {
            if (is_file(storage_path('/app/public/quality_assurance/document/' . $attachment))) {
                unlink(storage_path('/app/public/quality_assurance/document/' . $attachment));
            }
            $attachment = $request->attachment->store('/', 'quality_assurance/document');
            $attachment_path = asset(Storage::url('quality_assurance/document/' . $attachment));
        }
        $user_id = Auth::id();
        $criteria->year = $request->year;
        $criteria->description = $request->description;
        $criteria->attachment = $attachment;
        $criteria->attachment_path = $attachment_path;
        $criteria->user_id = $user_id;
        $result = $criteria->save();

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
        $criteria = Criteria::find($id);
        if (is_file(storage_path('/app/public/quality_assurance/document/' . $criteria->attachment))) {
            unlink(storage_path('/app/public/quality_assurance/document/' . $criteria->attachment));
        }
        $result = Criteria::destroy($id);
        return $result;
    }
}
