<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DutyController extends Controller
{
   public function index(){
      return view('pages.duty.index');
   }

   public function detail(){
      return view('pages.duty.detail');
   }
}
