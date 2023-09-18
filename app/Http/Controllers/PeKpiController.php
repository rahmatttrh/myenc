<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\PeKpa;
use App\Models\PekpaDetail;
use App\Models\PeKpi;
use App\Models\PekpiDetail;
use App\Models\PekpiPoint;
use App\Models\Unit;
use Illuminate\Http\Request;

class PeKpiController extends Controller
{
    public function index()
    {
        $employee = auth()->user()->getEmployee();

        // Data KPI
        if (auth()->user()->hasRole('Administrator|HRD')) {
            $kpis = PeKpi::get();
        } else if (auth()->user()->hasRole('Leader|Manager')) {
            $kpis = PeKpi::where('departement_id', $employee->department_id)->get();
        }

        // Data Unit
        if (auth()->user()->hasRole('Administrator|HRD')) {
            $units = Unit::orderBy('name')->get();
        } else if (auth()->user()->hasRole('Leader|Manager')) {
            $units = Unit::where('id', $employee->department->unit->id)->get();
        }

        // Data Department
        if (auth()->user()->hasRole('Administrator|HRD')) {
            $departements = Department::orderBy('name')->get();
        } else if (auth()->user()->hasRole('Leader|Manager')) {
            $departements = Department::where('id', $employee->department_id)->get();
        }

        return view('pages.kpi.kpi', [
            'units' => $units,
            'departements' => $departements,
            'kpis' => $kpis
        ])->with('i');
    }

    // digunakan utnuk apprasioal
    public function kpiEmploye($id)
    {
        $employe = Employee::find($id);
        $kpi = PeKpi::where('id', $employe->kpi_id)->first();
        $datas = PekpiDetail::where('kpi_id', $kpi->id)->get();

        $jsonData = $datas->toJson();

        return $jsonData;
    }

    public function store(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'position_id' => 'required',
            'departement_id' => 'required'
        ]);

        // Validasi KPA
        $cek = PeKpi::where([
            'position_id' => 'required',
            'departement_id' => 'required'
        ])->first();



        if ($cek) {
            return redirect()->back()->with('danger', 'KPI untuk jabatan tersebut sudah ada!');
        }

        PeKpi::create([
            'title' => $req->title,
            'position_id' => $req->position_id,
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
            ->where('position_id', $kpi->position_id)
            ->where('status', '1')
            ->where('kpi_id', null)
            ->get();


        $users = Employee::where('kpi_id', $kpi->id)
            ->get();

        return view('pages.kpi.kpi-edit', [
            'kpis' => $kpis,
            'kpi' => $kpi,
            'employes' => $employes,
            'users' => $users,
            'datas' => $datas
        ])->with('i');
    }

    public function delete($id)
    {
        // CEK APAKAH ADA RELASI DI TABLE KPA DETAIL
        $cek  =  PeKpa::where('kpi_id', dekripRambo($id))->get();
        if ($cek->count() != 0) {
            # code...
            return  back()->with('danger', 'KPI ada relasi di KPI Aprasial !');
        }

        $kpiDetail = PeKpi::find(dekripRambo($id));
        $delete = $kpiDetail->delete();

        if ($delete) {
            # code...
            return back()->with('success', 'KPI successfully deleted');
        } else {
            # code...
            return back()->with('danger', 'Failed');
        }
    }

    public function deleteObjective($id)
    {
        // CEK APAKAH ADA RELASI DI TABLE KPA DETAIL
        $cek  =  PekpaDetail::where('kpidetail_id', dekripRambo($id))->get();
        if ($cek->count() != 0) {
            # code...
            return  back()->with('danger', 'Objectie KPI ada relasi di KPI Aprasial !');
        }

        $kpiDetail = PekpiDetail::find(dekripRambo($id));
        $delete = $kpiDetail->delete();

        if ($delete) {
            # code...
            return back()->with('success', 'Objective successfully deleted');
        } else {
            # code...
            return back()->with('danger', 'Failed');
        }
    }

    public function deletePoint($id)
    {

        $point = PekpiPoint::find(dekripRambo($id));
        $delete = $point->delete();

        if ($delete) {
            # code...
            return back()->with('success', 'Point successfully deleted');
        } else {
            # code...
            return back()->with('danger', 'Failed');
        }
    }

    public function addUser(Request $req)
    {
        $req->validate([
            'kpi_id' => 'required',
            'employe_id' => 'required'
        ]);

        $result = Employee::where('id', $req->employe_id)
            ->update([
                'kpi_id' => $req->kpi_id,
            ]);


        if ($result) {
            # code...
            return redirect()->back()->with('success', 'User successfully added KPI');
        } else {
            return redirect()->back()->with('danger', 'Failed');
        }
    }

    // Store Apprasial
    public function storePoint(Request $req)
    {

        $req->validate([
            'kpi_id' => 'required',
            'pekpi_detail_id' => 'required',
            'point' => 'required',
            'keterangan' => 'required'
        ]);

        $cek = PekpiPoint::where('pekpi_detail_id', $req->pekpi_detail_id)
            ->where('point', $req->point)->first();

        if ($cek) {
            return back()->with('danger', 'Objective dengan poin ' . $req->point . ' tersebut sudah ada!');
        }

        $insert = PekpiPoint::create([
            'pekpi_detail_id' => $req->pekpi_detail_id,
            'point' => $req->point,
            'keterangan' => $req->keterangan
        ]);

        if ($insert) {
            # code...
            return back()->with('success', 'KPI Point successfully added');
        } else {
            # code...
            return back()->with('error', 'Failed');
        }
    }
}
