<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\Location;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    public $unitTransaction; 
    // public $loc; 
    // public $gender; 
    // public $type; 

    public function __construct($unitTransaction)
    {
        $this->unitTransaction = $unitTransaction;
        // $this->loc = $loc;
        // $this->gender = $gender;
        // $this->type = $type;

    }
    
    public function query()
    {
        return Location::query();
    }

    public function headings(): array
    {

        return [
            [
                $this->unitTransaction->unit->name,
            ],
            [
                formatRupiahB($this->unitTransaction->unit->getUnitTransaction($this->unitTransaction)->sum('total'))
            ],
            [
                $this->unitTransaction->month,
                $this->unitTransaction->year,
            ],
            [
                '-'
            ],
            
            [
                'location',
                'Jumlah Pegawai',
                'Gaji Pokok',
                'Tunj. Jabatan',
                'Tunj. OPS',
                'Tunj. Kinerja',
                'Total Gaji',
                'Lembur',
                'Lain-lain',
                'Total Bruto',
               

                'BPJS Ketenagakerjaan',
                'BPJS Kesehatan',
                'JP',
                'Absen',
                'Terlambat',
                'Gaji Bersih',
                

            ],
            
        ];
    }

    public function map($location): array
    {
        return [
            $location->name,
            count($location->getUnitTransaction($this->unitTransaction->unit_id, $this->unitTransaction)),
            formatRupiahB($location->getValue($this->unitTransaction->unit->id, $this->unitTransaction, 'Gaji Pokok')),
            formatRupiahB($location->getValue($this->unitTransaction->unit->id, $this->unitTransaction,  'Tunj. Jabatan')),
            formatRupiahB($location->getValue($this->unitTransaction->unit->id, $this->unitTransaction, 'Tunj. OPS')),
            formatRupiahB($location->getValue($this->unitTransaction->unit->id, $this->unitTransaction, 'Tunj. Kinerja')),

            formatRupiahB($location->getValueGaji($this->unitTransaction->unit->id, $this->unitTransaction)),
            formatRupiahB($location->getUnitTransaction($this->unitTransaction->unit->id, $this->unitTransaction)->sum('overtime')),
            formatRupiahB($location->getUnitTransaction($this->unitTransaction->unit->id, $this->unitTransaction)->sum('additional_penambahan')),
            formatRupiahB($location->getUnitTransaction($this->unitTransaction->unit->id, $this->unitTransaction)->sum('bruto')),

            formatRupiahB(2/100 * $location->getValueGaji($this->unitTransaction->unit->id, $this->unitTransaction)),
            
            formatRupiahB($location->getReduction($this->unitTransaction->unit->id, $this->unitTransaction, 'BPJS KS')),
            formatRupiahB($location->getReduction($this->unitTransaction->unit->id, $this->unitTransaction, 'JP')),
            formatRupiahB($location->getUnitTransaction($this->unitTransaction->unit->id, $this->unitTransaction)->sum('reduction_absence')),
            formatRupiahB($location->getUnitTransaction($this->unitTransaction->unit->id, $this->unitTransaction)->sum('reduction_late')),
            formatRupiahB($location->getUnitTransaction($this->unitTransaction->unit->id, $this->unitTransaction)->sum('total'))
        ];
        
    }


}
