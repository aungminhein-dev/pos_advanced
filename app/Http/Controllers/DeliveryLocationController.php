<?php

namespace App\Http\Controllers;

use App\Models\DeliveryLocation;
use Illuminate\Http\Request;

class DeliveryLocationController extends Controller
{
    public function list()
    {
        $locations = DeliveryLocation::all();
        return view('admin.delivery-locations.list',compact('locations'));
    }

    public function addPage()
    {
        return view('admin.delivery-locations.add-page');
    }

    public function add(Request $request)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
            'gate_fee_status' => $request->gateFeeStatus,
            'gate_fee' => $request->gateFee
        ];
        $newLocation = DeliveryLocation::create($data);
        $this->createNotification($newLocation->id,'create');
        toastr()->success('A new location is added','Success!');
        return redirect()->route('delivery-location.list');
    }

    public function edit($id)
    {
        $location = DeliveryLocation::where('id',$id)->first();
        return view('admin.delivery-locations.edit',compact('location'));

    }

    public function update(Request $request)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
            'gate_fee_status' => $request->gateFeeStatus,
            'gate_fee' => $request->gateFee
        ];

        $locationId = DeliveryLocation::where('id',$request->id)->update($data);
        $this->createNotification($locationId,'update');
        toastr()->success('A location data has been updated.','Success');
        return redirect()->route('delivery-location.list');
    }

    private function createNotification($locationId, $action)
    {
        $location = DeliveryLocation::find($locationId);
        $message = $action === 'create' ? $location->name . " is added to delivery locations." : $location->name . " in delivery locations is updated.";
        $location->notifications()->create([
            'title' => $message,
            'description' => "Lorem ipsum dolor imet"
        ]);
    }
}
