<?php

namespace Database\Seeders;

use App\Models\PekpiDetail;
use Illuminate\Database\Seeder;

class PekpiDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PekpiDetail::create([
            'kpi_id' => 1,
            'objective' => 'Plan Maintenance',
            'kpi' => 'Membuat Plan Maintenance Weekly/Monthly',
            'weight' => 15,
            'target' => 4,
            'priode_target' => 'Weekly',
            'metode' => 'cum',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PekpiDetail::create([
            'kpi_id' => 1,
            'objective' => 'Maintenance & Repair (PC, Laptop, Printer, CCTV Network, Server , Finger Print & NVR)',
            'kpi' => 'Melakukan Maintenance & Repair secara Daily',
            'weight' => 50,
            'target' => 4,
            'priode_target' => 'Daily',
            'metode' => 'cum',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PekpiDetail::create([
            'kpi_id' => 1,
            'objective' => 'Backup & Cloning Data',
            'kpi' => 'Melakukan Backup / Cloning Data secara Daily',
            'weight' => 25,
            'target' => 4,
            'priode_target' => 'Daily',
            'metode' => 'cum',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);


        PekpiDetail::create([
            'kpi_id' => 1,
            'objective' => 'Troubleshooting, Installasi/update & Testing',
            'kpi' => 'Melakukan installasi & testing hasil installasi',
            'weight' => 10,
            'target' => 4,
            'priode_target' => 'Weekly',
            'metode' => 'cum',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
    }
}
