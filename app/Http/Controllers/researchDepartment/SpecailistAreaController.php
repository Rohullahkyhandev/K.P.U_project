<?php

namespace App\Http\Controllers\researchDepartment;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpecailistAreaResource;
use App\Models\SpecailistArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecailistAreaController extends Controller
{



    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data = SpecailistArea::query()
            ->where('specailist_areas.related_part', 'like', "%{$search}%")
            ->orWhere('specailist_areas.related_field', 'like', "%{$search}%")
            ->join('users', 'specailist_areas.user_id', 'users.id')
            ->select('specailist_areas.*', 'users.name as uname')
            ->orderBy("specailist_areas.$sortField", $sortDirection)
            ->paginate($per_page);

        return SpecailistAreaResource::collection($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'related_part' => 'required',
            'related_field' => 'required',
        ], [
            'related_part.required' => 'فلید بخش مربوطه الزامی می باشد',
            'related_field.required' => 'فلید ریشته مربوطه الزامی می باشد',
        ]);


        $user_id = Auth::user()->id;
        $specailist_area = new SpecailistArea();
        $specailist_area->related_part = $request->related_part;
        $specailist_area->related_field = $request->related_field;
        $specailist_area->user_id = $user_id;
        $result =  $specailist_area->save();

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'اطلاعات با موفقیت ذخیره شد',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'اطلاعات ذخیره نشد دوباره تلاش نمایید',
            ]);
        }
    }


    public function edit($id)
    {
        $data = SpecailistArea::find($id);
        return $data;
    }

    public function update(Request $request)
    {
        $request->validate([
            'related_part' => 'required',
            'related_field' => 'required',
        ], [
            'related_part.required' => 'فلید بخش مربوطه الزامی می باشد',
            'related_field.required' => 'فلید ریشته مربوطه الزامی می باشد',
        ]);

        $specailist_area = SpecailistArea::find($request->id);
        $specailist_area->related_part = $request->related_part;
        $specailist_area->related_field = $request->related_field;
        $result =  $specailist_area->save();

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'اطلاعات با موفقیت ذخیره شد',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'اطلاعات ذخیره نشد دوباره تلاش نمایید',
            ]);
        }
    }

    public function destroy($id)
    {
        $result = SpecailistArea::destroy($id);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'اطلاعات با موفقیت حذف گردید',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'اطلاعات حذف نشد دوباره تلاش نمایید',
            ]);
        }
    }
}
