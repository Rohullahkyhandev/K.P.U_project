<?php

namespace App\Http\Controllers\researchDepartment;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResearchLabResource;
use App\Models\ReasearchLab;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class LabController extends Controller
{

    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data = ReasearchLab::query()
            ->where('reasearch_labs.lab_name', 'like', "%{$search}%")
            ->join('users', 'reasearch_labs.user_id', 'users.id')
            ->select('reasearch_labs.*', 'users.name as uname')
            ->orderBy("reasearch_labs.$sortField", $sortDirection)
            ->paginate($per_page);
        return ResearchLabResource::collection($data);
    }


    public function getAllLabs()
    {
        return ReasearchLab::all();
    }


    public function store(Request $request)
    {

        $request->validate(['lab_name' => 'required',
            'description' => 'required',

        ], [
            'name.required' => 'فیلد نام لابرتوار الزامی می باشد',
            'description.required' => 'فیلد توضیحات لابرتوار الزامی می باشد',
        ]);

        $lab = new ReasearchLab();
        $lab->lab_name = $request->lab_name;
        $lab->description = $request->description;
        $lab->user_id = auth()->user()->id;
        $result = $lab->save();

        if ($result) {
            return response([
                'message' => 'لابرتوار با موفقیت ثبت شد'
            ], 200);
        } else {
            return response([
                'message' => 'لابرتوار  ثبت نشد'
            ], 304);
        }
    }


    public function edit($id)
    {
        return ReasearchLab::find($id);
    }

    public function update(Request $request)
    {

        $request->validate(['lab_name' => 'required',
            'description' => 'required',

        ], [
            'name.required' => 'فیلد نام لابرتوار الزامی می با��د',
            'description.required' => 'فیلد توضیحات لابرتوار الزامی می باشد',
        ]);

        $lab = ReasearchLab::find($request->id);
        $lab->lab_name = $request->lab_name;
        $lab->description = $request->description;
        $lab->user_id = auth()->user()->id;
        $result = $lab->save();

        if ($result) {
            return response([
                'message' => 'لابرتوار با موفقیت  ویرایش گردید'
            ], 200);
        } else {
            return response([
                'message' => 'لابرتوار  با موفقیت ثیت  نشد'
            ], 304);
        }
    }



    public function destroy($id = '')
    {
        $result = ReasearchLab::destroy($id);
        if ($result) {
            return response([
                'message' => 'لابرتوار با موفقیت حذف گردید'
            ], 200);
        } else {
            return response([
                'message' => 'لابرتوار حذف نشد دوباره تلاش نماید'
            ], 304);
        }
    }
}
