<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Position;
use App\Models\SubDept;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UnitController extends Controller
{
    public function index()
    {
         $units = Unit::get();

         // Function untuk generate slug
         // running sekali lalu komen
         $departments = Department::get();
         $subs = SubDept::get();
         $positions = Position::get();
         $designations = Designation::get();

         foreach($departments as $depart){
            $depart->update([
               'slug' => Str::slug($depart->name)
            ]);   
         }
         foreach($subs as $sub){
            $sub->update([
               'slug' => Str::slug($sub->name)
            ]);   
         }
         foreach($positions as $pos){
            $pos->update([
               'slug' => Str::slug($pos->name)
            ]);   
         }
         foreach($designations as $des){
            $des->update([
               'slug' => Str::slug($des->name)
            ]);   
         }

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

      // dd(Str::slug($req->name));

      Unit::create([
         'name' => $req->name,
         'slug' => Str::slug($req->name)
      ]);

      return redirect()->back()->with('success', 'Bisnis Unit successfully added');
    }

    public function detail($id){
      $dekripId = dekripRambo($id);
      $unit = Unit::find($dekripId);
      $departments = Department::where('unit_id', $unit->id)->orderBy('name', 'asc')->get();
      $firstDept = Department::where('unit_id', $unit->id)->orderBy('name', 'asc')->first();
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
      $employees = Employee::where('unit_id', $unit->id)->get();
      // dd($unit->name);
      if (count($departments) > 0 || count($employees) > 0) {
         return redirect()->back()->with('danger', 'Bisnis Unit delete fail, data ini memiliki relasi ke data lain');
      } else {
         $unit->delete();
         return redirect()->back()->with('success', 'Bisnis Unit successfully deleted');
      }

    }

    public function update(Request $req){
      $unit = Unit::find($req->unit);

      // dd(Str::title(str_replace('-', ' ', $unit->slug)));
      $unit->update([
         'name' => $req->name,
         'slug' => Str::slug($req->name)
      ]);

      return redirect()->back()->with('success', 'Bisnis Unit successfully updated');
    }
}
