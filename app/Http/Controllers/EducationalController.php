<?php

namespace App\Http\Controllers;

use App\Models\Educational;
use Illuminate\Http\Request;

class EducationalController extends Controller
{
   public function store(Request $req)
   {
      $req->validate([]);

      Educational::create([
         'employee_id' => $req->employee,
         'degree' => $req->degree,
         'major' => $req->major,
         'name' => $req->name,
         'year' => $req->year
      ]);

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('personal')])->with('success', 'Educational background succesfully added');
   }

   public function update(Request $req)
   {
      $educational = Educational::find($req->edu);
      $educational->update([
         'degree' => $req->degree,
         'major' => $req->major,
         'name' => $req->name,
         'year' => $req->year
      ]);

      return redirect()->route('employee.detail', [enkripRambo($educational->employee_id), enkripRambo('personal')])->with('success', 'Educational background succesfully updated');
   }

   public function delete($id)
   {
      $dekripId = dekripRambo($id);
      $educational = Educational::find($dekripId);

      $educational->delete();
      return redirect()->route('employee.detail', [enkripRambo($educational->employee_id), enkripRambo('personal')])->with('success', 'Educational background succesfully deleted');
   }
}
