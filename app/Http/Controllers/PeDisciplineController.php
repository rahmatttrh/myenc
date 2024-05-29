<?php

namespace App\Http\Controllers;

use App\Imports\DisciplineImport;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\PeDiscipline;
use App\Models\TempDiscipline;
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

        $datas = PeDiscipline::get();


        return view('pages.discipline.discipline', [
            'designations' => $designations,
            'departements' => $departements,
            'employes' => $employes,
            'datas' => $datas
        ])->with('i');
    }

    public function draft()
    {

        $employes = Employee::where('status', '1')
            ->get();

        // $datas = TempDiscipline::orderBy('date')
        //     ->orderBy('employe_id')
        //     ->get();

        $datas =   DB::select('
                                SELECT DISTINCT temp.*, subquery.employe_count, emp.nik, bio.first_name, bio.last_name
                                    FROM temp_disciplines temp
                                    JOIN (
                                        SELECT employe_id, COUNT(employe_id) AS employe_count, YEAR(date) AS year, MONTH(date) AS month
                                        FROM temp_disciplines
                                        GROUP BY employe_id, YEAR(date), MONTH(date)
                                    ) subquery ON temp.employe_id = subquery.employe_id
                                    JOIN employees emp ON temp.employe_id = emp.id
                                    JOIN biodatas bio ON emp.biodata_id = bio.id
                                    ORDER BY temp.date DESC ,bio.first_name ASC ;
        
        
                                ');

        return view('pages.discipline.discipline-draft', [
            'datas' => $datas,
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




        return redirect()->route('discipline.draft', enkripRambo('draft'))->with('success', 'Discipline Assesment Data successfully imported');
    }


    public function delete($id)
    {
        $dekripId = dekripRambo($id);

        $temp = TempDiscipline::find($dekripId);

        $temp->delete();
        return back()->with('success', 'Data successfully deleted');
    }

    public function applyMany(Request $req)
    {


        try {
            DB::beginTransaction();

            if ($req->apply == '1') {

                $apply = 0;
                $duplikat = 0;
                # code...
                foreach ($req->check as $key => $id) {

                    $temp = TempDiscipline::find($id);

                    $cek  = PeDiscipline::where('employe_id', $temp->employe_id)
                        ->whereDate('date', $temp->date)
                        // ->whereMonth('')
                        ->first();

                    // var_dump($cek );
                    if (!$cek) {
                        # code...]
                        $create = PeDiscipline::create([
                            'date' =>  $temp->date,
                            'employe_id' => $temp->employe_id,
                            'alpa' => $temp->alpa,
                            'ijin' => $temp->ijin,
                            'terlambat' => $temp->terlambat,
                            'achievement' => $temp->achievement,
                            'created_at' => NOW(),
                            'updated_at' => NOW()
                        ]);

                        $delete = $temp->delete();

                        $apply++;
                    } else {
                        $duplikat++;
                    }
                }


                $pesan1 = '';
                $pesan2 = '';

                if ($apply > 0) {
                    # code...
                    $pesan1 = $apply . ' Data successfully apply ';
                }
                if ($duplikat > 0) {
                    # code...
                    $pesan2 = $duplikat . ' Data already available ';
                }

                // 
                // Validasi jika data sudah ada di table PeDiscipline

                $message = [
                    'success' => $pesan1,
                    'danger' => $pesan2,
                ];
                // 
            } else if ($req->delete == '1') {
                # code...

                foreach ($req->check as $key => $id) {
                    # code...
                    // Hapus Data
                    $delete = TempDiscipline::destroy($id);
                }

                $message = 'Data successfully deleted';
            }


            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            return back()->with($message);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Handle kesalahan sesuai kebutuhan Anda
            // Misalnya, log pesan kesalahan atau kembalikan respons kesalahan ke pengguna
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
