<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OvertimeController extends Controller
{
   public function index(){
      return view('pages.overtime.index');
   }

   public function detail(){
      return view('pages.overtime.detail');
   }
}
