<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Shipper;

class ShipperController extends Controller
{
    public function shipperListPage(){
        $shippers = Shipper::orderBy('shipper', 'desc')->get();
        return view('shipper.shippers_list')->with([
            'shippers' => $shippers
        ]);
    }

    public function addShipperPage(){
        return view('shipper.add_shipper');
    }

    public function addShipper(Request $request){
        Shipper::insert([
            'shipper' => $request->shipper,
        ]);

        $notification = array(
            'message' => 'Shipper Added!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function editShipperPage($id){
        $shipper = Shipper::findOrFail($id);

        return view('shipper.edit_shipper')->with([
            'shipper' => $shipper
        ]);
    }

    public function editShipper(Request $request, $id){
        $shipper = Shipper::find($id);

        $shipper->update([
            'shipper' => $request->shipper,
        ]);

        $notification = array(
            'message' => 'Shipper Updated!',
            'alert-type' => 'success',
        );

        return redirect()->route('shipper.list.page')->with($notification);
    }

    public function deleteShipper($id){
        $shipper = Shipper::findOrFail($id);
        $shipper->delete();

        $notification = array(
            'message' => 'Shipper Deleted!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
