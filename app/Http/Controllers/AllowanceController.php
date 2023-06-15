<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use Illuminate\Http\Request;

class AllowanceController extends Controller
{
   public function store(Request $req)
   {
      $req->validate([]);

      Allowance::create([
         'employee_id' => $req->employee,
         'option' => $req->option,
         'amount_option' => $req->amount_option,
         'title' => $req->title,
         'amount' => $req->amount
      ]);

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('contract')])->with('success', 'Employee Allowances successfully added');
   }

   public function delete($id)
   {
      $dekripId = dekripRambo($id);
      $allowance = Allowance::find($dekripId);
      $allowance->delete();

      return redirect()->route('employee.detail', [enkripRambo($allowance->employee_id), enkripRambo('contract')])->with('success', 'Employee Allowances successfully deleted');
   }

   public function update(Request $req)
   {
      $req->validate([]);

      $allowance = Allowance::find($req->allowance);
      $allowance->update([
         'option' => $req->option,
         'amount_option' => $req->amount_option,
         'title' => $req->title,
         'amount' => $req->amount
      ]);

      return redirect()->route('employee.detail', [enkripRambo($allowance->employee_id), enkripRambo('contract')])->with('success', 'Employee Allowances successfully updated');
   }
}
