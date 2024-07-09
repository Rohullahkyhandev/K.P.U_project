<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\LabResource;
use App\Models\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Label;

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
            ->where('labs.establishment_date', 'like', "%{$search}%")
            ->join('users', 'labs.user_id', 'users.id')
            ->join('post_graduated_programs', 'labs.program_id', 'post_graduated_programs.id')
            ->select('labs.*', 'users.name as uname', 'post_graduated_programs.program_name as program_name')
            ->where('labs.program_id', '=', $program_id)
            ->orderBy("labs.$sortField", $sortDirection)
            ->paginate($per_page);
        return LabResource::collection($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'experiment' => 'required',
            'establishment_date' => 'required',
            'program_id' => 'required',
        ], [
            'name.required' => 'فلید نام الزامی می باشد',
            'experiment.required' => 'فلید  تحقیقات الزامی می با��د',
            'establishment_date.required' => 'فلید تاریخ تاسیس الزامی می باشد',
            'program_id.required' => 'فلید برنامه الزامی می باشد',
        ]);
        $user_id = Auth::user()->id;
        $lab = new Lab();
        $lab->name = $request->name;
        $lab->experiment = $request->experiment;
        $lab->establishment_date = $request->establishment_date;
        $lab->description = $request->description;
        $lab->program_id = $request->program_id;
        $lab->user_id = $user_id;
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


    public function edit($id)
    {
        return Lab::find($id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'experiment' => 'required',
            'establishment_date' => 'required',
            'program_id' => 'required',
            'description' => 'nullable',
        ], [
            'name.required' => 'فلید نام الزامی می باشد',
            'experiment.required' => 'فلید  تحقیقات الزامی می با��د',
            'establishment_date.required' => 'فلید تاریخ تاسیس الزامی می باشد',
            'program_id.required' => 'فلید برنامه الزامی می باشد',
        ]);

        $lab = Lab::find($request->id);
        $lab->name = $request->name;
        $lab->experiment = $request->experiment;
        $lab->description = $request->description;
        $lab->establishment_date = $request->establishment_date;
        $lab->program_id = $request->program_id;
        $lab->user_id = $request->user_id;
        $result =  $lab->save();

        if ($result) {
            return response()->json([
                'status' => true,
                'message' => 'با موفقیت ویرایش شد'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'خطا در ویرایش دوباره تلاش نمایید'
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
