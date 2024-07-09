<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

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
}
