<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\BoardMemberResource;
use App\Models\Board;
use App\Models\BoardMember;
use Illuminate\Http\Request;

class BoardMemberController extends Controller
{


    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data  = BoardMember::query()
            ->where('board_members.name', 'like', "%{$search}%")
            ->orWhere('board_members.lname', 'like', "%{$search}%")
            ->orWhere('board_members.fname', 'like', "%{$search}")
            ->join('users', 'board_members.user_id', 'users.id')
            ->join('board', 'board_members.board_id', 'board.id')
            ->select('board_members.*', 'board.name as name', 'users.uname as uname')
            ->orderBy("board_members.$sortField", $sortDirection)
            ->paginate($per_page);
        return BoardMemberResource::collection($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lname' => 'required',
            'fname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'board_id' => 'required',
            'user_id' => 'required',
        ], [

            'name.required' => 'فیلد نام الزامی می باشد',
            'lname.required' => 'فلید تخلص الزامی می باشد',
            'fname.required' => 'نام پدر الزامی می باشد',
            'phone.required' => 'فلید شماره تماس الزامی میباشد',
            'email.required' => 'فلید ایمل ادرس الزامی می باشد',
            'board_id.required' => 'فیلد بورد مربوطه الزامی می باشد',
        ]);

        $board_member = new BoardMember();
        $board_member->name = $request->name;
        $board_member->lname = $request->lname;
        $board_member->fname = $request->fname;
        $board_member->phone = $request->phone;
        $board_member->email = $request->email;
        $board_member->board_id = $request->board_id;
        $board_member->user_id = $request->user_id;
        $result = $board_member->save();

        if ($result) {
            return response()->json([
                'res' => '  اطلاعات موفقانه ثبت گردید'
            ]);
        } else {
            return response()->json([
                'res' => 'اطلاعات   موفقانه ثبت نشد دوباره تلاش نمایید'
            ]);
        }
    }

    public function getAllMembers()
    {
        $data = Board::all();
        return $data;
    }


    public function edit($id = '')
    {
        $data = BoardMember::findOrfail($id);
        return $data;
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'lname' => 'required',
            'fname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'board_id' => 'required',
            'user_id' => 'required',
        ], [

            'name.required' => 'فیلد نام الزامی می باشد',
            'lname.required' => 'فلید تخلص الزامی می باشد',
            'fname.required' => 'نام پدر الزامی می باشد',
            'phone.required' => 'فلید شماره تماس الزامی میباشد',
            'email.required' => 'فلید ایمل ادرس الزامی می باشد',
            'board_id.required' => 'فیلد بورد مربوطه الزامی می باشد',
        ]);

        $board_member = BoardMember::find($request->id);
        $board_member->name = $request->name;
        $board_member->lname = $request->lname;
        $board_member->fname = $request->fname;
        $board_member->phone = $request->phone;
        $board_member->email = $request->email;
        $board_member->board_id = $request->board_id;
        $result = $board_member->save();

        if ($result) {
            return response()->json([
                'res' => '  اطلاعات موفقانه ویرایش گردید'
            ]);
        } else {
            return response()->json([
                'res' => 'اطلاعات   موفقانه ویرایش نشد دوباره تلاش نمایید'
            ]);
        }
    }


    public function destroy($id = '')
    {
        if ($id) {
            $result = BoardMember::destroy($id);
            return $result;
        }
    }
}
