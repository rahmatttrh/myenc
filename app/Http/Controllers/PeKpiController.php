<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\PeKpi;
use App\Models\PekpiDetail;
use Illuminate\Http\Request;

class PeKpiController extends Controller
{
    public function index()
    {

        $kpis = PeKpi::get();

        $designations = Designation::orderBy('name')->get();
        $departements = Department::orderBy('name')->get();

        return view('pages.kpi.kpi', [
            'designations' => $designations,
            'departements' => $departements,
            'kpis' => $kpis
        ])->with('i');
    }

    public function store(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'designation_id' => 'required',
            'departement_id' => 'required'
        ]);

        PeKpi::create([
            'title' => $req->title,
            'designation_id' => $req->designation_id,
            'departement_id' => $req->departement_id

        ]);

        return redirect()->back()->with('success', 'KPI successfully added');
    }

    public function edit($id)
    {
        // dd($id);

        $kpis = PeKpi::get();
        $kpi = PeKpi::find(dekripRambo($id));
        $datas = PekpiDetail::where('kpi_id', dekripRambo($id))->get();
        $employes = Employee::where('department_id', $kpi->departement_id)
            ->where('status', '1')
            ->where('kpi_id', null)
            ->get();
        $users = Employee::where('kpi_id', $kpi->id)->get();
        // dd($kpi->departement_id);

        // dd($employes);

        $designations = Designation::orderBy('name')->get();

        return view('pages.kpi.kpi-edit', [
            'designations' => $designations,
            'kpis' => $kpis,
            'kpi' => $kpi,
            'employes' => $employes,
            'users' => $users,
            'datas' => $datas
        ])->with('i');
    }
}
