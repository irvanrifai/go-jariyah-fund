<?php

namespace App\Exports;

use App\Models\WbsSender;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use PhpOffice\PhpSpreadsheet\Shared\Date;

class WbsSenderExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return WbsSender::all();
        $wbs = WbsSender::join('wbs_topic', 'wbs_sender.id', '=', 'wbs_topic.sender_id')
        ->get();
        return $wbs;
    }

    public function map($row): array
    {
            $fields = [
                $row->name,
                $row->phone,
                $row->email,
                $row->content,
                date("d-M-Y", strtotime($row->created_at)),
                $row->title, 
            ];
        // return dd($fields);
        return $fields;
    }

    public function headings(): array
    {
        return [
            'Nama Pelapor',
            'Nomor Telepon Pelapor',
            'Email Pelapor',
            'Tujuan',
            'Tanggal',
            'Judul Laporan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle(1)->getFont()->setBold(true);
    }

}
