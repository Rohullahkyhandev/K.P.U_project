<?php

namespace App\Http\Controllers\PDC;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArchiveResource;
use App\Models\PDC_Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;

class ArchiveController extends Controller
{


    public function validation()
    {
        $rules = [
            'subject' => 'required|string',
            'date' => 'required|date:max:100',
            'archive_file' => 'required|mimes:mp3,m4a,mp4,jpg,png,pdf,docx',
            'description' => 'nullable|string',
        ];
        return $rules;
    }


    public function index()
    {
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $search = request('search', '');

        $data = PDC_Archive::query()
            ->where('p_d_c__archives.date', 'like', "%{$search}%")
            ->join('users', 'p_d_c__archives.user_id', 'users.id')
            ->select('p_d_c__archives.*', 'users.name as uname')
            ->orderBy("p_d_c__archives.$sortField", $sortDirection)
            ->paginate($per_page);

        return ArchiveResource::collection($data);
    }


    public function store(Request $request)
    {

        $result = 0;
        $rules = $this->validation();
        Validator::make($request->all(), $rules)->validate();

        $archive_file = null;
        $file_path = null;

        if ($request->archive_file != '') {
            $archive_file = $request->archive_file->store('', 'pdc/archive' . $archive_file);
            $file_path = asset(Storage::url('/pdc/archive/' . $archive_file));
        }

        $user_id = Auth::id();
        $archive = new PDC_Archive();
        $archive->subject = $request->subject;
        $archive->date = $request->date;
        $archive->archive_file = $archive_file;
        $archive->file_path = $file_path;
        $archive->description = $request->description;
        $archive->user_id = $user_id;
        $result = $archive->save();

        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه آرشیف شد'
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات موفقانه آرشیف نشد دوباره تلاش نماید'
            ], 403);
        }
    }

    public function edit($id = '')
    {
        return PDC_Archive::find($id);
    }

    public function update(Request $request)
    {

        $request->validate([
            'subject' => 'required|string',
            'date' => 'required|date:max:100',
            'description' => 'required|string',
            'archive_file' => 'nullable:mimes:png,jpg,mp3,mp4,pdf,docx'
        ]);

        $id = $request->id;
        $archive = PDC_Archive::find($id);
        $archive_file = $archive->archive_file;
        $file_path = $archive->file_path;
        if ($request->archive_file != '') {
            if (is_file(storage_path('app/public/pdc/archive/' . $archive->archive_file))) {
                unlink(storage_path('app/public/pdc/archive/' . $archive->archive_file));
            }
            $archive_file = $request->archive_file->store('/', 'pdc/archive');
            $file_path = asset(Storage::url('pdc/archive/' . $archive_file));
        }
        $user_id = Auth::id();
        $archive->subject = $request->subject;
        $archive->date = $request->date;
        $archive->description = $request->description;
        $archive->archive_file = $archive_file;
        $archive->file_path = $file_path;
        $archive->user_id = $user_id;
        $result = $archive->save();

        if ($result) {
            return response([
                'message' => 'دیتا در آرشیف موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response([
                'message' => 'دیتا در آرشیف  ویرایش نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function destroy($id = '')
    {
        $archive = PDC_Archive::find($id);
        if (is_file(storage_path('/app/public/pdc/archive/' . $archive->archive_file))) {
            unlink(storage_path('/app/public/pdc/archive/' . $archive->archive_file));
        }
        $result = PDC_Archive::destroy($id);
        return $result;
    }
}
