<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Unit::create([
         'name' => 'Ekanuri',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
      Unit::create([
         'name' => 'Peip Perkasa',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
      Unit::create([
         'name' => 'Ekajaya',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
      Unit::create([
         'name' => 'Ekanuri Anugrah',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
      Unit::create([
         'name' => 'KCI',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
   }
}
