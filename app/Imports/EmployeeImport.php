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
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Str;


class EmployeeImport implements ToCollection, WithHeadingRow
{
   public function collection(Collection $rows)
   {
      // dd('ok');
      foreach ($rows as $key => $row) {
         if($row->filter()->isNotEmpty()){
         
            if ($row['email'] == null) {
               $row['email'] = $key . '-' . time() . '@empty.com';
            }

            // Cek Bisnis Unit
            $unit = Unit::where('slug', $row['business_unit'])->first();
            if ($unit == null) {
               $unit = Unit::create([
                  'name' => Str::title(str_replace('-', ' ', $row['business_unit'])),
                  'slug' => $row['business_unit']
               ]);
            }

            

            // Cek Department
            $department = Department::where('unit_id', $unit->id)->where('slug', $row['department'])->first();
            if ($department == null) {
               $department = Department::create([
                  'unit_id' => $unit->id,
                  'name' => Str::title(str_replace('-', ' ', $row['department'])),
                  'slug' => $row['department']
               ]);
            }
            

            // Cek Sub Department
            $sub = SubDept::where('department_id', $department->id)->where('slug', $row['sub_department'])->first();
            if ($sub == null) {
               $sub = SubDept::create([
                  'department_id' => $department->id,
                  'name' => Str::title(str_replace('-', ' ', $row['sub_department'])),
                  'slug' => $row['sub_department']
               ]);
            }
            

            // Cek Designation
            $designation = Designation::where('slug', $row['designation'])->first();
            if ($designation == null) {
               $designation = Designation::create([
                  'name' => Str::title(str_replace('-', ' ', $row['designation'])),
                  'slug' => $row['designation']
               ]);
            }
            

            // Cek Position
            $position = Position::where('designation_id', $designation->id)->where('sub_dept_id', $sub->id)->where('slug', $row['position'])->first();
            if ($position == null) {
               $position = Position::create([
                  'designation_id' => $designation->id,
                  'sub_dept_id' => $sub->id,
                  'name' => Str::title(str_replace('-', ' ', $row['position'])),
                  'slug' => $row['position']
               ]);
            }
            

        

            $biodata = Biodata::create([
               'status' => 0,
               'first_name' => $row['first_name'],
               'last_name' => $row['last_name'],
               'email' => $row['email'],
               'phone' => $row['phone'],
               'gender' => $row['gender'],
               'religion' => $row['agama'], //agama
               // 'birth_place' => $row['birth_place'], //
               // 'birth_date' => $row['birth_date'], //tanggal lahir
               'no_ktp' => $row['no_ktp'],
               'no_npwp' => $row['no_npwp'], //
               'no_kk' => $row['no_kk'], //
               'no_bpjs_kesehatan' => $row['no_bpjs_kesehatan'], // bpjs
               'no_jamsostek' => $row['no_jamsostek'], //
               // 'marital' => $row['status_nikah'], // status nikah 
               // 'last_education' => $row['pendidikan_terakhir'], //pendidikan terakhir
               // 'institution_name' => $row['nama_institusi'], // nama institusi
               // 'vocational' => $row['jurusan'], //jurusan
               // 'status_pajak' => $row['status_pajak'], //
               'blood' => $row['gol_darah'], //golongan darah
               'address' => $row['alamat_domisili'], //alamat domisili
               'alamat_ktp' => $row['alamat_ktp'], //alamat ktp
               // 'status' => $row['status'],
               'created_at' => NOW(),
               'updated_at' => NOW() //

            ]);
            
            // dd('ok');
            $contract = Contract::create([
               // 'type' => $row['status'],
               'status' => 1,
               'id_no' => $row['id'],
               'unit_id' => $unit->id,
               'department_id' => $department->id,
               'sub_dept_id' => $sub->id,
               'position_id' => $position->id,
               'designation_id' => $designation->id,
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
            // dd('ok');

           
            $employee = Employee::create([
               'status' => 0,
               'unit_id' => $unit->id,
               'department_id' => $department->id,
               'sub_dept_id' => $sub->id,
               'position_id' => $position->id,
               'designation_id' => $designation->id,
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

            // $contract->update([
            //    'employee_id'
            // ])

            $user = User::create([
               'name' => $employee->biodata->first_name . ' ' . $employee->biodata->last_name,
               'email' => $employee->biodata->email,
               'username' => $employee->nik,
               'password' => Hash::make('12345678')
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
