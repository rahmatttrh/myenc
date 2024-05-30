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
                                        SELECT employe_id, COUNT(employe_id) AS employe_count, bulan, tahun
                                        FROM temp_disciplines
                                        GROUP BY employe_id, bulan, tahun
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


        $date =  '';

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

            // Memeriksa apakah permintaan untuk menerapkan data (apply) adalah '1'
            if ($req->apply == '1') {

                $apply = 0; // Inisialisasi penghitung untuk data yang berhasil diterapkan
                $duplikat = 0; // Inisialisasi penghitung untuk data yang sudah ada (duplikat)

                // Melakukan iterasi melalui setiap ID yang diperiksa dalam permintaan
                foreach ($req->check as $key => $id) {

                    // Mencari data sementara (TempDiscipline) berdasarkan ID
                    $temp = TempDiscipline::find($id);

                    // Memeriksa apakah sudah ada data di PeDiscipline untuk karyawan dan tanggal yang sama
                    $cek  = PeDiscipline::where('employe_id', $temp->employe_id)
                        ->where('bulan', $temp->bulan)
                        ->where('tahun', $temp->tahun)
                        ->first();

                    // Jika tidak ada data yang ditemukan (tidak ada duplikat)
                    if (!$cek) {



                        // Membuat entri baru di PeDiscipline dengan data dari TempDiscipline
                        $create = PeDiscipline::create([
                            'bulan' =>  $temp->bulan,
                            'tahun' =>  $temp->tahun,
                            'employe_id' => $temp->employe_id,
                            'alpa' => $temp->alpa,
                            'ijin' => $temp->ijin,
                            'terlambat' => $temp->terlambat,
                            'achievement' => $temp->achievement,
                            'created_at' => NOW(),
                            'updated_at' => NOW()
                        ]);

                        // Menghapus entri dari TempDiscipline setelah dipindahkan ke PeDiscipline
                        $delete = $temp->delete();

                        $apply++; // Menambahkan penghitung untuk data yang berhasil diterapkan
                    } else {
                        $duplikat++; // Menambahkan penghitung untuk data yang duplikat
                    }
                }

                $pesan1 = ''; // Pesan untuk data yang berhasil diterapkan
                $pesan2 = ''; // Pesan untuk data yang duplikat

                // Membuat pesan jika ada data yang berhasil diterapkan
                if ($apply > 0) {
                    $pesan1 = $apply . ' Data successfully apply ';
                }

                // Membuat pesan jika ada data yang duplikat
                if ($duplikat > 0) {
                    $pesan2 = $duplikat . ' Data already available ';
                }

                // Membuat array pesan untuk dikembalikan sebagai tanggapan
                $message = [
                    'success' => $pesan1,
                    'danger' => $pesan2,
                ];
            }
            // Memeriksa apakah permintaan untuk menghapus data (delete) adalah '1'
            else if ($req->delete == '1') {

                // Melakukan iterasi melalui setiap ID yang diperiksa dalam permintaan
                foreach ($req->check as $key => $id) {
                    // Menghapus data dari TempDiscipline berdasarkan ID
                    $delete = TempDiscipline::destroy($id);
                }

                $message = 'Data successfully deleted'; // Pesan untuk data yang berhasil dihapus
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
