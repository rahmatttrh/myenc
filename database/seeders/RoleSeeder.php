<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Role::create([
         'name' => 'Administrator',
         'guard_name' => 'web'
      ]);

      Role::create([
         'name' => 'HRD',
         'guard_name' => 'web'
      ]);

      Role::create([
         'name' => 'Karyawan',
         'guard_name' => 'web'
      ]);

      Role::create([
         'name' => 'Leader',
         'guard_name' => 'web'
      ]);

      Role::create([
         'name' => 'Manager',
         'guard_name' => 'web'
      ]);

      Role::create([
         'name' => 'BOD',
         'guard_name' => 'web'
      ]);
   }
}
