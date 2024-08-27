<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Designation::create([
         'name' => 'Staff',
         'golongan' => '1',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Designation::create([
         'name' => 'Staff',
         'golongan' => '2',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Designation::create([
         'name' => 'Team Leader',
         'golongan' => '3',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Designation::create([
         'name' => 'Supervisor',
         'golongan' => '4',
         'created_at' =>  NOW(),
         'updated_at' => NOW()
      ]);

      Designation::create([
         'name' => 'Asst. Manager',
         'golongan' => '5',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Designation::create([
         'name' => 'Manager',
         'golongan' => '6',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Designation::create([
         'name' => 'GM',
         'golongan' => '7',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
   }
}
 