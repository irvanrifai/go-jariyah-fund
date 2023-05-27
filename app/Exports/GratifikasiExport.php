<?php

namespace App\Exports;

use App\Models\Report_gratifikasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GratifikasiExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Report_gratifikasi::all();
    }

    public function map($row): array
    {
            $isAccept = "";
            $status_g = "";
            foreach ( $row as $data)
            {
                if(($row['is_accept']) == 0){
                    $isAccept = "Ditolak";
                }
                if(($row['is_accept']) == 1){   
                    $isAccept = "Diterima";
                }
                if(($row['status']) == "draft"){
                    $status_g = "Laporan Baru";
                }
                if(($row['status']) == "followup"){   
                    $status_g = "Tidak Lanjut";
                }
                if(($row['status']) == "done"){   
                    $status_g = "Selesai Tidak Lanjut";
                }
                
            }
            
            $fields = [
                $row->fullname,
                $row->position,
                $row->email,
                $row->telp,
                $row->from_company,
                $row->from_type,
                $row->date,
                $isAccept,
                $row->from_nominal_estimate,
                $status_g,
                $row->note_forward,
            ];
        return $fields;
    }

    public function headings(): array
    {
        return [
            'Nama Pelapor',
            'Jabatan',
            'Email',
            'Nomor Telepon',
            'Nama/Instansi Pemberi',
            'Jenis Gratifikasi',
            'Tanggal Penerimaan/Penolakan',
            'Jenis Penerimaan/Penolakan',
            'Nilai Taksiran (Total)',
            'Status',
            'Tindak Lanjut'  
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle(1)->getFont()->setBold(true);
    }

}
