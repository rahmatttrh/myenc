<?php

namespace App\Http\Controllers;

use App\Models\PekpiDetail;
use Illuminate\Http\Request;

class PekpiDetailController extends Controller
{
    public function store(Request $req)
    {

        $req->validate([
            'kpi_id' => 'required',
            'metode' => 'required',
            'objective' => 'required',
            'kpi' => 'required',
            'weight' => 'required',
            'target' => 'required',
            'priode_target' => 'required'
        ]);

        $totalWeight = PekpiDetail::where('kpi_id', $req->kpi_id)->sum('weight');

        if ($totalWeight + $req->weight > 100) {
            return back()->with('danger', 'Bobot lebih dari status');
        }

        $insert = PekpiDetail::create([
            'kpi_id' => $req->kpi_id,
            'metode' => $req->metode,
            'objective' => $req->objective,
            'kpi' => $req->kpi,
            'weight' => $req->weight,
            'target' => $req->target,
            'priode_target' => $req->priode_target
        ]);

        if ($insert) {
            # code...
            return redirect()->back()->with('success', 'Objective KPI successfully added');
        } else {
            # code...
            return back()->with('danger', 'Failed');
        }
    }
}
