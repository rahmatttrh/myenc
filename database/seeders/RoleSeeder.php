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
         'name' => 'admin',
         'guard_name' => 'web'
      ]);

      Role::create([
         'name' => 'manager',
         'guard_name' => 'web'
      ]);
      Role::create([
         'name' => 'head',
         'guard_name' => 'web'
      ]);
      Role::create([
         'name' => 'superviser',
         'guard_name' => 'web'
      ]);
      Role::create([
         'name' => 'staff',
         'guard_name' => 'web'
      ]);
   }
}
