<?php

namespace App\Exports;

use App\Models\guest_service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GuestHistoryExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return guest_service::all();
    }

    public function map($row): array
    {
            $fields = [
                $row->fullname,
                $row->email,
                $row->telp,
                $row->gender,
                $row->old,
                $row->user_agent,
            ];
        return $fields;
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Email',
            'Nomor Telepon',
            'Umur',
            'Jenis Kelamin',
            'Perangkat'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle(1)->getFont()->setBold(true);
    }

}
