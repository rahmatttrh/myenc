<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;



class AbsenceExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings, WithStyles, WithEvents
{
    use Exportable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function query()
    {
        $query = Employee::query()->where('status', 1);

        // dd($query);

        // dd($this->data);

        // // Apply conditional query based on the $data parameter
        if (isset($this->data['date']) && isset($this->data['bu']) && isset($this->data['location'])) {

            // Jika semua bisnis unit 
            if ($this->data['bu'] == 'all') {
                # code...
            } else {
                # code...
                $query->where('unit_id', $this->data['bu']);
            }

            // Jika semua bisnis Lokasi 
            if ($this->data['location'] == 'all') {
                # code...
            } else {
                # code...
                $query->where('location_id', $this->data['location']);
            }
        }

        // Add more conditions as needed based on your specific requirements

        return $query;
    }

    public function headings(): array
    {
        return [

            [
                'Tanggal',
                'Name',
                'ID',
                'Bisnis Unit',
                'Department',
                'Location',
                'Type',
                'Desc',
                'Menit'


            ]
        ];
    }

    public function map($employee): array
    {

        return [
            $this->data['date'],
            $employee->biodata->first_name . ' ' . $employee->biodata->last_name,
            $employee->nik,
            $employee->contract->department->unit->name ?? '',
            $employee->contract->department->name ?? '',
            $employee->location->name ?? '',

        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $cellRange = 'I2:I' . $sheet->getHighestRow(); // Kolom C mulai baris 2 sampai baris terakhir

                // $validation = $sheet->getCell($cellRange)->getDataValidation();
                // $validation->setType(DataValidation::TYPE_LIST);
                // $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                // $validation->setAllowBlank(false);
                // $validation->setShowInputMessage(true);
                // $validation->setPromptTitle('Pilih  Role');
                // $validation->setPrompt('Pilih role dari daftar');
                // $validation->setFormula1('"Role 1,Role 2,Role 3"'); // Ganti dengan data role Anda
            },
        ];
    }



    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true], 'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => '399ee6']]],
            // 2    => ['font' => ['bold' => true]],



            // Styling a specific cell by coordinate.
            // 'A2' => ['rowspan' => ['2' => true]],
            'G1'    => ['font' => ['bold' => true], 'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => 'f84747']]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
}
