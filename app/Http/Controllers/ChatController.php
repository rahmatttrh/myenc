<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Employee;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function store(Request $req){
        $req->validate([]);
  
        $currentEmployee = Employee::where('nik', auth()->user()->username)->first();
        if (auth()->user()->hasRole('Karyawan')) {
           
           $type = 'user';
        } else {
        //    $currentEmployee = Employee::where('nik', 'EN-4-034')->first();
           $type = 'leader';
        }
  
        Chat::create([
           'task_id' => $req->task,
           'type' => $type,
           'employee_id' => $currentEmployee->id,
           'message' => $req->message
        ]);
  
        return redirect()->back()->with('success', 'Messages sent');
     }
}
