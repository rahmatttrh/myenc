<?php

namespace App\Exports;

use App\Models\Crew;
use App\Models\Employee;
use App\Models\Vessel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeeSimpleExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    
    
    public function query()
    {
        return Employee::query();
    }

    public function headings(): array
    {
        return [
            
            [
                'Name',
                'ID',
                'Bisnis Unit',
                'Department',
                'Level',
                'Jabatan',
                


                'Phone',
                'Email',
                
                'Tanggal Lahir',
                'Tempat Lahir',
               
                'State',
                'City',
                'Alamat',
                

            ]
        ];
    }

    public function map($employee): array
    {
        
        return [
            $employee->biodata->first_name . ' ' . $employee->biodata->last_name,
            $employee->nik,
            $employee->contract->department->unit->name ?? '',
            $employee->contract->department->name ?? '',
            $employee->contract->designation->name,
            $employee->position->name ,
            

            $employee->biodata->phone,
            $employee->biodata->email,
            
            $employee->biodata->birth_date,
            $employee->biodata->birth_place,
            
            $employee->biodata->state,
            $employee->biodata->city,
            $employee->biodata->address,
            
        ];
    }

    

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            // 2    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            // 'A2' => ['rowspan' => ['2' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }

}
