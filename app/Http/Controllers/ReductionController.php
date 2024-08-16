<?php

namespace App\Http\Controllers;

use App\Models\Reduction;
use Illuminate\Http\Request;

class ReductionController extends Controller
{
   public function store(Request $req){
      // dd('ok');
      $reduction = Reduction::where('name', $req->desc)->where('unit_id', $req->unit)->first();
      if ($reduction != null) {
         return redirect()->back()->with('danger', 'Reduction Type sudah ada');
      }

      Reduction::create([
         'unit_id' => $req->unit,
         'name' => $req->desc,
         'min_salary' => $req->min_salary,
         'max_salary' => $req->max_salary,
         'company' => $req->company,
         'employee' => $req->employee
      ]);

      return redirect()->back()->with('success', 'Reduction Unit successfully added');
   }
}
