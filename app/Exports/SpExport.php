<?php

namespace App\Exports;

use App\Models\Crew;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Sp;
use App\Models\Vessel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SpExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $from; 
    public $to; 

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;

    }

    
    
   public function query()
   {
      return Sp::query()->whereBetween('date_from', [$this->from, $this->to]);
      
   }

    public function headings(): array
    {
        

        return [
            
            [
               'ID',
               'NIK',
               'Name',
               'Level',
               'Desc',
               'Peraturan',
               'Date'

            ]
        ];
    }

    public function map($sp): array
    {
        // dd($this->from);
        return [
            $sp->code,
            $sp->employee->nik,
            $sp->employee->biodata->fullName(),
            'SP ' . $sp->level,
            $sp->reason,
            $sp->rule,
            formatDate($sp->date_from)

        ];
    }
}
