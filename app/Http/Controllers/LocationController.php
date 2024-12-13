<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
   public function index()
   {
      $locations = Location::get();

      return view('pages.location.index', [
         'locations' => $locations
      ])->with('i');
   }
}
