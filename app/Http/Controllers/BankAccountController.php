<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
   public function store(Request $req)
   {
      $req->validate([]);

      BankAccount::create([
         'employee_id' => $req->employee,
         'bank_id' => $req->bank,
         'account_no' => $req->account_no,
         'expired_date' => $req->expired_date
      ]);

      return redirect()->back()->with('success', 'Bank Account successfully added');
   }

   public function update(Request $req)
   {
      $bankAccount = BankAccount::find($req->account);
      $bankAccount->update([
         'bank_id' => $req->bank,
         'account_no' => $req->account_no,
         'expired_date' => $req->expired_date
      ]);

      return redirect()->back()->with('success', 'Bank Account successfully updated');
   }

   public function delete($id)
   {
      $dekripId = dekripRambo($id);
      $bankAccount = BankAccount::find($dekripId);

      $bankAccount->delete();

      return redirect()->back()->with('success', 'Bank Account successfully deleted');
   }
}
