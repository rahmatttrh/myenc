<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\SubDept;
use Illuminate\Http\Request;

class SubDeptController extends Controller
{
    // Fetch Data
    public function fetchData($id)
    {
        // Mengambil data dari database menggunakan model
        $data = SubDept::where('id', $id)->first();
        $positions = Position::where('sub_dept_id', $id)->orderBy('name')->get();

        // Mengembalikan data dalam format JSON
        return response()->json([
            'data' => $data,
            'positions' => $positions
        ]);
    }


    public function store(Request $req){
      $req->validate([]);

      SubDept::create([
         'department_id' => $req->department,
         'name' => $req->name
      ]);

      return redirect()->back()->with('success', 'Sub Department successfully added');
    }

    public function update(Request $req){
      $req->validate([

      ]);

      $subdept = SubDept::find($req->subdept);
      $subdept->update([
         'name' => $req->name
      ]);

      return redirect()->back()->with('success', 'Sub Department successfully updated');
    }

    public function delete($id){
      $dekripId = dekripRambo($id);
      $subdept = SubDept::find($dekripId);
      $positions = Position::where('sub_dept_id', $subdept->id)->get();
      foreach($positions as $pos){
         $pos->delete();
      }

      $subdept->delete();

      return redirect()->back()->with('success', 'Sub Department successfully deleted');

    }
}
