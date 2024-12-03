<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\UnitTransaction;
use Illuminate\Http\Request;

class UnitTransactionController extends Controller
{
   public function submit(Request $req)
   {
      $unitTransaction = UnitTransaction::find($req->unitTransactionId);
      $transactions = Transaction::where('unit_transaction_id', $unitTransaction->id)->get();
      // dd($unitTransaction->id);
      $unitTransaction->update([
         'status' => 1
      ]);

      foreach ($transactions as $tran) {
         $tran->update([
            'status' => 1
         ]);
      }

      return redirect()->back()->with('success', "Transaction Data successfully sent");
   }
}
