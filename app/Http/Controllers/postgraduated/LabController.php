<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\LabResource;
use App\Models\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
{


    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', '');
        $sortField = request('sort_field', 'id');
        $sortDirection = request('sort_direction', 'DESC');
        $program_id = request('program_id');

        $data = Lab::query()
            ->where('labs.name', 'like', "%{$search}%")
            ->orWhere('labs.establishment', 'like', "%{$search}%")
            ->join('users', 'labs.user_id', 'users.id')
            ->join('post_programs', 'labs.program_id', 'post_programs.id')
            ->select('labs.*', 'users.name as uname', 'post_programs.program_name as program_name')
            ->where('labs.program_id', '=', $program_id)
            ->orderBy("labs.$sortField", $sortDirection)
            ->paginate($per_page);
        return LabResource::collection($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'expremint' => 'required',
            'establishment' => 'required',
            'program_id' => 'required',
        ], [
            'name.required' => 'فلید نام الزامی می باشد',
            'expremint.required' => 'فلید  تحقیقات الزامی می با��د',
            'establishment.required' => 'فلید تاریخ تاسیس الزامی می باشد',
            'program_id.required' => 'فلید برنامه الزامی می باشد',
        ]);

        $lab = new Lab();
        $lab->name = $request->name;
        $lab->experiment = $request->experiment;
        $lab->establishment = $request->establishment;
        $lab->program_id = $request->program_id;
        $lab->user_id = $request->user_id;
        $result =  $lab->save();

        if ($result) {
            return response()->json([
                'status' => true,
                'message' => 'با موفقیت ذخیره شد'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'خطا در ذخیره دوباره تلاش نمایید'
            ]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'expremint' => 'required',
            'establishment' => 'required',
            'program_id' => 'required',
        ], [
            'name.required' => 'فلید نام الزامی می باشد',
            'expremint.required' => 'فلید  تحقیقات الزامی می با��د',
            'establishment.required' => 'فلید تاریخ تاسیس الزامی می باشد',
            'program_id.required' => 'فلید برنامه الزامی می باشد',
        ]);

        $lab = Lab::find($request->id);
        $lab->name = $request->name;
        $lab->experiment = $request->experiment;
        $lab->establishment = $request->establishment;
        $lab->program_id = $request->program_id;
        $lab->user_id = $request->user_id;
        $result =  $lab->save();

        if ($result) {
            return response()->json([
                'status' => true,
                'message' => 'با موفقیت ذخیره شد'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'خطا در ذخیره دوباره تلاش نمایید'
            ]);
        }
    }


    public function destroy($id)
    {
        $lab = Lab::find($id);
        $result = $lab->delete();

        if ($result) {
            return response()->json([
                'status' => true,
                'message' => 'با موفقیت حذف شد'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'خطا در حذف دوباره تلاش نمایید'
            ]);
        }
    }
}
