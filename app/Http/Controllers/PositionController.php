<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\SubDept;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Illuminate\Support\Str;

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
      $subdept = SubDept::find($req->subdept);
      // $depart

      Position::create([
         'type' => 'subdept',
         'department_id' => $subdept->department_id,
         'sub_dept_id' => $req->subdept,
         'designation_id' => $req->designation,
         'name' => $req->name,
         'slug' => Str::slug($req->name)
      ]);

      return redirect()->back()->with('success', 'Position of Sub Department successfully added');
    }

    public function departmentStore(Request $req){
      $req->validate([]);
      $department = Department::find($req->department);
      // dd($department->name);

      // dd($req->designation);
      Position::create([
         'type' => 'dept',
         'department_id' => $req->department,
         'designation_id' => $req->designation,
         'name' => $req->name,
         'slug' => Str::slug($req->name)
      ]);

      return redirect()->back()->with('success', 'Position of Department successfully added');
    }

    public function delete($id){
      dd('deleting');
      $position = Position::find(dekripRambo($id));
      $employees = Employee::where('position_id', $position->id)->get();
      if (count($employees) > 0) {
         return redirect()->back()->with('danger', 'Position delete fail, data ini memiliki relasi ke data lain');
      } else {
         $position->delete();
         return redirect()->back()->with('success', 'Position successfully deleted');
      }
    }

    public function update(Request $req){
      $position = Position::find($req->position);

      $position->update([
         'designation_id' => $req->designation,
         'name' => $req->name,
         'slug' => Str::slug($req->name)
      ]);

      return redirect()->back()->with('success', 'Position successfully updated');
    }

    public function departUpdate(Request $req){
      $position = Position::find($req->position);
      $employee = Employee::find($req->employee);
      $department = Department::find($position->department_id);
      // dd($employee->biodata->fullName());
      // $employee->update([
      //    'unit_id' => null,
      //    'department_id' => null,
      //    'position_id' => null,
      //    'designation_id' => null
      // ]);

      $position->employees()->sync($employee->id);

      return redirect()->back()->with('success', 'Position Department successfully updated');
    }

    public function departDelete($id){
      // dd('ok');

      $position = Position::find(dekripRambo($id));
      $position->employees()->detach();
      $position->delete();

      return redirect()->back()->with('success', 'Position Department successfully deleted');

    }


}
