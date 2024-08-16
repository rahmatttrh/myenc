<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Reduction;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionReduction;
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
      
      // dd($employee->id);
      // $payroll = Payroll::find($employee->payroll_id);
      $transaction = Transaction::find(dekripRambo($id));
      $employee = Employee::find($transaction->employee_id);
      $reductions = Reduction::where('unit_id', $employee->unit_id)->get();
      $payroll = Payroll::find($employee->payroll_id);
      $transactionReductions = TransactionReduction::where('transaction_id', $transaction->id)->get();
      $reduction = $transaction->reductions->where('type', 'employee')->sum('value');

      // $transaction->update([
      //    'total' => $payroll->total - $reduction
      // ]);
      // dd($transaction->id);
      // $reductions = Reduction::where('unit_id', $employee->unit_id)->get();
      // foreach ($reductions as $red) {
      //    if ($payroll->total <= $red->min_salary) {
      //       // dd('kurang dari minimum gaju');
      //       $salary = $red->min_salary;
      //    } else {
      //       $salary = $payroll->total;
      //    }
      //    $bebanPerusahaan = ($red->company * $salary) / 100;
      //    $bebanKaryawan = ($red->employee * $salary) / 100;
      //    // dd($bebanPerusahaan);

      //    TransactionReduction::create([
      //       'transaction_id' => $transaction->id,
      //       'type' => 'company',
      //       'name' => $red->name,
      //       'value' => $bebanPerusahaan
      //    ]);

      //    TransactionReduction::create([
      //       'transaction_id' => $transaction->id,
      //       'type' => 'employee',
      //       'name' => $red->name,
      //       'value' => $bebanKaryawan
      //    ]);
      // }

      // $transaction->update([
      //    'total' => $payroll->total - $reduction
      // ]);
      
      

      return view('pages.payroll.transaction.detail', [
         'employee' => $employee,
         'payroll' => $payroll,
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
      $reductions = Reduction::where('unit_id', $employee->unit_id)->get();
      foreach ($reductions as $red) {
         if ($payroll->total <= $red->min_salary) {
            // dd('kurang dari minimum gaju');
            $salary = $red->min_salary;
         } else {
            $salary = $payroll->total;
         }
         $bebanPerusahaan = ($red->company * $salary) / 100;
         $bebanKaryawan = ($red->employee * $salary) / 100;
         // dd($bebanPerusahaan);

         TransactionReduction::create([
            'transaction_id' => $transaction->id,
            'type' => 'company',
            'name' => $red->name,
            'value' => $bebanPerusahaan
         ]);

         TransactionReduction::create([
            'transaction_id' => $transaction->id,
            'type' => 'employee',
            'name' => $red->name,
            'value' => $bebanKaryawan
         ]);
      }
      $transaction->update([
         'total' => $transactionDetails->sum('value') - $transaction->reductions->where('type', 'employee')->sum('value')
      ]);

      return redirect()->back()->with('success', 'Payroll Transaction successfully added');
   }
}
