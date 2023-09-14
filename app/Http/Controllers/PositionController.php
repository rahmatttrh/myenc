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
}
