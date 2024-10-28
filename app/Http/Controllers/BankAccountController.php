<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Employee;
use App\Models\Log;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
   public function store(Request $req)
   {
      $req->validate([]);

      BankAccount::create([
         'employee_id' => $req->employee,
         'bank_id' => $req->bank,
         'account_no' => $req->account_no,
         'expired_date' => $req->expired_date
      ]);

      $employee = Employee::find($req->employee);

      if (auth()->user()->hasRole('Administrator')) {
         $departmentId = null;
      } else {
         $userNow = Employee::find(auth()->user()->getEmployeeId());
         $departmentId = $userNow->department_id;
      }


      Log::create([
         'department_id' => $departmentId,
         'user_id' => auth()->user()->id,
         'action' => 'Add',
         'desc' => 'Emergency Contact ' . $employee->nik . ' ' . $employee->biodata->fullname()
      ]);

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('personal')])->with('success', 'Bank Account successfully added');
   }

   public function update(Request $req)
   {
      $bankAccount = BankAccount::find($req->account);
      $bankAccount->update([
         'bank_id' => $req->bank,
         'account_no' => $req->account_no,
         'expired_date' => $req->expired_date
      ]);

      return redirect()->route('employee.detail', [enkripRambo($bankAccount->employee_id), enkripRambo('personal')])->with('success', 'Bank Account successfully updated');
   }

   public function delete($id)
   {
      $dekripId = dekripRambo($id);
      $bankAccount = BankAccount::find($dekripId);

      $bankAccount->delete();

      return redirect()->route('employee.detail', [enkripRambo($bankAccount->employee_id), enkripRambo('personal')])->with('success', 'Bank Account successfully deleted');
   }
}
