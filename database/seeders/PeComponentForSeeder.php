<?php

namespace Database\Seeders;

use App\Models\PeComponentFor;
use Illuminate\Database\Seeder;

class PeComponentForSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PeComponentFor::create([
            'group_id' => 1,
            'designation_id' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeComponentFor::create([
            'group_id' => 1,
            'designation_id' => 2,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeComponentFor::create([
            'group_id' => 2,
            'designation_id' => 3,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeComponentFor::create([
            'group_id' => 2,
            'designation_id' => 4,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeComponentFor::create([
            'group_id' => 2,
            'designation_id' => 5,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);


        PeComponentFor::create([
            'group_id' => 2,
            'designation_id' => 6,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeComponentFor::create([
            'group_id' => 2,
            'designation_id' => 7,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
    }
}
