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

        // Data Department
        if (auth()->user()->hasRole('Administrator|HRD')) {
            $departments = Department::where('unit_id', $id)->get();
        } else if (auth()->user()->hasRole('Leader|Manager')) {
            // Hanya di kasih akses divisi nya saja 
            $departments = Department::where('id', auth()->user()->getEmployee()->department_id)->get();
        }

        // Mengembalikan data dalam format JSON
        return response()->json([
            'data' => $data,
            'departments' => $departments
        ]);
    }
}
