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

class EmployeeExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings, WithStyles
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
                'Shift',
                'Salary',
                'Payslip',
                'Start',
                'End',


                'Phone',
                'Email',
                'No. KTP',
                'No. KK',
                'No. NPWP',
                'Status Pajak',
                'No. Jamsostek',
                'No. BPJS Kesehatan',
                'Gender',
                'Religion',
                'Tanggal Lahir',
                'Tempat Lahir',
                'Marital',
                'Post Code',
                'Blood',
                'Nationality',
                'Citizenship',
                'State',
                'City',
                'Alamat',
                'Last Education',
                'Vocational',
                'Institution Name'

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
            $employee->contract->shift->name ?? '',
            $employee->contract->salary ?? '',
            $employee->contract->payslip ?? '',
            formatDate($employee->contract->start) ?? '',
            formatDate($employee->contract->end) ?? '',

            $employee->biodata->phone,
            $employee->biodata->email,
            $employee->biodata->no_ktp,
            $employee->biodata->no_kk,
            $employee->biodata->no_npwp,
            $employee->biodata->status_pajak,
            $employee->biodata->no_jamsostek,
            $employee->biodata->no_bpjs_kesehatan,
            $employee->biodata->gender,
            $employee->biodata->religion,
            $employee->biodata->birth_date,
            $employee->biodata->birth_place,
            $employee->biodata->marital,
            $employee->biodata->post_code,
            $employee->biodata->blood,
            $employee->biodata->nationality,
            $employee->biodata->citizenship,
            $employee->biodata->state,
            $employee->biodata->city,
            $employee->biodata->address,
            $employee->biodata->last_education,
            $employee->biodata->vocational,
            $employee->biodata->institution_name,
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
