<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramsResource;
use App\Models\PostGraduatedPrograms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramsController extends Controller
{

    public function index()
    {
        $per_page = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data = PostGraduatedPrograms::query()
            ->where('post_graduated_programs.program_name', 'like', "%{$search}%")
            ->orWhere('post_graduated_programs.degree_type', 'like', "%{$search}%")
            ->orWhere('post_graduated_programs.program_duration', 'like', "%{$search}%")
            ->join('users', 'post_graduated_programs.user_id', 'users.id')
            ->select('post_graduated_programs.*', 'users.name as uname')
            ->orderBy("post_graduated_programs.$sortField", $sortDirection)
            ->paginate($per_page);
        return ProgramsResource::collection($data);
    }

    public function getAllProgram()
    {
        $data  = PostGraduatedPrograms::all();
        return $data;
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_name' => 'required',
            'degree_type' => 'required',
            'program_duration' => 'required',
            'description' => 'nullable',
        ], [
            'program_name.required' => 'فیلد برنامه الزامی  میباشد',
            'degree_type.required' => 'فیلد نوع مقطع الزامی  میباشد',
            'program_duration.required' => 'فیلد  مدت زمان الزامی  میباشد',

        ]);

        $user_id = Auth::user()->id;
        $program = new PostGraduatedPrograms();
        $program->program_name = $request->program_name;
        $program->degree_type = $request->degree_type;
        $program->program_type = "test";
        $program->program_duration = $request->program_duration;
        $program->description = $request->description;
        $program->user_id = $user_id;
        $program->faculty_id = 1;
        $result  = $program->save();

        if ($result) {
            return response([
                'message' => "اطلاعات موفقانه ذخیره گردید."
            ], 200);
        } else {
            return response([
                'error' => 'اطلاعات موفقانه ذخیره نشد دوباره تلاش نماید.'
            ], 402);
        }
    }

    public function edit($id = '')
    {
        if ($id) {
            $data = PostGraduatedPrograms::findOrfail($id);
            return $data;
        } else {
            return response([
                'message' => 'لطفا ادی را روان نماید'
            ]);
        }
    }

    public function update(Request $request)
    {

        $request->validate([
            'program_name' => 'required',
            'type' => 'required',
        ], [
            'program_name.required' => 'فیلد برنامه الزامی  میباشد',
            'program_name.required' => 'فیلد نوع برنامه الزامی  میباشد',
        ]);
        $id  = $request->id;
        $user_id = Auth::user()->id;
        $program  = PostGraduatedPrograms::find($id);
        $program->program_name = $request->program_name;
        $program->type = $request->type;
        $program->user_id = $user_id;
        $result  = $program->save();

        if ($result) {
            return response([
                'message' => "اطلاعات موفقانه ویرایش گردید."
            ], 200);
        } else {
            return response([
                'error' => 'اطلاعات موفقانه ویرایش نشد دوباره تلاش نماید.'
            ], 402);
        }
    }

    public function destroy($id = '')
    {
        if ($id) {
            $result = PostGraduatedPrograms::destroy($id);
            return $result;
        }
    }
}
