<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\PayrollApproval;
use App\Models\PayslipBpjsKs;
use App\Models\UnitTransaction;
use Illuminate\Http\Request;

class PayslipBpjsKsController extends Controller
{
   public function reportBpjsKs($id)
   {
      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      $locations = Location::get();

      $reportBpjsKs = PayslipBpjsKs::where('unit_transaction_id', $unitTransaction->id)->first();

      $hrd = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'hrd')->first();
      $manHrd = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'man-hrd')->first();
      $manFin = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'man-fin')->first();
      $gm = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'gm')->first();
      $bod = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'bod')->first();

      // dd($reportBpjsKs); 


      return view('pages.payroll.report.bpjsks', [
         'reportBpjsKs' => $reportBpjsKs,
         'unitTransaction' => $unitTransaction,
         'locations' => $locations,
         'hrd' => $hrd,
         'manHrd' => $manHrd,
         'manFin' => $manFin,
         'gm' => $gm,
         'bod' => $bod,
      ]);
   }
}
