<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\PayrollApproval;
use App\Models\PayslipBpjsKs;
use App\Models\Transaction;
use App\Models\Unit;
use App\Models\UnitTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UnitTransactionController extends Controller
{

   public function detail($id)
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

      $reportBpjsKs = PayslipBpjsKs::where('unit_transaction_id', $unitTransaction->id)->first();

      $now = Carbon::create($unitTransaction->month);
      // dd($now->addMonth()->format('F'));


      if (!$reportBpjsKs) {
         PayslipBpjsKs::create([
            'unit_transaction_id' => $unitTransaction->id,
            'month' => $now->addMonth()->format('F'),
            'year' => $unitTransaction->year,
            'status' => 0,
         ]);
      } else {
         $reportBpjsKs->update([
            'unit_transaction_id' => $unitTransaction->id,
            'month' => $now->addMonth()->format('F'),
            'year' => $unitTransaction->year,
            'status' => 0,
         ]);
      }

      // test create report bpjs ks
      // PayslipBpjsKs::create([
      //    'unit_transaction_id' => $unitTransaction->id,
      //    'month' => $unitTransaction->month,
      //    'year' => $unitTransaction->year,
      //    'status' => 0,
      // ]);

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
}
