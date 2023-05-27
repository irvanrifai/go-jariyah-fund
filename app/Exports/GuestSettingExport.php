<?php

namespace App\Exports;

use App\Models\GuestServiceQuestion;
use App\Models\GuestServiceAnswerOption;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class GuestSettingExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $surveyquestionans = DB::table('guest_service_questions')
        ->join('guest_service_answer_options', 'guest_service_answer_options.gs_question_id', '=', 'guest_service_questions.id')
        ->select('guest_service_questions.question as question','guest_service_questions.sort_number as sort_number', 'guest_service_questions.parent_sort_number', 'guest_service_questions.is_active as question_ia', 'guest_service_answer_options.is_active as answer_ia', 'guest_service_answer_options.text as text')
        ->get(); 
        return $surveyquestionans;
    }
    // public static function data_row(){
    //     $data_collection = self::collection();

    // }
    public function map($row): array
    {
            if (($row->parent_sort_number) == NULL){
                $nomorurut = $row->sort_number;
            }
            else{
                $nomorurut = $row->parent_sort_number.'.'.$row->sort_number;                
            }
            if (($row->question_ia) != 0){
                $status = "Tidak Ditampilkan";
            }
            else{
                $status = "Ditampilkan";
            }

        $fields = [$nomorurut, $row->question, $status, $row->text];
        
        
        return $fields;
    }

    public static function  data_table_heading(){
        $guest_report = DB::table('guest_service_questions')
        ->join('guest_service_answer_options', 'guest_service_answer_options.gs_question_id', '=', 'guest_service_questions.id')
        ->select(DB::raw(' COUNT(guest_service_answer_options.id) as total'))
        ->groupBy('guest_service_answer_options.gs_question_id')
        ->get();
        
        foreach ($guest_report as $info){
            $total_ans[] = $info->total;    
        };
        $max_ans = max($total_ans);

        $array_heading = ['Nomor','Pertanyaan',  'Status'];
        for ($i=1; $i <= $max_ans; $i++) { 
        $array_heading[] = "Opsi Jawaban ".$i;
        }
        
        return $array_heading;
    }
    public function headings(): array
    {
        $heading = self::data_table_heading();
        return $heading;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle(1)->getFont()->setBold(true);   
    }

}
