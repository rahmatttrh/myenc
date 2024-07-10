<?php

namespace App\Imports;

use App\Models\Biodata;
use App\Models\Contract;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Emergency;
use App\Models\Employee;
use App\Models\Position;
use App\Models\SubDept;
use App\Models\Unit;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


class EmployeeImport implements ToCollection, WithHeadingRow
{
   public function collection(Collection $rows)
   {
      // dd('ok');
      foreach ($rows as $key => $row) {
         if($row->filter()->isNotEmpty()){
         // Cari bis nis unid 
         // $unit = Unit::where('name', $row['business_unit'])->first();

         // Jika tidak ada insert baru
         // if ($unit == null) {
         //    $unit = Unit::create([
         //       'name' => $row['business_unit'],
         //       'created_at' => NOW(),
         //       'updated_at' => NOW()
         //    ]);
         // }

         // Cari departement
         // $department = Department::where('name', $row['department'])
         //    ->where('unit_id', $unit->id)
         //    ->first();
         // Jika tidak ada insert baru
         // if ($department == null) {

         //    $department = Department::create([
         //       'unit_id' => $unit->id,
         //       'name' => $row['department'],
         //       'created_at' => NOW(),
         //       'updated_at' => NOW()
         //    ]);
         // }

         // Cari sub departement
         // $sub_dept = SubDept::where('name', $row['sub_dept'])
         //    ->where('department_id', $department->id)
         //    ->first();
         // // Jika tidak ada insert baru
         // if ($sub_dept == null) {

         //    $sub_dept = SubDept::create([
         //       'department_id' => $department->id,
         //       'name' => $row['sub_dept'],
         //       'created_at' => NOW(),
         //       'updated_at' => NOW()
         //    ]);
         // }

         // Designation atau level
         // $designation = Designation::where('golongan', $row['golongan'])
         //    ->first();

         // Mencari position 
         // $position = Position::where('name', $row['jabatan'])->where('sub_dept_id', $sub_dept->id)->where('designation_id', $designation->id)->first();
         // jika tidak ada insert baru 
         // if ($position == null) {

         //    $position = Position::create([
         //       // 'sub_dept_id' => $sub_dept->id,
         //       // 'designation_id' => $designation->id,
         //       // 'name' => $row['jabatan'],
         //       'created_at' => NOW(),
         //       'updated_at' => NOW()
         //    ]);
         // }

         if ($row['email'] == null) {
            $row['email'] = $key . '-' . time() . '@empty.com';
         }

         // Mencari Role 
         // if ($row['golongan'] == '1' || $row['golongan'] == '2') {
         //    $role = 3;
         // } else if ($row['golongan'] == '3' || $row['golongan'] == '4') {
         //    $role = 4;
         // } else if ($row['golongan'] == '5' || $row['golongan'] == '6'  || $row['golongan'] == '7') {
         //    $role = 5;
         // }

         // DB::beginTransaction();

         // // // Insert
         // try {

            $biodata = Biodata::create([
               'status' => 0,
               'first_name' => $row['first'],
               'last_name' => $row['last'],
               'email' => $row['email'],
               'phone' => $row['phone'],
               'gender' => $row['gender'],
               // 'religion' => $row['religion'], //agama
               // 'birth_place' => $row['birth_place'], //
               // 'birth_date' => $row['birth_date'], //tanggal lahir
               // 'no_ktp' => $row['no_ktp'],
               // 'no_npwp' => $row['no_npwp'], //
               // 'no_kk' => $row['no_kk'], //
               // 'no_bpjs_kesehatan' => $row['no_bpjs_kesehatan'], // bpjs
               // 'no_jamsostek' => $row['no_jamsostek'], //
               // 'marital' => $row['status_nikah'], // status nikah 
               // 'last_education' => $row['pendidikan_terakhir'], //pendidikan terakhir
               // 'institution_name' => $row['nama_institusi'], // nama institusi
               // 'vocational' => $row['jurusan'], //jurusan
               // 'status_pajak' => $row['status_pajak'], //
               // 'blood' => $row['gol_darah'], //golongan darah
               'address' => $row['address'], //alamat domisili
               // 'alamat_ktp' => $row['alamat_ktp'], //alamat ktp
               // 'status' => $row['status'],
               'created_at' => NOW(),
               'updated_at' => NOW() //

            ]);
            // dd('ok');
            $contract = Contract::create([
               'id_no' => $row['id'],
               'unit_id' => $row['business_unit'],
               'department_id' => $row['department'],
               'sub_dept_id' => $row['sub_department'],
               'position_id' => $row['position'],
               // 'designation_id' => $designation->id,
               // 'location' => $row['lokasi'],
               // 'project' => $row['project'],
               // 'start' => $row['tanggal_awal_kontrak'],
               // 'end' => $row['tanggal_akhir_kontrak'],
               // 'salary' => $row['salary'],
               // 'payslip' => $row['payslip_type'],
               'created_at' => NOW(),
               'updated_at' => NOW()
            ]);

            // Insert Contract udah Oke
            // $emergency = Emergency::create([
            //    'name' => $row['nama_kontak_darurat'],
            //    'phone' => $row['kontak_darurat'],
            //    'hubungan' => $row['hubungan'],
            //    'created_at' => NOW(),
            //    'updated_at' => NOW()
            // ]);

            $employee = Employee::create([
               'status' => 0,
               'unit_id' => $row['business_unit'],
               'department_id' => $row['department'],
               'sub_dept_id' => $row['sub_department'],
               'position_id' => $row['position'],
               // 'role' => $role,
               // 'designation_id' => $designation->id,
               'biodata_id' => $biodata->id,
               'contract_id' => $contract->id,
               // 'emergency_id' => $emergency->id,
               'nik' => $row['id'],
               // 'entry_date' => $row['tanggal_masuk'],
               // 'determination_date' => $row['tanggal_penetapan'],
               'created_at' => NOW(),
               'updated_at' => NOW()

            ]);

            // DB::commit();


            // return redirect()->route('success')->with('message', 'Data berhasil disimpan.');
         // } catch (\Exception $e) {
         //    // Jika terjadi kesalahan, kita rollback transaksi
         //    DB::rollback();

         //    return back()->with('message', 'Terjadi kesalahan, data tidak dapat disimpan.');

         //    // Handle atau laporkan kesalahan
         // }
         }
      }
   }
}
