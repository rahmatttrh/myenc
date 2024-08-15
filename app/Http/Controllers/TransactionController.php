<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
   public function detail($id){
      $employee = Employee::find(dekripRambo($id));
      return view('pages.payroll.transaction.detail', [
         'employee' => $employee
      ]);
   }
}
