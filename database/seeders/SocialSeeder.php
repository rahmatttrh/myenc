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
         'logo' => 'img/social/facebook.png',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Social::create([
         'name' => 'Instagram',
         'logo' => 'img/social/instagram.png',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Social::create([
         'name' => 'Twitter',
         'logo' => 'img/social/twitter.png',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Social::create([
         'name' => 'Github',
         'logo' => 'img/social/github.png',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Social::create([
         'name' => 'Linkedin',
         'logo' => 'img/social/linkedin.png',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
   }
}
