<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LocationController extends Controller
{
   public function index()
   {
      $locations = Location::get();

      return view('pages.location.index', [
         'locations' => $locations
      ])->with('i');
   }

   public function store(Request $req)
   {
      // dd();

      Location::create([
         'name' => $req->name,
         'code' => Str::of($req->name)->slug('-')
      ]);

      return redirect()->back()->with('success', 'Location successfully added');
   }

   public function delete($id)
   {
      $location = Location::find(dekripRambo($id));

      $currentEmployee = Employee::where('location_id', $location->id)->first();
      if ($currentEmployee) {
         return redirect()->back()->with('danger', 'Failed');
      } else {
         // $location->delete();
         return redirect()->back()->with('success', 'Location successfully deleted');
      }
   }
}
