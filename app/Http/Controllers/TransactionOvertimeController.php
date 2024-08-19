<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionOvertimeController extends Controller
{
   public function store(Request $req){
      dd($req->transaction);
   }
}
