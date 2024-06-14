<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
   public function hit(Request $req)
   {
      $req->validate([
         'title' => 'required'
      ]);
      return response()->json([
         'success' => true,
         'msg' => 'okee'
         
      ]);
   }
}
