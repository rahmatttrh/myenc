<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Employee;
use App\Models\Log;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index(){
        $employees = Employee::where('status', 1)->get();
        $announcements = Announcement::get();
        return view('pages.announcement.index', [
            'employees' => $employees,
            'announcements' => $announcements
        ])->with('i');
    }

    public function store(Request $req){
        $req->validate([

        ]);

        Announcement::create([
            'type' => $req->type,
            'employee_id' => $req->employee,
            'status' => 1,
            'title' => $req->title,
            'body' => $req->body
        ]);

        if (auth()->user()->hasRole('Administrator')) {
            $departmentId = null;
         } else {
            $user = Employee::find(auth()->user()->getEmployeeId());
            $departmentId = $user->department_id;
         }
         Log::create([
            'department_id' => $departmentId,
            'user_id' => auth()->user()->id,
            'action' => 'Create',
            'desc' => 'Announcement '. $req->title
         ]);

         return redirect()->back()->with('success', 'Announcement successfully created');
    }
}
