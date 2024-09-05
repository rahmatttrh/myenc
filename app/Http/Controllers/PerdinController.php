<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Location;
use App\Models\Perdin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PerdinController extends Controller
{
   public function index()
   {
      $perdins = Perdin::get();
      $employees = Employee::get();
      return view('pages.payroll.perdin', [
         'perdins' => $perdins,
         'employees' => $employees
      ]);
   }

   public function store(Request $req)
   {
      $req->validate([]);
      $employee = Employee::find($req->employee);
      $locations = Location::get();

      foreach ($locations as $loc) {
         if ($loc->code == $employee->contract->loc) {
            $location = $loc->id;
         }
      }

      $date = Carbon::create($req->date);
      $month = $date->format('F');
      $year = $date->format('Y');

      Perdin::create([
         'unit_id' => $employee->unit_id,
         'location_id' => $location,
         'employee_id' => $employee->id,
         'date' => $req->date,
         'month' => $month,
         'year' => $year,
         'value' => $req->value,
         'desc' => $req->desc
      ]);

      return redirect()->back()->with('success', 'Perdin Data successfully added');
   }
}
