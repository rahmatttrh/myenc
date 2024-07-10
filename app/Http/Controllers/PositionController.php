<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::orderBy('sub_dept_id')
            ->orderBy('name')
            ->get();
        return view('pages.position.position', [
            'positions' => $positions
        ])->with('i');
    }

    public function store(Request $req){
      $req->validate([]);

      Position::create([
         'sub_dept_id' => $req->subdept,
         'designation_id' => $req->designation,
         'name' => $req->name
      ]);

      return redirect()->back()->with('success', 'Position successfully added');
    }

    public function delete($id){
      $position = Position::find(dekripRambo($id));
      $employees = Employee::where('position_id', $position->id)->get();
      if (count($employees) > 0) {
         return redirect()->back()->with('danger', 'Position delete fail, this position have relation on Employee data');
      } else {
         $position->delete();
         return redirect()->back()->with('success', 'Position successfully deleted');
      }
    }

    public function update(Request $req){
      $position = Position::find($req->position);

      $position->update([
         'name' => $req->name
      ]);

      return redirect()->back()->with('success', 'Position successfully updated');
    }
}
