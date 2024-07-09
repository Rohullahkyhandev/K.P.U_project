<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassRoomResource;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassRoomController extends Controller
{


    public function index()
    {
        $search  = request('search', '');
        $per_page = request('per_page', 10);
        $sortField  = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $program_id = request('program_id');

        $data = ClassRoom::query()
            ->where('class_rooms.program_id', '=', $program_id)
            ->where('class_rooms.number', 'like', "%{$search}%")
            ->join('post_graduated_programs', 'class_rooms.program_id', 'post_graduated_programs.id')
            ->join('users', 'class_rooms.user_id', 'users.id')
            ->select('class_rooms.*', 'post_graduated_programs.program_name as program_name', 'users.name as uname')
            ->orderBy("class_rooms.$sortField", $sortDirection)
            ->paginate($per_page);

        return ClassRoomResource::collection($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required',
            'max_quantity' => 'required',
            'equipment' => 'required',
            'program_id' => 'required',
        ], [

            'number.required' => 'فیلد شماره الزامی میباشد',
            'max_quantity.required' => 'فیلد حداکثر تعداد الزامی میباشد',
            'equipment.required' => 'فیلد تجهیزات الزامی میباشد',
            'program_id.required' => 'فیلد برنامه الزامی میباشد',
        ]);

        $class_room = new ClassRoom();
        $class_room->number = $request->number;
        $class_room->max_quantity = $request->max_quantity;
        $class_room->program_id = $request->program_id;
        $class_room->equipment = $request->equipment;
        $class_room->user_id = Auth::user()->id;
        $class_room->program_id = $request->program_id;
        $result = $class_room->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه ذخیره گردید'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات موفقانه ذخیره نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function edit($id = '')
    {
        return ClassRoom::find($id);
    }

    public function update(Request $request)
    {
        $request->validate([

            'number' => 'required',
            'max_quantity' => 'required',
            'equipment' => 'required',
            'program_id' => 'required',
        ], [

            'number.required' => 'فیلد شماره الزامی میباشد',
            'max_quantity.required' => 'فیلد حداکثر تعداد الزامی میباشد',
            'equipment.required' => 'فیلد تجهیزات الزامی میباشد',
            'program_id.required' => 'فیلد برنامه الزامی میباشد',
        ]);
        $class_room = ClassRoom::find($request->id);
        $class_room->number = $request->number;
        $class_room->max_quantity = $request->max_quantity;
        $class_room->program_id = $request->program_id;
        $class_room->equipment = $request->equipment;
        $class_room->program_id = $request->program_id;
        $result = $class_room->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات موفقانه ویرایش نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function destroy($id = '')
    {
        $class_room = ClassRoom::find($id);
        $result = $class_room->delete();
        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه حذف گردید'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات موفقانه حذف نشد دوباره تلاش نماید'
            ], 304);
        }
    }
}
