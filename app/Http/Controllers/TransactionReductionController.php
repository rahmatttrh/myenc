<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionReduction;
use Illuminate\Http\Request;

class TransactionReductionController extends Controller
{
   public function delete($id)
   {
      $transactionReduction = TransactionReduction::find(dekripRambo($id));
      $transaction = Transaction::find($transactionReduction->transaction_id);
      $transactionReduction->delete();

      $trans = new TransactionController;
      $trans->calculateTotalTransaction($transaction);

      return redirect()->back()->with('success', 'Potongan Karyawan successfylly updated');
   }
}
