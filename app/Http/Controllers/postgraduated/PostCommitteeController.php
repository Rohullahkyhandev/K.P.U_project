<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCommitteeResource;
use App\Models\PostCommit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommitteeController extends Controller
{



    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data = PostCommit::query()
            ->where('post_commits.name', 'like', "%{$search}%")
            ->where('post_commits.secretary', 'like', "%{$search}%")
            ->orWhere('post_commits.director', 'like', "%{$search}%")
            ->join('users', 'post_commits.user_id', 'users.id')
            ->select('post_commits.*', 'users.name as uname')
            ->orderBy("post_commits.$sortField", $sortDirection)
            ->paginate($per_page);
        return PostCommitteeResource::collection($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'secretary' => 'required',
            'metting_place' => 'required',
            'metting_per_month' => 'required',
            'director' => 'required',
            'director_phone' => 'required',
            'secretary_phone' => 'required',
        ], [
            'name.required' => 'فیلد نام الزامی می باشد',
            'secretary.required' =>  'فیلد سکرتری الزامی می باشد',
            'metting_place.required' => 'فلید مکان کمیته الزامی می باشد.',
            'metting_per_month.required' => 'فیلد دفعات ملاقات در هر ماه الزامی می باشد.',
            'director.required' => 'فیلد ریس کمیته الزامی می باشد.',
            'director_phone.required' => 'فلید نمبر تماس ریس کمته الزامی می باشد.',
        ]);


        $user_id = Auth::user()->id;
        $post_committee = new PostCommit();
        $post_committee->name = $request->name;
        $post_committee->faculty = $request->faculty;
        $post_committee->secretary = $request->secretary;
        $post_committee->metting_place = $request->metting_place;
        $post_committee->metting_per_month = $request->metting_per_month;
        $post_committee->director = $request->director;
        $post_committee->director_phone = $request->director_phone;
        $post_committee->secretary_phone = $request->secretary_phone;
        $post_committee->user_id = $user_id;
        $result = $post_committee->save();

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
        return PostCommit::find($id);
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'secretary' => 'required',
            'metting_place' => 'required',
            'metting_per_month' => 'required',
            'director' => 'required',
            'director_phone' => 'required',
            'secretary_phone' => 'required',
        ], [
            'name.required' => 'فیلد نام الزامی می باشد',
            'secretary.required' =>  'فیلد سکرتری الزامی می باشد',
            'metting_place.required' => 'فلید مکان کمیته الزامی می باشد.',
            'metting_per_month.required' => 'فیلد دفعات ملاقات در هر ماه الزامی می باشد.',
            'director.required' => 'فیلد ریس کمیته الزامی می باشد.',
            'director_phone.required' => 'فلید نمبر تماس ریس کمته الزامی می باشد.',
        ]);

        $post_committee = PostCommit::find($request->id);
        $user_id = Auth::user()->id;
        $post_committee->name = $request->name;
        $post_committee->faculty = $request->faculty;
        $post_committee->secretary = $request->secretary;
        $post_committee->metting_place = $request->metting_place;
        $post_committee->metting_per_month = $request->metting_per_month;
        $post_committee->director = $request->director;
        $post_committee->director_phone = $request->director_phone;
        $post_committee->secretary_phone = $request->secretary_phone;
        $post_committee->user_id = $user_id;
        $result = $post_committee->save();

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
        $post_committee = PostCommit::find($id);
        $result = $post_committee->delete();
        return response([$result], 204);
    }
}
