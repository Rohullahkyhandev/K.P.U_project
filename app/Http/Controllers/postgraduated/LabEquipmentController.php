<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\LabEquipmentResource;
use App\Models\Lab;
use App\Models\LabEquipment;
use App\Models\LabTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Node\FunctionNode;

class LabEquipmentController extends Controller
{


    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $data = LabTools::query()
            ->where('lab_tools.name', 'like', "%{$search}%")
            ->orWhere('lab_tools.entry_date', 'like', "%{$search}%")
            ->join('users', 'lab_tools.user_id', 'users.id')
            ->join('labs', 'lab_tools.lab_id', 'labs.id')
            ->join('post_graduated_programs', 'lab_tools.lab_id', 'post_graduated_programs.id')
            ->select('lab_tools.*', 'users.name as uname', 'labs.name as lname', 'post_graduated_programs.program_name as program_name')
            ->orderBy("lab_tools.$sortField", $sortDirection)
            ->paginate($per_page);

        return LabEquipmentResource::collection($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'entry_date' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'lab_id' => 'required',
        ], [
            'name.required' => 'فیلد نام الزامی می باشد',
            'entry_date.required' => 'فیلد تاریخ راجستر وسایل الزامی می باشد',
            'lab_id.required' => 'فیلد نام لابراتور الزامی میباشد',
            'quantity.required' => 'فیلد تعداد الزامی می باشد'
        ]);

        $user_id = Auth::user()->id;
        $labEquipment = new LabTools();
        $labEquipment->name = $request->name;
        $labEquipment->entry_date = $request->entry_date;
        $labEquipment->description = $request->description;
        $labEquipment->quantity = $request->quantity;
        $labEquipment->lab_id = $request->lab_id;
        $labEquipment->user_id = $user_id;
        $labEquipment->save();

        return response()->json([
            'success' => true,
            'message' => 'Lab Equipment Added Successfully'
        ]);
    }

    public function getAllLab()
    {
        $labs = Lab::all();
        return $labs;
    }

    public function edit($id)
    {
        $labEquipment = LabTools::find($id);
        return $labEquipment;
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'entry_date' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'lab_id' => 'required',
        ], [
            'name.required' => 'فیلد نام الزامی می باشد',
            'entry_date.required' => 'فیلد تاریخ راجستر وسایل الزامی می باشد',
            'lab_id.required' => 'فیلد نام لابراتور الزامی میباشد',
            'quantity.required' => 'فیلد تعداد الزامی می باشد'
        ]);

        $labEquipment = LabTools::find($request->id);
        $labEquipment->name = $request->name;
        $labEquipment->entry_date = $request->entry_date;
        $labEquipment->description = $request->description;
        $labEquipment->quantity = $request->quantity;
        $labEquipment->lab_id = $request->lab_id;
        $labEquipment->user_id = $request->user_id;
        $result = $labEquipment->save();

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'اطلاعات موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'اطلاعات موفقانه ویرایش نشد دوباره تلاش نماید'
            ], 304);
        }
    }


    /**
     * Deletes a record from the LabEquipment table.
     *
     * @param int $id The ID of the record to be deleted.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response indicating success or failure of the deletion operation.
     * @throws \Exception Throws an exception if the deletion fails.
     */
    public function destroy($id)
    {
        // Attempt to delete the record
        $result = LabTools::destroy($id);

        // Check if the deletion was successful
        if ($result) {
            // Return a success response with a message
            return response([
                'essage' => 'اطلاعات موفقانه حذف گردید'
            ], 200);
        } else {
            // Return a not modified response with an error message
            return response([
                'error' => 'اطلاعات  حذف نشد دوباره تلاش نماید'
            ], 304);
        }
    }
}
