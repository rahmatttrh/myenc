<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::get();
        return view('pages.unit.unit', [
            'units' => $units
        ])->with('i');
    }

    // Fetch Data
    public function fetchData($id)
    {

        // Mengambil data dari database menggunakan model
        $data = Unit::where('id', $id)->first();

        // Data Department
        if (auth()->user()->hasRole('Administrator|HRD')) {
            $departments = Department::where('unit_id', $id)->get();
        } else if (auth()->user()->hasRole('Leader|Manager')) {
            // Hanya di kasih akses divisi nya saja 
            $departments = Department::where('id', auth()->user()->getEmployee()->department_id)->get();
        }

        // Mengembalikan data dalam format JSON
        return response()->json([
            'data' => $data,
            'departments' => $departments
        ]);
    }

    public function store(Request $req){
      $req->validate([]);

      Unit::create([
         'name' => $req->name
      ]);

      return redirect()->back()->with('success', 'Bisnis Unit successfully added');
    }

    public function detail($id){
      $dekripId = dekripRambo($id);
      $unit = Unit::find($dekripId);
      $departments = Department::where('unit_id', $unit->id)->orderBy('created_at', 'desc')->get();
      $firstDept = Department::where('unit_id', $unit->id)->orderBy('created_at', 'desc')->first();
      $panel = 1;
      $designations = Designation::get();
      return view('pages.unit.detail', [
         'unit' => $unit,
         'departments' => $departments,
         'panel' => $panel,
         'firstDept' => $firstDept,
         'designations' => $designations
      ])->with('i');
      // dd($unit->id);
    }

    public function delete($id){
      $unit = Unit::find(dekripRambo($id));
      $departments = Department::where('unit_id', $unit->id)->get();
      // dd($unit->name);
      if (count($departments) > 0) {
         return redirect()->back()->with('danger', 'Bisnis Unit delete fail, this unit have department');
      } else {
         $unit->delete();
         return redirect()->back()->with('success', 'Bisnis Unit successfully deleted');
      }

    }

    public function update(Request $req){
      $unit = Unit::find($req->unit);
      $unit->update([
         'name' => $req->name
      ]);

      return redirect()->back()->with('success', 'Bisnis Unit successfully updated');
    }
}
