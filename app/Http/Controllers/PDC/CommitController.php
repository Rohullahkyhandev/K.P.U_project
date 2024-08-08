<?php

namespace App\Http\Controllers\PDC;

use App\Http\Controllers\Controller;
use App\Http\Resources\PDC_CommitRsource;
use App\Models\PD_Committee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommitController extends Controller
{




    public function index()
    {
        $per_page = request('perPage', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $search = request('search', '');

        $data = PD_Committee::query()
            ->where('p_d__committees.date', 'like', "%{$search}%")
            ->orWhere('p_d__committees.name', 'like', "%{$search}%")
            ->join('users', 'p_d__committees.user_id', 'users.id')
            ->select('p_d__committees.*', 'users.name as uname')
            ->orderBy("p_d__committees.$sortField", $sortDirection)
            ->paginate($per_page);

        return PDC_CommitRsource::collection($data);
    }


    // get all the commits

    public function getAllCommit()
    {
        $data =  PD_Committee::all();
        return $data;
    }


    public function store(Request $request)
    {

        $request->validate([
            "name" => 'required',
            "topic" => 'required',
            "date" => 'required',
            "description" => 'required',
            "attachment" => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx"',

        ], [
            'name.required' => 'فلد نام الزامی می باشد',
            'topic.required' => 'فلد موضوع الزامی می باشد',
            'date.required' => 'فلد تاریخ الزامی می باشد',
            'description.required' => 'فلد توضیحات  الزامی می باشد',
            'attachment' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"

        ]);

        $attachment = null;
        $attachment_path = null;

        if ($request->attachment != '') {
            $attachment = $request->attachment->store('', 'pdc/commit' . $attachment);
            $attachment_path = asset(Storage::url('/pdc/commit/' . $attachment));
        }

        $user_id = Auth::id();
        $commit = new PD_Committee();
        $commit->name = $request->name;
        $commit->topic = $request->topic;
        $commit->date = $request->date;
        $commit->attachment = $attachment;
        $commit->attachment_path = $attachment_path;
        $commit->description = $request->description;
        $commit->user_id = $user_id;
        $result = $commit->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه راچستر گردید '
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات موفقانه راجستر نشد دوباره تلاش نماید'
            ], 403);
        }
    }

    public function edit($id = '')
    {
        return PD_Committee::find($id);
    }

    public function update(Request $request)
    {

        $request->validate([
            "name" => 'required',
            "topic" => 'required',
            "date" => 'required',
            "description" => 'required',
            "attachment" => 'nullable',
        ], [
            'name.required' => 'فلد نام الزامی می باشد',
            'topic.required' => 'فلد موضوع الزامی می باشد',
            'date.required' => 'فلد تاریخ الزامی می باشد',
            'description.required' => 'فلد توضیحات  الزامی می باشد',
            'attachment.mimes' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"

        ]);


        $id = $request->id;
        $commit = PD_Committee::find($id);
        $attachment = $commit->attachment;
        $attachment_path = $commit->attachment_path;
        if ($request->attachment != '') {
            if (is_file(storage_path('app/public/pdc/commit/' . $commit->attachment))) {
                unlink(storage_path('app/public/pdc/commit/' . $commit->attachment));
            }
            $attachment = $request->attachment->store('/', 'pdc/commit');
            $attachment_path = asset(Storage::url('pdc/commit/' . $attachment));
        }
        $user_id = Auth::id();
        $commit->name = $request->name;
        $commit->topic = $request->topic;
        $commit->date = $request->date;
        $commit->description = $request->description;
        $commit->attachment = $attachment;
        $commit->attachment_path = $attachment_path;
        $commit->user_id = $user_id;
        $result = $commit->save();

        if ($result) {
            return response(['message' => 'دیتا در  موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response(['message' => 'دیتا در   ویرایش نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function destroy($id = '')
    {
        $commit = PD_Committee::find($id);
        if (is_file(storage_path('/app/public/pdc/commit/' . $commit->commit_file))) {
            unlink(storage_path('/app/public/pdc/commit/' . $commit->commit_file));
        }
        $result = PD_Committee::destroy($id);
        return $result;
    }
}
