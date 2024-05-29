<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   /**
    * Seed the application's database.
    *
    * @return void
    */
   public function run()
   {
      // \App\Models\User::factory(10)->create();
      $this->call([
         RoleSeeder::class,
         UserSeeder::class,
         DepartmentSeeder::class,
         DesignationSeeder::class,
         UnitSeeder::class,
         ShiftSeeder::class,
         SocialSeeder::class,
         BankSeeder::class,
         PeComponentGroupSeeder::class,
         PeComponentSeeder::class,
         PeComponentForSeeder::class,
         PeKpiSeeder::class,
         PekpiDetailSeeder::class,

         EmployeeSeeder::class,
         PositionSeeder::class,
         SubDeptSeeder::class,
         BiodataSeeder::class,
         ContractSeeder::class,
         EmergencySeeder::class


         // VesselStatusSeeder::class
      ]);
   }
}
