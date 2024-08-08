<?php

namespace App\Http\Controllers;

use App\Models\SubDept;
use Illuminate\Http\Request;

class MyController extends Controller
{
   public function updatePosition(){
      $subdept = SubDept::find(9);
      dd($subdept->name);
   }
}
