<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Bank::create([
         'name' => 'Mandiri',
         'color' => 'primary',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Bank::create([
         'name' => 'BCA',
         'color' => 'info',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Bank::create([
         'name' => 'BRI',
         'color' => 'secondary',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Bank::create([
         'name' => 'BSI',
         'color' => 'success',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
   }
}
