<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeLeader;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
      
        if (auth()->user()->hasRole('Karyawan')) {
           $employee = Employee::where('nik', auth()->user()->username)->first();
           $tasks = Task::where('employee_id', $employee->id)->get();
           $myteams = [];
        } else {
           $employee = Employee::where('nik', auth()->user()->username)->first();
           $myteams = EmployeeLeader::join('employees', 'employee_leaders.employee_id', '=', 'employees.id')
                 ->join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
                  ->where('leader_id', $employee->id)
                  ->select('employees.*')
                  ->orderBy('biodatas.first_name', 'asc')
                  ->get();
           $tasks = Task::get();
        }
        
  
        return view('pages.task.index', [
           'tasks' => $tasks,
           'myteams' => $myteams
        ])->with('i');
    }
  
    public function create(){
    $task = Task::get();

    return view('pages.task.create', [
        'task' => $task
    ])->with('i');
    }

    public function store(Request $req){
    $req->validate([]);

    $employee = Employee::where('nik', auth()->user()->username)->first();

    Task::create([
        'unit_id' => $employee->unit_id,
        'department_id' => $employee->department_id,
        'employee_id' => $employee->id,
        'category' => $req->kategori,
        'plan' => $req->plan,
        'target' => $req->target,
        'status' => 0
    ]);

    return redirect()->route('task')->with('success', 'Task List successfully added');
    }

    public function detail($id){
    $task = Task::find(dekripRambo($id));
    return view('pages.task.detail', [
        'task' => $task
    ]);
    }

    public function update(Request $req){
    $task = Task::find($req->task);

    if ($req->status == 2) {

        $req->validate([
            'desc' => 'required',
            'evidence' => 'required'
        ]);

        $evidence = request()->file('evidence')->store('images/task');
        $task->update([
            'status' => 2,
            'closed' => $req->date,
            'evidence' => $evidence,
            'desc' => $req->desc
        ]);
    } else {
        $task->update([
            'status' => $req->status,
            
        ]);
    }

    return redirect()->back()->with('success', 'Task successfully updated');
    }

    public function delete($id){
        $task = Task::find(dekripRambo($id));
        $task->delete();

        return redirect()->route('task')->with('success', 'Task successfully deleted');
    }
}
