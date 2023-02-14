<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Unit;

use Illuminate\Support\Carbon;

class UnitController extends Controller
{
    public function unitListPage(){
        $unit_list = Unit::orderBy('id', 'desc')->get();
        return view('unit.unit_list')->with([
            'unit_list' => $unit_list,
        ]);
    }

    public function addUnitPage(){
        return view('unit.add_unit');
    }

    public function addUnit(Request $request){
        $request->validate([
            'unit_name' => 'required|unique:units,unit_name',
        ],[
            'unit_name.unique' => 'This unit has already added',
        ]);

        Unit::insert([
            'unit_name' => $request->unit_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Unit added!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function editUnitPage($id){
        $unit = Unit::findOrFail($id);
        return view('unit.edit_unit')->with([
            'unit' => $unit,
        ]);
    }

    public function editUnit(Request $request, $id){
        $unit = Unit::find($id);

        $unit->update([
            'unit_name' => $request->unit_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Unit updated!',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.list.page')->with($notification);
    }

    public function deleteUnit($id){
        $unit = Unit::findOrFail($id);
        $unit->delete();

        $notification = array(
            'message' => 'Unit daleted!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
