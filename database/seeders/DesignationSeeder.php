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
         'name' => 'Manager',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
      Designation::create([
         'name' => 'Assistant Manager',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Designation::create([
         'name' => 'Supervisor',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Designation::create([
         'name' => 'Staff',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Designation::create([
         'name' => 'Admin',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
   }
}
