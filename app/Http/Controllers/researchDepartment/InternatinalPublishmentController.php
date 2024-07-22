<?php

namespace App\Http\Controllers\researchDepartment;

use App\Http\Controllers\Controller;
use App\Http\Resources\InternatinalPublishmentResource;
use App\Models\InternationalPublishment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InternatinalPublishmentController extends Controller
{


    public function index()
    {
        $search = request('search', '');
        $per_page  = request('per_page', 10);
        $sortField  = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $data = InternationalPublishment::query()
            ->where('international_publishments.author', 'like', "%{$search}%")
            ->orWhere('international_publishments.title', 'like', "%{$search}%")
            ->join('faculties', 'international_publishments.faculty_id', 'faculties.id')
            ->join('users', 'international_publishments.user_id', 'users.id')
            ->join('departments', 'international_publishments.department_id', 'departments.id')
            ->select('international_publishments.*', 'users.name as uname', 'faculties.name as faculty', 'departments.name as department')
            ->orderBy("international_publishments.$sortField", $sortDirection)
            ->paginate($per_page);
        return InternatinalPublishmentResource::collection($data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'author' => 'required',
            'author_assesstance' => 'required',
            'journal' => 'required',
            'journal_website_link' => 'required',
            'title' => 'required',
            'faculty_id' => 'required',
            'department_id' => 'required',
            'attachment' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg,pdf|max:2048'
        ], [
            'author.required' => 'فلید نام الزامی می باشد',
            'author_assesstance.required' => 'فلید نام همکار نویسنده الزامی می باشد',
            'journal.required' => 'فلید نام مجله الزامی می باشد',
            'journal_website_link.required' => 'فلید لینک الزامی می باشد',
            'title.required' => 'فلید عنوان الزامی می باشد',
            'faculty_id.required' => 'فلید دانشکده الزامی می باشد',
            'department_id.required' => 'فلید بخش الزامی می باشد',
            // 'attachment.mimes' => 'jpg,png,jpeg,gif,pdf  فیلد اسناد باید این فارمت ها داشته باشد:',
            'attachment.size' => 'حجم فایل های آپلود شده باید بیشتر از 6 MB نباشد'
        ]);

        $attachment = null;
        $attachment_path = null;

        if ($request->attachment != '') {
            $attachment = $request->attachment->store('/', 'research_department/teacher_research');
            $attachment_path  = asset(Storage::url('research_department/teacher_research/' . $attachment));
        }

        $user_id = Auth::user()->id;
        $internatinal_publishment = new InternationalPublishment();
        $internatinal_publishment->author = $request->author;
        $internatinal_publishment->author_assesstance = $request->author_assesstance;
        $internatinal_publishment->journal_name = $request->journal;
        $internatinal_publishment->journal_link_website = $request->journal_website_link;
        $internatinal_publishment->title = $request->title;
        $internatinal_publishment->attachment = $attachment;
        $internatinal_publishment->attachment_path = $attachment_path;
        $internatinal_publishment->faculty_id = $request->faculty_id;
        $internatinal_publishment->department_id = $request->department_id;
        $internatinal_publishment->user_id = $user_id;
        $result = $internatinal_publishment->save();

        if ($result) {
            return response([
                'message' => ' اطلاعات موفقانه ذخیره شد '
            ], 200);
        } else {
            return response([
                'message' => ' اطلاعات موفقانه ذخیره نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function edit($id)
    {
        return InternationalPublishment::find($id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'author' => 'required',
            'author_assesstance' => 'required',
            'journal' => 'required',
            'link' => 'required',
            'title' => 'required',
            'faculty_id' => 'required',
            'department_id' => 'required',
            'attachment' => 'nullable|mimes:pdf,jpg,png,jpeg,gif|size:6000',
        ], [
            'author.required' => 'فلید نام الزامی می باشد',
            'author_assesstance.required' => 'فلید نام همکار نویسنده الزامی می باشد',
            'journal.required' => 'فلید نام مجله الزامی می باشد',
            'link.required' => 'فلید لینک الزامی می باشد',
            'title.required' => 'فلید عنوان الزامی می باشد',
            'faculty_id.required' => 'فلید دانشکده الزامی می باشد',
            'department_id.required' => 'فلید دیپارتمنت الزامی می باشد',
            'attachment.mimes' => 'mimes:pdf,jpg,png,jpeg,gif  فیلد اسناد باید این فارمت ها داشته باشد:',
            'attachment.size' => 'حجم فایل های آپلود شده باید بیشتر از 6 MB نباشد'
        ]);

        $internatinal_publishment = InternationalPublishment::find($request->id);
        $attachment = $internatinal_publishment->attachment;
        $attachment_path  = $internatinal_publishment->attachment_path;

        if ($request->hasFile('attachments')) {
            if (is_file(storage_path('app/public/research_department/teacher_research/' . $attachment))) {
                Storage::delete('app/public/research_department/teacher_research/' . $attachment);
            }

            $attachment = $request->attachment->store('/', 'research_department/teacher_research');
            $attachment_path = asset(Storage::url('research_department/teacher_research/' . $attachment));
        }

        $internatinal_publishment->author = $request->author;
        $internatinal_publishment->author_assesstance = $request->author_assesstance;
        $internatinal_publishment->journal_name = $request->journal;
        $internatinal_publishment->journal_link_website = $request->link;
        $internatinal_publishment->title = $request->title;
        $internatinal_publishment->attachment = $attachment;
        $internatinal_publishment->attachment_path = $attachment_path;
        $internatinal_publishment->faculty_id = $request->faculty_id;
        $internatinal_publishment->department_id = $request->department_id;
        $result = $internatinal_publishment->save();

        if ($result) {
            return response([
                'message' => ' اطلاعات موفقانه ذخیره شد '
            ], 200);
        } else {
            return response([
                'message' => ' اطلاعات موفقانه ذخیره نشد دوباره تلاش نماید'
            ], 304);
        }
    }


    public function destroy($id)
    {
        $internatinal_publishment = InternationalPublishment::find($id);
        $attachment = $internatinal_publishment->attachment;
        if (is_file(storage_path('app/public/research_department/teacher_research/' . $attachment))) {
            Storage::delete('app/public/research_department/teacher_research/' . $attachment);
        }
        $result = $internatinal_publishment->delete();
        return $result;
    }
}
