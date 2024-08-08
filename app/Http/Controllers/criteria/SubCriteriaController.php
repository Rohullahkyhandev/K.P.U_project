<?php

namespace App\Http\Controllers\criteria;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubCriteriaResource;
use App\Models\SubCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubCriteriaController extends Controller
{
    public function index()
    {
        $criteria_id = request('id');
        $per_page = request('per_page', 10);
        $search  =  request('search', '');
        $sortField  = request('sortField', 'id');
        $sortDirection  = request('sortDirection', 'DESC');
        $year = date('Y');
        $year = $year - 621;

        $data = SubCriteria::query()
            ->where('sub_criterias.number', 'like', "%{$search}%")
            ->join('criterias', 'sub_criterias.criteria_id', 'criterias.id')
            ->join('users', 'sub_criterias.user_id', 'users.id')
            ->where('sub_criterias.criteria_id', '=', $criteria_id)
            ->select('sub_criterias.*', 'users.name as uname', 'criterias.number as number', 'criterias.year as year')
            ->orderBy("sub_criterias.$sortField", $sortDirection)
            ->paginate($per_page);
        return SubCriteriaResource::collection($data);
    }


    public function store(Request $request)
    {

        // return $request->criteria_id;
        $request->validate([
            'number' => 'required',
            'criteria_id' => 'required',
            'description' => 'required',
            'related_part' => 'required',
            'attachment' => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'number.required' => "فیلد شماره معیار  الزامی می باشد",
            'criteria_id.required' => "فیلد  معیار اصلی الزامی می باشد",
            'related_part.required' => "فیلد بخش مربوط الزامی می باشد",
            'attachment.mimes' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"
        ]);

        $attachment = null;
        $attachment_path = null;
        if ($request->attachment != '') {
            $attachment = $request->attachment->store('/', 'quality_assurance/sub_document');
            $attachment_path = asset(Storage::url('quality_assurance/sub_document' . $attachment));
        }
        $user_id = Auth::id();
        $sub_criteria = new SubCriteria();
        $sub_criteria->number = $request->number;
        $sub_criteria->criteria_id = $request->criteria_id;
        $sub_criteria->description = $request->description;
        $sub_criteria->related_part = $request->related_part;
        $sub_criteria->attachment = $attachment;
        $sub_criteria->attachment_path = $attachment_path;
        $sub_criteria->user_id = $user_id;
        $result = $sub_criteria->save();

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



    public function edit()
    {
        $id = request('id');
        $data = SubCriteria::find($id);
        return $data;
    }

    public function update(Request $request)
    {

        $request->validate([
            'number' => 'required',
            'related_part' => 'required',
            'description' => 'nullable',
            'attachment' => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'number.required' => "فیلد  شماره معیار الزامی می باشد",
            'related_part.required' => "فیلد بخش مربوط الزامی می باشد",
            'attachment' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"
        ]);

        $id = $request->id;
        $sub_criteria =  SubCriteria::find($id);
        $attachment = $sub_criteria->attachment;
        $attachment_path = $sub_criteria->attachment_path;
        if ($request->attachment != '') {
            if (is_file(storage_path('/app/public/quality_assurance/sub_document/' . $attachment))) {
                unlink(storage_path('/app/public/quality_assurance/sub_document/' . $attachment));
            }
            $attachment = $request->attachment->store('/', 'quality_assurance/sub_document');
            $attachment_path = asset(Storage::url('quality_assurance/sub_document/' . $attachment));
        }
        $user_id = Auth::id();
        $sub_criteria->number = $request->number;
        $sub_criteria->sub_criteria_id = $request->sub_criteria_id;
        $sub_criteria->description = $request->description;
        $sub_criteria->related_part = $request->related_part;
        $sub_criteria->attachment = $attachment;
        $sub_criteria->attachment_path = $attachment_path;
        $sub_criteria->user_id = $user_id;
        $result = $sub_criteria->save();

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
        $sub_criteria = SubCriteria::find($id);
        if (is_file(storage_path('/app/public/quality_assurance/sub_document/' . $sub_criteria->attachment))) {
            unlink(storage_path('/app/public/quality_assurance/sub_document/' . $sub_criteria->attachment));
        }
        $result = SubCriteria::destroy($id);
        return $result;
    }
}
