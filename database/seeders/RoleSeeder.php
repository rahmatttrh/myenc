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
         'name' => 'Manager',
         'guard_name' => 'web'
      ]);
      Role::create([
         'name' => 'Head',
         'guard_name' => 'web'
      ]);
      Role::create([
         'name' => 'Supervisor',
         'guard_name' => 'web'
      ]);
      Role::create([
         'name' => 'Staff',
         'guard_name' => 'web'
      ]);
      Role::create([
         'name' => 'Admin',
         'guard_name' => 'web'
      ]);
   }
}
