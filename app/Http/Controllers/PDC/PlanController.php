<?php

namespace App\Http\Controllers\PDC;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;
use Validator;

class PlanController extends Controller
{
    public function validation()
    {
        $rules  = [
            'subject' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|max:100',
            'document' => 'required|mimes:jpg,png,pdf,doc'
        ];
        return $rules;
    }



    public function index()
    {
        $per_page = request('per_page', 10);
        $search  =  request('search', '');
        $sortField  = request('sortField', 'id');
        $sortDirection  = request('sortDirection', 'DESC');

        $data = Plan::query()
            ->where('plans.date', 'like', "%{$search}%")
            ->join('users', 'plans.user_id', 'users.id')
            ->select('plans.*', 'users.name as uname')
            ->orderBy("plans.$sortField", $sortDirection)
            ->paginate($per_page);
        return PlanResource::collection($data);
    }


    public function store(Request $request)
    {
        $rules = $this->validation();
        Validator::make($request->all(), $rules)->validate();
        $document = null;
        $document_path = null;
        if ($request->document != '') {
            $document = $request->document->store('/', 'plan');
            $document_path = asset(Storage::url('plan/' . $document));
        }
        $user_id = Auth::id();
        $plan = new Plan();
        $plan->subject = $request->subject;
        $plan->description = $request->description;
        $plan->document = $document;
        $plan->document_path = $document_path;
        $plan->date = $request->date;
        $plan->user_id = $user_id;
        $result = $plan->save();

        if ($result) {
            return response([
                'message' => 'پلان موفقانه ذخیره گردید'
            ], 200);
        } else {
            return response([
                'message' => 'پلان  ذخیره نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function edit($id = '')
    {
        return Plan::find($id);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $plan =  Plan::find($id);
        $document = $plan->document;
        $document_path = $plan->document_path;
        if ($request->document != '') {
            if (is_file(storage_path('/app/public/plan/' . $document))) {
                unlink(storage_path('/app/public/plan/' . $document));
            }
            $document = $request->document->store('/', 'plan');
            $document_path = asset(Storage::url('plan/' . $document));
        }
        $user_id = Auth::id();
        $plan->subject = $request->subject;
        $plan->description = $request->description;
        $plan->document = $document;
        $plan->document_path = $document_path;
        $plan->date = $request->date;
        $plan->user_id = $user_id;
        $result = $plan->save();

        if ($result) {
            return response([
                'message' => 'پلان موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response([
                'message' => 'پلان  ویرایش نشد دوباره تلاش نماید'
            ], 304);
        }
    }

    public function destroy($id = '')
    {
        $plan = Plan::find($id);
        if (is_file(storage_path('/app/public/plan/' . $plan->document))) {
            unlink(storage_path('/app/public/plan/' . $plan->document));
        }
        $result = Plan::destroy($id);
    }
}
