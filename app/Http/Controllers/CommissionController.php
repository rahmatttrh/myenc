<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
   public function store(Request $req)
   {
      $req->validate([]);

      Commission::create([
         'employee_id' => $req->employee,
         'option' => $req->option,
         'amount_option' => $req->amount_option,
         'title' => $req->title,
         'amount' => $req->amount
      ]);

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('contract')])->with('success', 'Employee Commissions successfully added');
   }
}
