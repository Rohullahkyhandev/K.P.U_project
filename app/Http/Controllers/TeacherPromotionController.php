<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherPromotionResource;
use App\Models\Promotion;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeacherPromotionController extends Controller
{


    public function index()
    {
        $per_page = request('per_page', 10);
        $search  =  request('search', '');
        $sortField  = request('sortField', 'id');
        $sortDirection  = request('sortDirection', 'DESC');

        $data = Promotion::query()
            ->where('promotions.date', 'like', "%{$search}%")
            ->join('users', 'promotions.user_id', 'users.id')
            ->join('teachers', 'promotions.teacher_id', 'teachers.id')
            ->select('promotions.*', 'users.name as uname', 'teachers.name as name', 'teachers.lname as  lname')
            ->orderBy("promotions.$sortField", $sortDirection)
            ->paginate($per_page);
        return TeacherPromotionResource::collection($data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'date' => 'required',
            'last_academic_rank' => 'required',
            'now_academic_rank' => 'required',
            'attachment' => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'date.required' => "فیلد تاریخ  الزامی می باشد",
            'last_academic_rank.required' => "فیلد رتبه علمی قبلی  الزامی می باشد",
            'now_academic_rank.required' => "فیلد رتبه علمی فعلی  الزامی می باشد",
            'attachment.mimes' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"
        ]);
        DB::beginTransaction();
        try {
            $attachment = null;
            $attachment_path = null;
            if ($request->attachment != '') {
                $attachment = $request->attachment->store('/', 'teacher_promotion');
                $attachment_path = asset(Storage::url('teacher_promotion/' . $attachment));
            }
            $user_id = Auth::id();
            $teacher_id = $request->teacher_id;
            $teacher = Teacher::find($teacher_id);
            $teacher->academic_rank = $request->now_academic_rank;
            $teacher->save();

            $promotion = new  Promotion();
            $promotion->date = $request->date;
            $promotion->last_academic_rank = $request->last_academic_rank;
            $promotion->now_academic_rank = $request->now_academic_rank;
            $promotion->attachment = $attachment;
            $promotion->attachment_path = $attachment_path;
            $promotion->user_id = $user_id;
            $promotion->teacher_id = $request->teacher_id;
            $result = $promotion->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $result = $e;
        }
        if ($result) {
            return response([
                'message' => 'اطلاعات  موفقانه ذخیره گردید'
            ], 200);
        } else {
            return response([
                'error' => 'اطلاعات  ذخیره نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    // public function getCriteria($id = '')
    // {
    //     $data = Criteria::find($id);
    //     return $data;
    // }

    public function edit($id = '')
    {
        $data =  Promotion::query()
            ->join('teachers', 'promotions.teacher_id', 'teachers.id')
            ->select("promotions.*", "teachers.academic_rank as academic_rank")
            ->where('promotions.id', '=', $id)
            ->get()->first();
        return $data;
    }

    public function update(Request $request)
    {

        $request->validate([
            'year' => 'required',
            'description' => 'nullable',
            'attachment' => 'nullable|mimes:png,jpg,mp3,mp4,pdf,docx'
        ], [
            'year.required' => "فیلد  سال الزامی می باشد",
            'attachment' => "فارمت فایل باید شامل این فارمت ها باشد png,jpg,mp3,mp4,pdf,docx"
        ]);

        DB::beginTransaction();
        try {
            $teacher_id = $request->teacher_id;
            $id = $request->id;
            $teacher =  Teacher::find($teacher_id);
            $teacher->academic_rank = $request->now_academic_rank;
            $teacher->save();

            $promotion =  Promotion::find($id);
            $attachment = $promotion->attachment;
            $attachment_path = $promotion->attachment_path;
            if ($request->attachment != '') {
                if (is_file(storage_path('/app/public/teacher_promotion/' . $attachment))) {
                    unlink(storage_path('/app/public/teacher_promotion/' . $attachment));
                }
                $attachment = $request->attachment->store('/', 'teacher_promotion');
                $attachment_path = asset(Storage::url('teacher_promotion/' . $attachment));
            }
            $user_id = Auth::id();
            $promotion->date = $request->date;
            $promotion->last_academic_rank = $request->last_academic_rank;
            $promotion->now_academic_rank = $request->now_academic_rank;
            $promotion->attachment = $attachment;
            $promotion->attachment_path = $attachment_path;
            $promotion->user_id = $user_id;
            $result = $promotion->save();
            DB::commit();
        } catch (\Exception $e) {
            $result = $e;
            DB::rollBack();
        }

        if ($result) {
            return response([
                'message' => ' موفقانه ویرایش گردید  '
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات   ویرایش نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function destroy($id = '')
    {
        $promotion = Promotion::find($id);
        if (is_file(storage_path('/app/public/teacher_promotion/' . $promotion->attachment))) {
            unlink(storage_path('/app/public/teacher_promotion/' . $promotion->attachment));
        }
        $result = Promotion::destroy($id);
        return $result;
    }
}
