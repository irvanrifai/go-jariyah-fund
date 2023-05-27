<?php

namespace App\Exports;

use App\Models\ReportConflictInterest;
use App\Models\Unit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ConflictInterestExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $conflict = ReportConflictInterest::join('units', 'report_conflict_interests.unit_id', '=', 'units.id')
        ->get();
        return $conflict;
    }

    public function map($row): array
    {
            $status_g = "";
            $type_g = "";
            foreach ( $row as $data)
            {
                if(($row['status']) == "draft"){
                    $status_g = "Laporan Baru";
                }
                if(($row['status']) == "followup"){   
                    $status_g = "Sedang Diproses";
                }
                if(($row['status']) == "done"){   
                    $status_g = "Sudah Diproses";
                }

                if(($row['type']) == "afiliasi"){   
                    $type_g = "Hubungan Afiliasi (Pribadi dan Golongan)";
                }
                if(($row['type']) == "gratifikasi"){   
                    $type_g = "Pekerjaan Tambahan";
                }
                if(($row['type']) == "kerja_tambahan"){   
                    $type_g = "Sudah Diproses";
                }
                if(($row['type']) == "orang_dalam"){   
                    $type_g = "Informasi Orang Dalam";
                }
                if(($row['type']) == "pengadaan_barang"){   
                    $type_g = "Kepentingan Dalam Pengadaan Barang";
                }
                if(($row['type']) == "tuntutan_keluarga"){   
                    $type_g = "Tuntutan Keluarga dan Komunitas";
                }
                if(($row['type']) == "kedudukan_ganda"){   
                    $type_g = "Kedudukan di Organisasi Lain";
                }
                if(($row['type']) == "intervensi_jabatan"){   
                    $type_g = "Intervensi Pada Jabatan Sebelumnya";
                }
                if(($row['type']) == "rangkap_jabatan"){   
                    $type_g = "Perangkapan Jabatan";
                }
            }

            $fields = [
                $row->fullname,
                $row->telp,
                $row->email,
                $row->reported_fullname,
                $row->reported_position,
                $row->unit,
                $type_g,
                $row->date,
                $row->location,
                $row->text,
                $status_g,
                $row->note
            ];
        return $fields;
//         return dd($row);
    }

    public function headings(): array
    {
        return [
            'Nama Pelapor',
            'Nomor Telepon Pelapor',
            'Email Aktif Pelapor',
            'Nama Terlapor',
            'Jabatan Terlapor',
            'Unit Eselon 2 Terlapor',
            'Jenis Benturan Kepentingan',
            'Tanggal Kejadian',
            'Lokasi Kejadian',
            'Detail Benturan Kepentingan',
            'Status',
            'Tindak Lanjut'  
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle(1)->getFont()->setBold(true);
    }

}