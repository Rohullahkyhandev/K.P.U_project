<?php

namespace App\Http\Controllers\postgraduated;

use App\Http\Controllers\Controller;
use App\Http\Resources\LabEquipmentResource;
use App\Models\Lab;
use App\Models\LabEquipment;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class LabEquipmentController extends Controller
{


    public function index()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $data = LabEquipment::query()
            ->where('lab_equipments.name', 'like', "%{$search}%")
            ->orWhere('lab_equipments.entry_date', 'like', "%{$search}%")
            ->join('users', 'lab_equipments.user_id', 'users.id')
            ->join('labs', 'lab_equipment.lab_id', 'labs.id')
            ->select('lab_equipments.*', 'users.name as uname', 'labs.name as lname')
            ->orderBy("lab_equipments.$sortField", $sortDirection)
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

        $labEquipment = new LabEquipment();
        $labEquipment->name = $request->name;
        $labEquipment->entry_date = $request->entry_date;
        $labEquipment->description = $request->description;
        $labEquipment->quantity = $request->quantity;
        $labEquipment->lab_id = $request->lab_id;
        $labEquipment->user_id = $request->user_id;
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
        $labEquipment = LabEquipment::find($id);
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

        $labEquipment = LabEquipment::find($request->id);
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
                'message' => 'اطلاعات موفقانه ذخیره گردید'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'اطلاعات موفقانه ذخیره نشد دوباره تلاش نماید'
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
        $result = LabEquipment::destroy($id);

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
