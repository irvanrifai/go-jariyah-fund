<?php

namespace App\Exports;

use App\Models\Saran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SaranExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Saran::all();
    }

    public function map($row): array
    {
            $status_g = "";
            foreach ( $row as $data)
            {
                if(($row['status']) == "draft"){
                    $status_g = "Biasa";
                }
                if(($row['status']) == "read"){   
                    $status_g = "Bagus";
                }
            }

            $fields = [
                $row->subject,
                $row->name,
                $row->email,
                $row->telp,
                $status_g,
                $row->text,
                $row->created_at,
                $row->updated_at,
                $row->user_agent,
            ];
        return $fields;
    }

    public function headings(): array
    {
        return [
            'Subjek',
            'Nama Lengkap',
            'Email',
            'Nomor Telepon',
            'Bobot Saran',
            'Keterangan Saran',
            'Dibuat Pada',
            'Diubah Pada',
            'Perangkat'  
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle(1)->getFont()->setBold(true);
    }

}   