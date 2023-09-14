<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::get();
        return view('pages.unit.unit', [
            'units' => $units
        ])->with('i');
    }

    // Fetch Data
    public function fetchData($id)
    {
        // Mengambil data dari database menggunakan model
        $data = Unit::where('id', $id)->first();
        $departments = Department::where('unit_id', $id)->get();

        // Mengembalikan data dalam format JSON
        return response()->json([
            'data' => $data,
            'departments' => $departments
        ]);
    }
}
