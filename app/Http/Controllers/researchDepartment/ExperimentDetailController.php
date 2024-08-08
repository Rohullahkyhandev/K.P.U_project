<?php

namespace App\Http\Controllers\researchDepartment;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExperimentDetailResource;
use App\Models\ExperimentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExperimentDetailController extends Controller
{


    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data = ExperimentDetail::query()
            ->where('experiment_details.experiment_name', 'like', "%{$search}%")
            ->orWhere('experiment_details.related_part', 'like', "%{$search}%")
            ->join('users', 'experiment_details.user_id', 'users.id')
            ->join('reasearch_labs', 'experiment_details.lab_id', 'reasearch_labs.id')
            ->select('experiment_details.*', 'reasearch_labs.lab_name as lab_name', 'users.name as uname')
            ->orderBy("experiment_details.$sortField", $sortDirection)
            ->paginate($per_page);

        return ExperimentDetailResource::collection($data);
    }




    public function store(Request $request)
    {

        $request->validate([
            'experiment_name' => 'required',
            'related_part' => 'required',
            'related_image' => 'required|mimes:png,jpg,jpeg,gif,pdf|max:8000',
            'standard_id' => 'required',
            'scope_part' => 'required',
            'lab_id' => 'required',
        ], [
            'experiment_name' => 'فیلد آزمایش الزامی میباشد',
            'related_part' => 'فیلد بخش مربوط الزامی می باشد',
            'experiment_part' => 'فیلد بخش آزمایش الزامی میباشد',
            'related_image.mimes' => 'تصاویر مرتبط باید یکی از این فارمت ها را داشته باشد: jpg,jpg,png,gif,pdf',
            'related_image.size' => 'جحم تصاویر باید از 6 MB بالا نباشد',
            'standard_id.required' => 'آدی استاندارد الزامی میباشد',
            'lab_id.required' => 'لابراتوار مربط الزامی میباشد'
        ]);

        $image = null;
        $image_path = null;
        if ($request->related_image != '') {
            $image = $request->related_image->store('/', 'research_department/experiment_details_images');
            $image_path = asset(Storage::url('research_department/experiment_details_images/' . $image));
        }
        $user_id = Auth::id();
        $experiment_detail  = new ExperimentDetail();
        $experiment_detail->experiment_name = $request->experiment_name;
        $experiment_detail->related_part = $request->related_part;
        $experiment_detail->related_image = $image;
        $experiment_detail->related_image_path = $image_path;
        $experiment_detail->standard_id = $request->standard_id;
        $experiment_detail->scope_part = $request->scope_part;
        $experiment_detail->lab_id = $request->lab_id;
        $experiment_detail->user_id  = $user_id;
        $result = $experiment_detail->save();

        if ($result) {
            return response([
                "message" => "اطلاعات موفقانه ذخیره گردید"
            ], 200);
        } else {
            return response([
                "error" => "اطلاعات موفقانه ذخیره  نشد, دوباره تلاش نماید"
            ], 304);
        }
    }


    public function edit($id)
    {
        return ExperimentDetail::find($id);
    }


    public function update(Request $request)
    {

        $request->validate([
            'experiment_name' => 'required',
            'related_part' => 'required',
            'related_image' => 'nullable|mimes:png,jpg,jpeg,gif,pdf|max:8000',
            'standard_id' => 'required',
            'scope_part' => 'required',
            'lab_id' => 'required',
        ], [
            'experiment_name' => 'فیلد آزمایش الزامی میباشد',
            'experiment_part' => 'فیلد بخش آزمایش الزامی میباشد',
            'related_image.mimes' => 'تصاویر مرتبط باید یکی از این فارمت ها را داشته باشد: jpg,jpg,png,gif,pdf',
            'related_image.max' => 'جحم تصاویر باید از ۸ MB بالا نباشد',
            'standard_id.required' => 'آدی استاندارد الزامی میباشد',
            'lab_id.required' => 'لابراتوار مربط الزامی میباشد'
        ]);


        $experiment_detail = ExperimentDetail::find($request->id);

        $image = $experiment_detail->related_image;
        $image_path = $experiment_detail->related_image_path;

        if ($request->related_image != '') {
            if (is_file(storage_path('app/public/research_department/experiment_details_images/' . $image))) {
                Storage::delete('app/public/research_department/experiment_details_images/' . $image);
            }
            $image = $request->related_image->store('/', 'research_department/experiment_details_images');
            $image_path = asset(Storage::url('research_department/experiment_details_images/' . $image));
        }
        $user_id = Auth::id();
        $experiment_detail->experiment_name = $request->experiment_name;
        $experiment_detail->related_part = $request->related_part;
        $experiment_detail->related_image = $image;
        $experiment_detail->related_image_path = $image_path;
        $experiment_detail->standard_id = $request->standard_id;
        $experiment_detail->scope_part = $request->scope_part;
        $experiment_detail->lab_id = $request->lab_id;
        $experiment_detail->user_id  = $user_id;
        $result = $experiment_detail->save();


        if ($result) {
            return response([
                "message" => "اطلاعات موفقانه ویرایش گردید"
            ], 200);
        } else {
            return response([
                "error" => "اطلاعات موفقانه ویرایش  نشد, دوباره تلاش نماید"
            ], 304);
        }
    }

    public function destroy($id)
    {
        $experiment_detail = ExperimentDetail::find($id);
        if (is_file(storage_path('app/public/research_departments/experiment_details_images/' . $experiment_detail->image))) {
            Storage::delete('app/public/research_departments/experiment_details_images/' . $experiment_detail->image);
        }
        $result = $experiment_detail->delete();

        return response([
            "message" => $result
        ], 204);
    }
}
