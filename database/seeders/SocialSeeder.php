<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Social::create([
         'name' => 'Facebook',
         'logo' => 'img/facebook.png',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Social::create([
         'name' => 'Instagram',
         'logo' => 'img/instagram.png',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Social::create([
         'name' => 'Twitter',
         'logo' => 'img/twitter.png',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
   }
}
