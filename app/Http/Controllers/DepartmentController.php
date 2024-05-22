<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use App\Models\SubDept;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
   public function index()
   {
      $departments = Department::orderBy('unit_id', 'desc')->get();
      return view('pages.department.index', [
         'departments' => $departments
      ])->with('i');
   }

   public function store(Request $req)
   {
      $req->validate([]);

      Department::create([
         'name' => $req->name
      ]);

      return redirect()->back()->with('success', 'Department successfully added');
   }

   public function edit($id)
   {
      $dekripId = dekripRambo($id);
      $department = Department::find($dekripId);

      $departments = Department::get();
      return view('pages.department.edit', [
         'departments' => $departments,
         'department' => $department
      ])->with('i');
   }

   public function update(Request $req)
   {
      $department = Department::find($req->department);
      $department->update([
         'name' => $req->name
      ]);

      return redirect()->route('department')->with('success', 'Department successfully updated');
   }

   public function delete($id)
   {
      $dekripId = dekripRambo($id);
      $department = Department::find($dekripId);

      $department->delete();
      return redirect()->route('department')->with('success', 'Department successfully deleted');
   }




   public function position()
   {
      $departments = Department::get();
      return view('pages.position.index', [
         // 'departments' => $departments
      ])->with('i');
   }

   // Fetch Data
   public function fetchData($id)
   {
      // Mengambil data dari database menggunakan model
      $data = Department::where('id', $id)->first();
      $subDepts = SubDept::where('department_id', $id)->get();
      $jmlSubDept = $subDepts->count();

      if ($jmlSubDept == 1) {
         # code...
         $subDept = SubDept::where('department_id', $id)->first();
         $positions = Position::where('sub_dept_id', $subDept->id)->orderBy('name')->get();
      } else {
         # code...
         $positions = '';
      }


      // Mengembalikan data dalam format JSON
      return response()->json([
         'data' => $data,
         'subDepts' => $subDepts,
         'positions' => $positions,
         'jmlSubDept' => $jmlSubDept
      ]);
   }
}
