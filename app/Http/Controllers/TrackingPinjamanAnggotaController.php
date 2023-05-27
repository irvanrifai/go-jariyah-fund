<?php

namespace App\Http\Controllers;

use App\Models\JfTrackingPinjamanAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrackingPinjamanAnggotaController extends Controller
{
    // function tracking
    // function get tracking (one row fetched)
    // function updateOrCreate tracking (one row affected)
    // function check tracking return single data which prevent/grant access action (kompleks)

    public function addUpdateTrackingPinjam($pinjam_id, $step_1_com_at = null, $step_2_com_at = null, $step_3_com_at = null, $step_4_com_at = null, $step_5_com_at = null, $step_6_com_at = null){
        if ($step_1_com_at){
            $this->addUpdateSpecific($pinjam_id, 'step_1_complete_at', $step_1_com_at);
        }
        if ($step_2_com_at){
            $this->addUpdateSpecific($pinjam_id, 'step_2_complete_at', $step_2_com_at);
        }
        if ($step_3_com_at){
            $this->addUpdateSpecific($pinjam_id, 'step_3_complete_at', $step_3_com_at);
        }
        if ($step_4_com_at){
            $this->addUpdateSpecific($pinjam_id, 'step_4_complete_at', $step_4_com_at);
        }
        if ($step_5_com_at){
            $this->addUpdateSpecific($pinjam_id, 'step_5_complete_at', $step_5_com_at);
        }
        if ($step_6_com_at){
            $this->addUpdateSpecific($pinjam_id, 'step_6_complete_at', $step_6_com_at);
        }
    }

    private function addUpdateSpecific($pinjam_id, $key, $val){
        JfTrackingPinjamanAnggota::updateOrCreate(
            [
                'pinjam_id' => $pinjam_id
            ],
            [
                $key => $val
            ]
        );
    }

    public function getTrackingPinjaman($pinjam_id){
        $data_tracking = JfTrackingPinjamanAnggota::where('pinjam_id', $pinjam_id)->first();
        return $data_tracking;
    }

    public function checkIsStepOneComplete($pinjam_id){
        $data = JfTrackingPinjamanAnggota::where('pinjam_id', $pinjam_id)->first();
        if ($data->step_1_complete_at != null) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIsStepTwoComplete($pinjam_id){
        $data = JfTrackingPinjamanAnggota::where('pinjam_id', $pinjam_id)->first();
        if ($data->step_2_complete_at != null) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIsStepThreeComplete($pinjam_id){
        $data = JfTrackingPinjamanAnggota::where('pinjam_id', $pinjam_id)->first();
        if ($data->step_3_complete_at != null) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIsStepFourComplete($pinjam_id){
        $data = JfTrackingPinjamanAnggota::where('pinjam_id', $pinjam_id)->first();
        if ($data->step_4_complete_at != null) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIsStepFiveComplete($pinjam_id){
        $data = JfTrackingPinjamanAnggota::where('pinjam_id', $pinjam_id)->first();
        if ($data->step_5_complete_at != null) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIsStepSixComplete($pinjam_id){
        $data = JfTrackingPinjamanAnggota::where('pinjam_id', $pinjam_id)->first();
        if ($data->step_6_complete_at != null) {
            return true;
        } else {
            return false;
        }
    }
}
