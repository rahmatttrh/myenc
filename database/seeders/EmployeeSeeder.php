<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Employee::create([
         'status' => 1,
         'user_id' => 3,
         'biodata_id' => 1,
         'contract_id' => 1,
         'department_id' => 2,
         'sub_dept_id' => 2,
         'designation_id' => 1,
         'position_id' => 1,
         'emergency_id' => 1,
         'nik' => 'EN-4-047',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
   }
}
