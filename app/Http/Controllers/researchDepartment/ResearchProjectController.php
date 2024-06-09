<?php

namespace App\Http\Controllers\researchDepartment;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResearchProjectResource;
use App\Models\ResearchProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class ResearchProjectController extends Controller
{



    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data = ResearchProject::query()
            ->where('research_projects.name', 'like', "%{$search}%")
            ->join('users', 'research_projects.user_id', 'users.id')
            ->join('reasearch_labs', 'research_projects.lab_id', 'reasearch_labs.id')
            ->select('research_projects.*', 'reasearch_labs.lab_name as lab_name', 'users.name as uname')
            ->orderBy("research_projects.$sortField", $sortDirection)
            ->paginate($per_page);
        return ResearchProjectResource::collection($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required',
            'scope_of_project' => 'required',
            'related_images' => 'nullable|mimes:png,jpg,jpeg,gif,pdf',
            'description' => 'required',
            'date' => 'required',
            'lab_id' => 'required',

        ], [

            'lab_id.required' => 'فلید لابرتوار  الزامی می باشد',
            'project_name.required' => 'فلید نام پروژه الزامی می باشد',
            'scope_of_project.required' => 'فلید محدوده پروژه الزامی می باشد',
            'related_images' => 'فیلد تصاویر مرتبط الزامی می باشد',
            'description.required' => 'فلید توضیحات الزامی می باشد',
            'date.required' => 'فلید تاریخ الزامی می باشد',
            'user_id.required' => 'فلید نام کاربری الزامی می باشد',

        ]);

        $images = [];
        $image_paths  = [];
        if ($request->hasFile('images')) {
            foreach ($request->files('images') as $image) {
                $image = $image->store('/', 'research_department/project_images');
                $image_path  =  asset(Storage::url('research_department/project_images/' . $image));
                $images[] = $image;
                $image_paths[] = $image_path;
            }
        }


        $user_id = Auth::user()->id;
        $research_project = new ResearchProject();
        $research_project->project_name = $request->project_name;
        $research_project->scope_of_project = $request->scope_of_project;
        $research_project->related_images = json_encode($images);
        $research_project->related_images_path = json_encode($image_paths);
        $research_project->description = $request->description;
        $research_project->date = $request->date;
        $research_project->lab_id = $request->lab_id;
        $research_project->user_id = $user_id;
        $result = $research_project->save();
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
        $data = ResearchProject::find($id);
        return $data;
    }


    public function update(Request $request)
    {

        $request->validate([
            'project_name' => 'required',
            'scope_of_project' => 'required',
            'related_images' => 'nullable|mimes:png,jpg,jpeg,gif,pdf',
            'description' => 'required',
            'date' => 'required',
            'lab_id' => 'required',

        ], [

            'lab_id.required' => 'فلید لابرتوار  الزامی می باشد',
            'project_name.required' => 'فلید نام پروژه الزامی می باشد',
            'scope_of_project.required' => 'فلید محدوده پروژه الزامی می باشد',
            'related_images' => 'فیلد تصاویر مرتبط الزامی می باشد',
            'description.required' => 'فلید توضیحات الزامی می باشد',
            'date.required' => 'فلید تاریخ الزامی می باشد',
            'user_id.required' => 'فلید نام کاربری الزامی می باشد',

        ]);

        $research_project = ResearchProject::find($request->id);
        $image[] = $research_project->related_images;
        $image_path[] = $research_project->related_images_paths;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if (is_file(storage_path('app/public/research_department/project_images/' . $image))) {
                    Storage::delete('app/public/research_department/project_images/' . $image);
                }
                $image = $image->store('/', 'research_department/project_images');
                $image_path  =  asset(Storage::url('research_department/project_images/' . $image));
                $image[] = $image;
                $image_path[] = $image_path;
            }
        }

        $research_project->project_name = $request->project_name;
        $research_project->scope_of_project = $request->scope_of_project;
        $research_project->related_images = json_encode($image);
        $research_project->related_images_path = json_encode($image_path);
        $research_project->description = $request->description;
        $research_project->date = $request->date;
        $research_project->lab_id = $request->lab_id;
        $result = $research_project->save();
        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه راویرد گردید '
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات موفقانه راویرد نشد دوباره تلاش نماید'
            ], 403);
        }
    }


    public function destory($id)
    {
        $research_project = ResearchProject::find($id);
        $images = json_decode($research_project->related_images);
        foreach ($images as $image) {
            if (is_file(storage_path('app/public/research_department/project_images/' . $image))) {
                Storage::delete('app/public/research_department/project_images/' . $image);
            }
        }
        $result = $research_project->delete();
        if ($result) {
            return response([
                'message' => 'اطلاعات موفقانه حذف گردید '
            ], 200);
        } else {
            return response([
                'message' => 'اطلاعات موفقانه حذف نشد دوباره تلاش نماید'
            ], 403);
        }
    }
}
