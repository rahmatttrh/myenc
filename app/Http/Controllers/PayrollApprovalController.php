<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PayrollApproval;
use App\Models\Transaction;
use App\Models\UnitTransaction;
use Illuminate\Http\Request;

class PayrollApprovalController extends Controller
{

   public function submit(Request $req)
   {
      $employee = Employee::where('nik', auth()->user()->username)->first();
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

      PayrollApproval::create([
         'unit_transaction_id' => $unitTransaction->id,
         'employee_id' => $employee->id,
         'level' => 'hrd',
         'type' => 'submit',
      ]);

      return redirect()->back()->with('success', "Transaction Data successfully sent");
   }

   public function publish(Request $req)
   {
      $employee = Employee::where('nik', auth()->user()->username)->first();
      $unitTransaction = UnitTransaction::find($req->unitTransactionId);
      $transactions = Transaction::where('unit_transaction_id', $unitTransaction->id)->get();
      // dd($unitTransaction->id);
      $unitTransaction->update([
         'status' => 6
      ]);

      foreach ($transactions as $tran) {
         $tran->update([
            'status' => 6
         ]);
      }

      PayrollApproval::create([
         'unit_transaction_id' => $unitTransaction->id,
         'employee_id' => $employee->id,
         'level' => 'hrd',
         'type' => 'publish',
      ]);

      return redirect()->back()->with('success', "Transaction Data successfully published");
   }

   public function hrd()
   {

      $unitTransactions = UnitTransaction::where('status', '=', 1)->get();

      return view('pages.payroll.approval.hrd', [
         'unitTransactions' => $unitTransactions
      ])->with('i');
   }

   public function approveHrd(Request $req)
   {

      $employee = Employee::where('nik', auth()->user()->username)->first();
      $unitTransaction = UnitTransaction::find($req->unitTransactionId);
      $transactions = Transaction::where('unit_transaction_id', $unitTransaction->id)->get();

      $unitTransaction->update([
         'status' => 2
      ]);

      foreach ($transactions as $transaction) {
         $transaction->update([
            'status' => 2
         ]);
      }

      PayrollApproval::create([
         'unit_transaction_id' => $unitTransaction->id,
         'employee_id' => $employee->id,
         'level' => 'man-hrd',
         'type' => 'approve',
      ]);

      return redirect()->back()->with('success', 'Payroll approved');
   }

   public function manfin()
   {

      $unitTransactions = UnitTransaction::where('status', '=', 2)->get();

      return view('pages.payroll.approval.hrd', [
         'unitTransactions' => $unitTransactions
      ])->with('i');
   }



   public function approveManfin(Request $req)
   {

      $employee = Employee::where('nik', auth()->user()->username)->first();
      $unitTransaction = UnitTransaction::find($req->unitTransactionId);
      $transactions = Transaction::where('unit_transaction_id', $unitTransaction->id)->get();

      $unitTransaction->update([
         'status' => 3
      ]);

      foreach ($transactions as $transaction) {
         $transaction->update([
            'status' => 3
         ]);
      }

      PayrollApproval::create([
         'unit_transaction_id' => $unitTransaction->id,
         'employee_id' => $employee->id,
         'level' => 'man-fin',
         'type' => 'approve',
      ]);

      return redirect()->back()->with('success', 'Payroll approved');
   }

   public function gm()
   {

      $unitTransactions = UnitTransaction::where('status', '=', 3)->get();

      return view('pages.payroll.approval.hrd', [
         'unitTransactions' => $unitTransactions
      ])->with('i');
   }

   public function approveGm(Request $req)
   {

      $employee = Employee::where('nik', auth()->user()->username)->first();
      $unitTransaction = UnitTransaction::find($req->unitTransactionId);
      $transactions = Transaction::where('unit_transaction_id', $unitTransaction->id)->get();

      $unitTransaction->update([
         'status' => 4
      ]);

      foreach ($transactions as $transaction) {
         $transaction->update([
            'status' => 4
         ]);
      }

      PayrollApproval::create([
         'unit_transaction_id' => $unitTransaction->id,
         'employee_id' => $employee->id,
         'level' => 'gm',
         'type' => 'approve',
      ]);

      return redirect()->back()->with('success', 'Payroll approved');
   }

   public function bod()
   {

      $unitTransactions = UnitTransaction::where('status', '=', 4)->get();

      return view('pages.payroll.approval.hrd', [
         'unitTransactions' => $unitTransactions
      ])->with('i');
   }

   public function approveBod(Request $req)
   {

      $employee = Employee::where('nik', auth()->user()->username)->first();
      $unitTransaction = UnitTransaction::find($req->unitTransactionId);
      $transactions = Transaction::where('unit_transaction_id', $unitTransaction->id)->get();

      $unitTransaction->update([
         'status' => 5
      ]);

      foreach ($transactions as $transaction) {
         $transaction->update([
            'status' => 5
         ]);
      }

      PayrollApproval::create([
         'unit_transaction_id' => $unitTransaction->id,
         'employee_id' => $employee->id,
         'level' => 'bod',
         'type' => 'approve',
      ]);

      return redirect()->back()->with('success', 'Payroll approved');
   }

   public function manhrdHistory()
   {

      $unitTransactions = UnitTransaction::where('status', '>', 1)->get();

      return view('pages.payroll.approval.history', [
         'unitTransactions' => $unitTransactions
      ])->with('i');
   }

   public function manfinHistory()
   {

      $unitTransactions = UnitTransaction::where('status', '>', 2)->get();

      return view('pages.payroll.approval.history', [
         'unitTransactions' => $unitTransactions
      ])->with('i');
   }

   public function gmHistory()
   {

      $unitTransactions = UnitTransaction::where('status', '>', 3)->get();

      return view('pages.payroll.approval.history', [
         'unitTransactions' => $unitTransactions
      ])->with('i');
   }

   public function bodHistory()
   {

      $unitTransactions = UnitTransaction::where('status', '>', 4)->get();

      return view('pages.payroll.approval.history', [
         'unitTransactions' => $unitTransactions
      ])->with('i');
   }
}
