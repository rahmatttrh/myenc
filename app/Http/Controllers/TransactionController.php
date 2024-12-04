<?php

namespace App\Http\Controllers;

use App\Exports\TransactionExport;
use App\Models\Absence;
use App\Models\Additional;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Overtime;
use App\Models\Payroll;
use App\Models\PayrollApproval;
use App\Models\Reduction;
use App\Models\ReductionAdditional;
use App\Models\ReductionEmployee;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionOvertime;
use App\Models\TransactionReduction;
use App\Models\Unit;
use App\Models\UnitTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{


   public function index()
   {
      $employees = Employee::get();
      $transactions = Transaction::get();
      $units = Unit::get();
      $firstUnit = Unit::get()->first();

      foreach ($transactions as $tran) {
         $this->calculateTotalTransaction($tran, $tran->cut_from, $tran->cut_to);
      }

      $unitTransactions = UnitTransaction::get();
      foreach ($unitTransactions as $unitTrans) {
         $transactionUnits = Transaction::where('unit_transaction_id', $unitTrans->id)->get();

         $unitTrans->update([
            'total_salary' => $transactionUnits->sum('total')
         ]);
      }

      return view('pages.payroll.transaction.index', [
         'employees' => $employees,
         'transactions' => $transactions,
         'units' => $units,
         'firstUnit' => $firstUnit
      ])->with('i');
   }


   public function employee()
   {
      $employee = Employee::where('nik', auth()->user()->username)->first();

      $transactions = Transaction::where('employee_id', $employee->id)->where('status', '>=', 5)->get();
      return view('pages.payroll.employee', [
         'transactions' => $transactions
      ]);
   }


   public function detail($id)
   {

      // dd('ok');
      // dd($employee->id);
      // $payroll = Payroll::find($employee->payroll_id);
      $transaction = Transaction::find(dekripRambo($id));

      // dd($transaction->reductions);
      $employee = Employee::find($transaction->employee_id);
      $reductions = Reduction::where('unit_id', $employee->unit_id)->get();
      $payroll = Payroll::find($employee->payroll_id);
      $transactionReductions = TransactionReduction::where('transaction_id', $transaction->id)->get();


      $from = $transaction->cut_from;
      $to = $transaction->cut_to;
      // dd('ok');
      $overtimes = Overtime::where('date', '>=', $from)->where('date', '<=', $to)->where('employee_id', $employee->id)->get();
      $totalOvertime = $overtimes->sum('rate');
      $addPenambahan = Additional::where('employee_id', $employee->id)->where('date', '>=', $from)->where('date', '<=', $to)->where('type', 1)->get()->sum('value');
      $addPengurangan = Additional::where('employee_id', $employee->id)->where('date', '>=', $from)->where('date', '<=', $to)->where('type', 2)->get()->sum('value');
      $bruto = $payroll->total + $totalOvertime;

      $absences = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year);
      $alphas = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 1);
      $lates = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 2);
      $izins = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 3);
      // dd($alphas);
      // dd('ok');


      // $reduction = $transaction->reductions->where('type', 'employee')->sum('value') + $reductionAlpha;
      $additionals = Additional::where('employee_id', $employee->id)->where('month', $transaction->month)->where('year', $transaction->year)->get();

      $alphas = $employee->absences->where('date', '>=', $from)->where('date', '<=', $to)->where('year', $transaction->year)->where('type', 1);
      $lates = $employee->absences->where('date', '>=', $from)->where('date', '<=', $to)->where('year', $transaction->year)->where('type', 2);
      $totalMinuteLate = $lates->sum('minute');

      // dd(1 * 1/30 * $payroll->total);
      foreach ($alphas as $alpha) {
         $alpha->update([
            'value' => 1 * 1 / 30 * $payroll->total
         ]);
      }
      // dd($alphas);

      // dd('ok');


      $this->calculateTotalTransaction($transaction, $transaction->cut_from, $transaction->cut_to);




      return view('pages.payroll.transaction.detail', [
         'employee' => $employee,
         'payroll' => $payroll,
         'transaction' => $transaction,
         'overtimes' => $overtimes,
         'totalOvertime' => $totalOvertime,
         'alphas' => $alphas,
         'lates' => $lates,
         'izins' => $izins,
         'absences' => $absences,
         'additionals' => $additionals,
         'totalOvertime' => $totalOvertime,
         'alphas' => $alphas,
         'lates' => $lates,
         'izins' => $izins,
         'absences' => $absences,
         'additionals' => $additionals,
         'addPenambahan' => $addPenambahan,
         'addPengurangan' => $addPengurangan
      ]);
   }


   public function storeMaster(Request $req)
   {
      $unit = Unit::find($req->unit);
      $employees = Employee::where('unit_id', $unit->id)->where('status', 1)->get();
      $current = UnitTransaction::where('unit_id', $unit->id)->where('month', $req->month)->where('year', $req->year)->first();
      if ($current) {
         return redirect()->back()->with('danger', 'Slip Gaji ' . $unit->name . ' Bulan ' . $req->month . ' ' . $req->year . ' sudah ada');
      }
      $totalSalary = 0;
      $totalEmployee = 0;

      foreach ($employees as $employee) {
         if ($employee->payroll_id != null) {
            if ($employee->contract->loc == null) {
               return redirect()->back()->with('danger', 'Data Lokasi Kerja Kosong ' . $employee->nik . ' ' . $employee->biodata->fullName());
            }
         }
      }



      $unitTransaction = UnitTransaction::create([
         'status' => 0,
         'unit_id' => $unit->id,
         'cut_from' => $req->from,
         'cut_to' => $req->to,
         'month' => $req->month,
         'year' => $req->year,
         'total_employee' => $totalEmployee,
         'total_salary' => $totalSalary
      ]);

      foreach ($employees as $emp) {
         if ($emp->payroll_id != null) {
            $totalSalary = $totalSalary + $emp->payroll->total;
            $totalEmployee = $totalEmployee + 1;

            $empTransaction = Transaction::where('employee_id', $emp->id)->where('month', $req->month)->first();
            if (!$empTransaction) {
               $this->store($emp, $req, $unitTransaction);
            }
         }
      }

      $unitTransaction->update([
         'total_employee' => $totalEmployee,
         'total_salary' => $totalSalary
      ]);




      return redirect()->back()->with('success', 'Master Transaction successfully created');

      // dd($totalSalary);
   }

   public function deleteMaster($id)
   {
      // dd('delete');
      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      $transactions = Transaction::where('unit_transaction_id', $unitTransaction->id)->get();

      foreach ($transactions as $tran) {
         $details = TransactionDetail::where('transaction_id', $tran->id)->get();
         $overtimes = TransactionOvertime::where('transaction_id', $tran->id)->get();
         $reductions = TransactionReduction::where('transaction_id', $tran->id)->get();

         foreach ($details as $detail) {
            $detail->delete();
         }
         foreach ($overtimes as $overtime) {
            $overtime->delete();
         }
         foreach ($reductions as $reduction) {
            $reduction->delete();
         }


         $tran->delete();
      }

      // dd($unitTransaction->id);
      $unitTransaction->delete();

      return redirect()->back()->with('success', 'Data Transaction successfully deleted');
   }

   public function monthly($id)
   {

      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      $unit = Unit::find($unitTransaction->unit_id);
      $units = Unit::get();
      $locations = Location::get();
      $firstLoc = Location::orderBy('id', 'asc')->first();
      $transactions = Transaction::where('unit_id', $unit->id)->where('month', $unitTransaction->month)->where('year', $unitTransaction->year)->get();

      $manhrd = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'man-hrd')->where('type', 'approve')->first();
      $manfin = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'man-fin')->where('type', 'approve')->first();
      $gm = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'gm')->where('type', 'approve')->first();
      $bod = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'bod')->where('type', 'approve')->first();


      // dd($manhrd);

      return view('pages.payroll.transaction.monthly-loc', [
         'unit' => $unit,
         'units' => $units,
         'locations' => $locations,
         'firstLoc' => $firstLoc,
         'unitTransaction' => $unitTransaction,
         'transactions' => $transactions,

         'manhrd' => $manhrd,
         'manfin' => $manfin,
         'gm' => $gm,
         'bod' => $bod,
      ])->with('i');
   }

   public function location($unit, $loc)
   {
      $unitTransaction = UnitTransaction::find(dekripRambo($unit));
      $location = Location::find(dekripRambo($loc));
      $transactions = Transaction::where('month', $unitTransaction->month)->where('year', $unitTransaction->year)->where('unit_transaction_id', $unitTransaction->id)->where('location_id', $location->id)->get();
      // dd($unitTransaction->id);

      return view('pages.payroll.transaction.location', [
         'unitTransaction' => $unitTransaction,
         'transactions' => $transactions,
         'location' => $location
      ])->with('i');
   }

   public function monthlyAll($id)
   {
      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      $unit = Unit::find($unitTransaction->unit_id);
      $units = Unit::get();
      $locations = Location::get();
      $firstLoc = Location::orderBy('id', 'asc')->first();
      $locations = Location::get();
      $firstLoc = Location::orderBy('id', 'asc')->first();
      $transactions = Transaction::where('unit_id', $unit->id)->where('month', $unitTransaction->month)->where('year', $unitTransaction->year)->get();


      $manhrd = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'man-hrd')->where('type', 'approve')->first();
      $manfin = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'man-fin')->where('type', 'approve')->first();
      $gm = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'gm')->where('type', 'approve')->first();
      $bod = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'bod')->where('type', 'approve')->first();

      return view('pages.payroll.transaction.monthly-all', [
         'unit' => $unit,
         'units' => $units,
         'locations' => $locations,
         'firstLoc' => $firstLoc,
         'locations' => $locations,
         'firstLoc' => $firstLoc,
         'unitTransaction' => $unitTransaction,
         'transactions' => $transactions,

         'manhrd' => $manhrd,
         'manfin' => $manfin,
         'gm' => $gm,
         'bod' => $bod,
      ])->with('i');
   }

   public function export($id)
   {
      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      return Excel::download(new TransactionExport($unitTransaction), 'Transaction ' . $unitTransaction->unit->name . ' ' . $unitTransaction->month . ' ' . $unitTransaction->year . '.xlsx');
   }


   public function store($emp, $req, $unitTransaction)
   {
      $employee = Employee::find($emp->id);
      $payroll = Payroll::find($employee->payroll_id);
      $locations = Location::get();

      foreach ($locations as $loc) {
         if ($loc->code == $employee->contract->loc) {
            $location = $loc->id;
         }
      }

      // if ($employee->contract->loc == null) {
      //    return redirect()->back()->with('danger', 'Data Lokasi Kerja Kosong '. $employee->nik . ' ' . $employee->biodata->fullName());
      // }

      $now = Carbon::today();
      $month = $now->format('F');
      // dd($month);
      $year = $now->format('Y');
      // dd($now->format('d/m/Y'));



      $transaction = Transaction::create([
         'status' => 0,
         'unit_transaction_id' => $unitTransaction->id,
         'unit_id' => $emp->unit_id,
         'location_id' => $location,
         'employee_id' => $employee->id,
         'payroll_id' => $payroll->id,
         'cut_from' => $req->from,
         'cut_to' => $req->to,
         'month' => $req->month,
         'year' => $req->year,
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

      $reductions = Reduction::where('unit_id', $employee->unit_id)->get();
      $reductionEmployees = ReductionEmployee::where('employee_id', $employee->id)->get();
      foreach ($reductionEmployees as $red) {
         // if ($payroll->total <= $red->reduction->min_salary) {
         //    // dd('kurang dari minimum gaju');
         //    $salary = $red->reduction->min_salary;
         //    $realSalary = $payroll->total;

         //    $bebanPerusahaan = ($red->reduction->company * $salary) / 100;
         //    $bebanKaryawan = ($red->reduction->employee * $realSalary) / 100;
         //    $bebanKaryawanReal = ($red->reduction->employee * $salary) / 100;
         //    $selisih = $bebanKaryawanReal - $bebanKaryawan;
         //    $bebanPerusahaanReal = $bebanPerusahaan + $selisih;
         //    $bebanKaryawanReal = ($red->reduction->employee * $salary) / 100;
         //    $selisih = $bebanKaryawanReal - $bebanKaryawan;
         //    $bebanPerusahaanReal = $bebanPerusahaan + $selisih;
         // } else {
         //    $salary = $payroll->total;
         //    $bebanPerusahaan = ($red->reduction->company * $salary) / 100;
         //    $bebanKaryawan = ($red->reduction->employee * $salary) / 100;
         //    $bebanKaryawanReal = 0;
         //    $bebanPerusahaanReal = $bebanPerusahaan;
         //    // $bebanKaryawanReal = 0;
         //    // $bebanPerusahaanReal = $bebanPerusahaan;
         // }
         // $bebanPerusahaan = ($red->company * $salary) / 100;
         // $bebanKaryawan = ($red->employee * $salary) / 100;
         // dd($bebanPerusahaan);

         // $reductionEmployee = ReductionEmployee::where('reduction_id', $red->id)->where('employee_id', $employee->id)->first();
         // if ($reductionEmployee->status == 1) {

         // }

         if ($red->status == 1) {
            TransactionReduction::create([
               'transaction_id' => $transaction->id,
               'reduction_id' => $red->reduction_id,
               'reduction_employee_id' => $red->id,
               'class' => $red->type,
               'type' => 'company',
               'location_id' => $location,
               'name' => $red->reduction->name . $red->description,
               'value' => $red->company_value,
               'value_real' => $red->company_value_real,
               // 'value' => $bebanPerusahaan,
               // 'value_real' => $bebanPerusahaanReal
            ]);

            TransactionReduction::create([
               'transaction_id' => $transaction->id,
               'reduction_id' => $red->reduction_id,
               'reduction_employee_id' => $red->id,
               'class' => $red->type,
               'type' => 'employee',
               'location_id' => $location,
               'name' => $red->reduction->name . $red->description,
               'value' => $red->employee_value,
               'value_real' => $red->employee_value_real,
               // 'value' => $bebanKaryawan,
               // 'value_real' => $bebanKaryawanReal
            ]);
         }
      }

      // $transactionDetails = TransactionDetail::where('transaction_id', $transaction->id)->get();


      // $overtimes = Overtime::where('month', $transaction->month)->get();
      // $totalOvertime = $overtimes->sum('rate');


      // $transaction->update([
      //    'total' => $transactionDetails->sum('value') - $transaction->reductions->where('type', 'employee')->sum('value')
      // ]);

      $this->calculateTotalTransaction($transaction, $req->from, $req->to);




      return redirect()->back()->with('success', 'Payroll Transaction successfully added');
   }



   public function calculateTotalTransaction($transaction, $from, $to)
   {
      $employee = Employee::find($transaction->employee_id);
      $payroll = Payroll::find($employee->payroll_id);
      $transactionDetails = TransactionDetail::where('transaction_id', $transaction->id)->get();

      $overtimes = Overtime::where('date', '>=', $from)->where('date', '<=', $to)->where('employee_id', $employee->id)->get();
      // dd($from);

      $alphas = $employee->absences->where('date', '>=', $from)->where('date', '<=', $to)->where('year', $transaction->year)->where('type', 1);
      foreach ($alphas as $alpha) {

         $alpha->update([
            'value' => 1 * 1 / 30 * $payroll->total
         ]);
      }
      $totalAlpha = $alphas->sum('value');


      $lates = $employee->absences->where('date', '>=', $from)->where('date', '<=', $to)->where('year', $transaction->year)->where('type', 2);
      $totalMinuteLate = $lates->sum('minute');
      $keterlambatan = intval(floor($totalMinuteLate / 30));

      $atls = $employee->absences->where('date', '>=', $from)->where('date', '<=', $to)->where('year', $transaction->year)->where('type', 3);
      $totalAtlLate = count($atls) * 2;

      $totalKeterlambatan = $keterlambatan + $totalAtlLate;


      // dd($totalKeterlambatan);

      if ($totalKeterlambatan == 6) {
         $potongan = 1 * 1 / 30 * $payroll->total;
      } elseif ($totalKeterlambatan > 6) {
         $potongan = $totalKeterlambatan - 1 * 1 / 5 * $payroll->total;
      } else {
         $potongan = 0;
      }


      $izins = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 3);

      // additoinal penambahan & pengurangan
      $addPenambahan = Additional::where('employee_id', $employee->id)->where('date', '>=', $from)->where('date', '<=', $to)->where('type', 1)->get()->sum('value');
      $addPengurangan = Additional::where('employee_id', $employee->id)->where('date', '>=', $from)->where('date', '<=', $to)->where('type', 2)->get()->sum('value');


      // $reductionAlpha = null;
      // foreach ($alphas as $alpha) {
      //    $reductionAlpha = $reductionAlpha + 1 * 1 / 30 * $payroll->total;
      // }


      // dd($overtimes->sum('rate'));
      $redAdditionals = ReductionAdditional::where('employee_id', $employee->id)->get();


      $totalReduction = $transaction->reductions->where('type', 'employee')->sum('value');
      // dd($totalReduction);
      $totalOvertime = $overtimes->sum('rate');
      $totalReductionAbsence = $totalAlpha + $potongan;


      $transaction->update([
         'overtime' => $totalOvertime,
         'reduction' => $totalReduction,
         'reduction_absence' => $totalReductionAbsence,
         'reduction_late' => $potongan,
         'additional_penambahan' => $addPenambahan,
         'additional_pengurangan' => $addPengurangan,
         'bruto' => $transactionDetails->sum('value') - $totalReduction,
         'total' => $transactionDetails->sum('value') - $totalReduction + $totalOvertime - $totalReductionAbsence + $addPenambahan - $addPengurangan - $redAdditionals->sum('employee_value') - $potongan
      ]);
   }
}
