<?php

namespace App\Http\Controllers;

use App\Imports\DisciplineImport;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PeDisciplineController extends Controller
{
    public function index()
    {

        $employes = Employee::where('status', '1')
            ->get();

        $designations = Designation::orderBy('name')->get();
        $departements = Department::orderBy('name')->get();


        return view('pages.discipline.discipline', [
            'designations' => $designations,
            'departements' => $departements,
            'employes' => $employes,
        ])->with('i');
    }

    public function formImport()
    {

        $employes = Employee::where('status', '1')
            ->get();


        return view('pages.discipline.discipline-import', [
            'employes' => $employes,
        ])->with('i');
    }

    public function import(Request $req)
    {
        $req->validate([
            'excel' => 'required'
        ]);

        $bulan = str_pad($req->bulan, 2, '0', STR_PAD_LEFT);

        $date =  $req->tahun . '-' . $bulan . '-01';

        $file = $req->file('excel');
        $fileName = $file->getClientOriginalName();
        $file->move('discipline-assesment', $fileName);

        // try {
        //    Excel::import(new EmployeeImport, public_path('/EmployeeData/' . $fileName));
        // } catch (Exception $e) {
        //    return redirect()->back()->with('danger', 'Import Failed ' . $e->getMessage());
        // }

        Excel::import(new DisciplineImport($date), public_path('/discipline-assesment/' . $fileName));




        return redirect()->route('discipline', enkripRambo('draft'))->with('success', 'Discipline Assesment Data successfully imported');
    }
}
