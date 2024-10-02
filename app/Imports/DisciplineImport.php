<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\TempDiscipline;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DisciplineImport implements ToCollection, WithHeadingRow
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection(Collection $rows)
    {

        // DB::beginTransaction();

        // // // Insert
        // try {


        foreach ($rows as $key => $row) {


            $employee = Employee::where('nik', $row['nik'])->first();

            // Cek dulu apakah nemu karyawannya dengan nik

            // Memeriksa apakah employee ada dan apakah bulan berada dalam rentang 1-12 serta tahun berada dalam rentang 2024-2030
            if ($employee && ($row['bulan'] >= 1 && $row['bulan'] <= 12) && ($row['tahun'] >= 2024 && $row['tahun'] <= 2030)) {

                // Memeriksa apakah semua nilai dari kolom 'alpa', 'ijin', dan 'terlambat' adalah angka atau null
                if (collect(['alpa', 'ijin', 'terlambat'])->every(fn ($key) => is_numeric($row[$key]) || is_null($row[$key]))) {
                    // Menginisialisasi variabel achievement dengan nilai default 1
                    $achievment = 1;

                    // Jika alpa >= 2 atau ijin >= 3 atau terlambat > 5, maka achievement tetap 1
                    if ($row['alpa'] >= 2 || $row['ijin'] >= 3 || $row['terlambat'] > 5) {
                        $achievment = 1;
                        // Jika alpa == 1 atau ijin == 2 atau terlambat di antara [4, 5], maka achievement menjadi 2
                    } elseif ($row['alpa'] == 1 || $row['ijin'] == 2 || in_array($row['terlambat'], [4, 5])) {
                        $achievment = 2;
                        // Jika alpa == null atau 0 dan ijin == 1 atau terlambat di antara [1, 2, 3], maka achievement menjadi 3
                    } elseif (($row['alpa'] === null || $row['alpa'] == 0) && ($row['ijin'] == 1 || in_array($row['terlambat'], [1, 2, 3]))) {
                        $achievment = 3;
                        // Jika alpa == null atau 0, ijin == null atau 0, dan terlambat == null atau 0, maka achievement menjadi 4
                    } elseif (($row['alpa'] === null || $row['alpa'] == 0) && ($row['ijin'] === null || $row['ijin'] == 0) && ($row['terlambat'] === null || $row['terlambat'] == 0)) {
                        $achievment = 4;
                    }

                    // Membuat entri baru di tabel TempDiscipline dengan data yang diberikan
                    TempDiscipline::create([
                        'employe_id' => $employee->id,
                        'bulan' => $row['bulan'],
                        'tahun' => $row['tahun'],
                        'alpa' => $row['alpa'],
                        'ijin' => $row['ijin'],
                        'terlambat' => $row['terlambat'],
                        'achievement' => $achievment,
                    ]);
                }
            }
        }

        //     DB::commit();


        //     return redirect()->route('success')->with('message', 'Data berhasil disimpan.');
        // } catch (\Exception $e) {
        //     // Jika terjadi kesalahan, kita rollback transaksi
        //     DB::rollback();

        //     // return back()->with('message', 'Terjadi kesalahan, data tidak dapat disimpan.');

        //     // Handle atau laporkan kesalahan
        // }
    }
}
