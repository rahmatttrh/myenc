<?php

namespace App\Http\Controllers;

use App\Models\Location;
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

      // dd($reportBpjsKs); 


      return view('pages.payroll.report.bpjsks', [
         'unitTransaction' => $unitTransaction,
         'locations' => $locations
      ]);
   }
}
