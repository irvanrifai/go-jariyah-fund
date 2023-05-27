<?php

namespace App\Exports;

use App\Models\WbsRecipient;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class WbsRecipientExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return WbsRecipient::all();
        $wbs = WbsRecipient::join('wbs_topic', 'wbs_recipient.id', '=', 'wbs_topic.recipient_id')
        ->get();
        return $wbs;
    }

    public function map($row): array
    {
            $fields = [
                $row->name,
                $row->email,
                $row->status,
                $row->phone,
                $row->division,
            ];
        return $fields;
    }

    public function headings(): array
    {
        return [
            'Nama Penerima',
            'Email',
            'Status',
            'Nomor Telepon',
            'Divisi/Biro',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle(1)->getFont()->setBold(true);
    }

}
