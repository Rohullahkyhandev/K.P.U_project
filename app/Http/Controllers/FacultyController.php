<?php

namespace App\Http\Controllers;

use App\Http\Resources\FaculteisResource;
use App\Http\Resources\FacultyResource;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Validator;

class FacultyController extends Controller
{
    public function validation()
    {
        $rules = [
            'director_name' => 'required',
            'director_lname' => 'required',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'name' => 'required|string',
            'date' => 'required|date|max:100',
            'description' => 'required',
        ];

        return $rules;
    }

    public function index()
    {
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $search = request('search', '');

        $data = Faculty::query()
            ->where('faculties.name', 'like', "%{$search}%")
            ->select('faculties.*',)
            ->orderBy("faculties.$sortField", $sortDirection)
            ->paginate($per_page);
        return FaculteisResource::collection($data);
    }


    public function getFaculties()
    {
        return Faculty::all();
    }

    public function store(Request $request)
    {

        $result = 0;
        $rules =  $this->validation();
        Validator::make($request->all(), $rules)->validate();

        $photo = null;
        $photo_path = null;
        if ($request->photo != "") {
            $photo = $request->photo->store('', 'faculty/photo');
            $photo_path = asset(Storage::url('faculty/photo/' . $photo));
        }


        $faculty = new Faculty();
        $faculty->name = $request->name;
        $faculty->date = $request->date;
        $faculty->director_name = $request->director_name;
        $faculty->director_lname = $request->director_lname;
        $faculty->photo = $photo;
        $faculty->photo_path = $photo_path;
        $faculty->description = $request->description;
        $result = $faculty->save();

        if ($result) {
            return response([
                'message' => 'موفقانه ذخیره شد'
            ], 200);
        } else {
            return response([
                'message' => 'دیتا ذخیره نشد دوباره تلاش نماید'
            ], 403);
        }
    }




    public function update(Request $request)
    {

        $result = 0;
        $rules =  $this->validation();
        Validator::make($request->all(), $rules)->validate();
        $id = $request->id;

        $faculty = Faculty::find($id);
        $photo = $faculty->photo;
        $photo_path = $faculty->photo_path;
        if ($request->photo != '') {
            if (is_file(storage_path('app/public/faculty/photo/' . $photo))) {
                unlink(storage_path('app/public/faculty/photo/' . $photo));
            }
            $photo = $request->photo->store('', 'faculty/photo');
            $photo_path = asset(Storage::url('faculty/photo/' . $photo));
        }

        $user_id = Auth::user()->id;
        $faculty->director_name = $request->director_name;
        $faculty->director_lname = $request->director_lname;
        $faculty->photo = $photo;
        $faculty->$photo_path = $photo_path;
        $faculty->name = $request->name;
        $faculty->date = $request->date;
        $faculty->description = $request->description;
        $faculty->user_id = $user_id;
        $result = $faculty->save();

        if ($result) {
            return response([
                'message' => 'موفقانه ذخیره شد'
            ], 200);
        } else {
            return response([
                'message' => 'دیتا ذخیره نشد دوباره تلاش نماید'
            ], 403);
        }
    }



    function getFaculty($id = '')
    {
        return Faculty::find($id);
    }

    public function destroy($id = '')
    {
        $faculty = Faculty::find($id);
        if (is_file(storage_path('app/public/faculty/photo/' . $faculty->photo))) {
            unlink(storage_path('app/public/faculty/photo/' . $faculty->photo));
        }
        $result = $faculty->delete();
        return $result;
    }
}
