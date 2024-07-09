<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\BoardResource;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoradController extends Controller
{




    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $limit = 100;

        $data = Board::query()
            ->where('boards.name', 'like',  "%{$search}%")
            ->orWhere('boards.director', 'like', "%{$search}%")
            ->join('users', 'boards.user_id', 'users.id')
            ->select('boards.*', 'users.name as uname')
            ->orderBy("boards.$sortField", $sortDirection)
            ->paginate($per_page, $limit);

        return BoardResource::collection($data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:100',
            'director' => 'required|max:100',
            'director_phone' => 'required|max:14',
            'secretary' => 'required|max:100',
            'secretary_phone' => 'required|max:14',
            'metting_place' => 'required|max:200',
            'metting_per_month' => 'required|max:100',
        ], [

            'name.required' => 'فیلد نام الزامی می باشد',
            'director.required' => 'فلید ریس بورد الزامی می باشد',
            'director_phone.required' => 'فیلد شماره تماس ریس بورد الزامی میباشد',
            'secretary.required' => 'فلید سکرتر الزامی می باشد',
            'secretary_phone.required' => 'فلید شماره تماس سکرتر الزامی می باشد',
            'metting_place.required' => 'فلید مکان جلسه الزامی می باشد',
            'metting_per_month.required' => 'فلید تعداد جلسه در هر ماه الزامی می باشد',
        ]);

        $user_id  = Auth::id();
        $board = new Board();
        $board->name = $request->name;
        $board->director = $request->director;
        $board->director_phone = $request->director_phone;
        $board->secretary = $request->secretary;
        $board->secretary_phone = $request->secretary_phone;
        $board->metting_place = $request->metting_place;
        $board->metting_per_month = $request->metting_per_month;
        $board->user_id = $user_id;
        $result = $board->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات  موفقانه ذخیره شد'
            ], 200);
        } else {
            return response([
                'error' => '  دوباره تلاش نماید,اطلاعات موفقانه ذخیره نشد'
            ], 304);
        }
    }


    public function edit($id)
    {
        $data = Board::find($id);
        return $data;
    }


    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|max:100',
            'director' => 'required|max:100',
            'director_phone' => 'required|max:14',
            'secretary' => 'required|max:100',
            'secretary_phone' => 'required|max:14',
            'metting_place' => 'required|max:200',
            'metting_per_month' => 'required|max:100',
        ], [

            'name.required' => 'فیلد نام الزامی می باشد',
            'director.required' => 'فلید ریس بورد الزامی می باشد',
            'director_phone.required' => 'فیلد شماره تماس ریس بورد الزامی میباشد',
            'secretary.required' => 'فلید سکرتر الزامی می باشد',
            'secretary_phone.required' => 'فلید شماره تماس سکرتر الزامی می باشد',
            'metting_place.required' => 'فلید مکان جلسه الزامی می باشد',
            'metting_per_month.required' => 'فلید تعداد جلسه در هر ماه الزامی می باشد',
        ]);


        $user_id = Auth::id();
        $board = Board::find($request->id);

        $board->name = $request->name;
        $board->director = $request->director;
        $board->director_phone = $request->director_phone;
        $board->secretary = $request->secretary;
        $board->secretary_phone = $request->secretary_phone;
        $board->metting_place = $request->metting_place;
        $board->metting_per_month = $request->metting_per_month;
        $board->user_id = $user_id;
        $result = $board->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات  موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات  موفقانه ویرایش  نشد دوباره تلاش نماید'
            ], 200);
        }
    }


    public function destroy($id)
    {
        $board = Board::find($id);
        $result = $board->delete();
        if ($result) {
            return response([
                'message' => 'اطلاعات  موفقانه حذف گردید'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات  موفقانه حذف نشد دوباره تلاش نماید'
            ], 200);
        }
    }
}
