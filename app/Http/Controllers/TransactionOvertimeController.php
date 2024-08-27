<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionOvertimeController extends Controller
{
   public function store(Request $req){
      dd($req->transaction);
      $transaction = Transaction::find($req->transaction);

      
   }
}
