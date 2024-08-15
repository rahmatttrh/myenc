<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

   public function index(){
      $employees = Employee::get();
      $transactions = Transaction::get();
      return view('pages.payroll.transaction.index', [
         'employees' => $employees,
         'transactions' => $transactions
      ])->with('i');
   }

   public function detail($id){
      $employee = Employee::find(dekripRambo($id));
      $transaction = Transaction::find(dekripRambo($id));
      // dd($transaction->id);
      return view('pages.payroll.transaction.detail', [
         'transaction' => $transaction
      ]);
   }

   public function store(Request $req){
      $employee = Employee::find($req->employee);
      $payroll = Payroll::find($employee->payroll_id);

      $now = Carbon::today();
      $month = $now->format('F');
      // dd($month);
      $year = $now->format('Y');
      // dd($now->format('d/m/Y'));
      $transaction = Transaction::create([
         'status' => 0,
         'employee_id' => $req->employee,
         'month' => $month,
         'year' => $year,
         'total' => 0
      ]);

      TransactionDetail::create([
         'transaction_id' => $transaction->id,
         'type' => 'basic',
         'desc' => 'Gaji Pokok',
         'value' => $payroll->pokok,
      ]);

      TransactionDetail::create([
         'transaction_id' => $transaction->id,
         'type' => 'basic',
         'desc' => 'Tunj. Jabatan',
         'value' => $payroll->tunj_jabatan,
      ]);

      TransactionDetail::create([
         'transaction_id' => $transaction->id,
         'type' => 'basic',
         'desc' => 'Tunj. OPS',
         'value' => $payroll->tunj_ops,
      ]);

      TransactionDetail::create([
         'transaction_id' => $transaction->id,
         'type' => 'basic',
         'desc' => 'Tunj. Kinerja',
         'value' => $payroll->tunj_kinerja,
      ]);

      TransactionDetail::create([
         'transaction_id' => $transaction->id,
         'type' => 'basic',
         'desc' => 'Tunj. Fungsional',
         'value' => $payroll->tunj_fungsional,
      ]);

      TransactionDetail::create([
         'transaction_id' => $transaction->id,
         'type' => 'basic',
         'desc' => 'Insentif',
         'value' => $payroll->insentif,
      ]);

      $transactionDetails = TransactionDetail::where('transaction_id', $transaction->id)->get();
      $transaction->update([
         'total' => $transactionDetails->sum('value')
      ]);

      return redirect()->back()->with('success', 'Payroll Transaction successfully added');
   }
}
