<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {

        $locations = Location::all();
        return view('Backend.Page.Master.location.index', compact('locations'));
    }

    public function create()
    {
        return view('Backend.Page.Master.location.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',

        ]);

        $location=Location::create($request->all());

        return redirect()->route('location-index')
                         ->with('success', 'location created successfully');
    }

    public function show(Location $location)
    {
        return view('Backend.Page.Master.location.show', compact('location'));
    }

    public function edit(Location $location,$id)
    {
        $location = Location::findOrFail($id);
        return view('Backend.Page.Master.location.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $location->update($request->all());

        return redirect()->route('location-index')
                         ->with('success', 'location  updated successfully');
    }
    public function locationStatus(Request $request, $locationId)
    {

        $location = Location::findOrFail($locationId);

        if($location->status==true){
            Location::where('id',$locationId)->update([
                'status' => 0
            ]);
        }else{
            Location::where('id',$locationId)->update([
            'status' => 1
        ]);

        }

        return response()->json(['message' => 'location Type status updated successfully']);
    }
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('location-index')
                         ->with('success', 'location Type deleted successfully');
    }
}
