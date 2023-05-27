<?php

use App\Http\Controllers\PostMetaController;
use App\Http\Controllers\PostsController;
use App\Models\DayOffSetting;
use App\Models\FeedbackTimeDuration;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * Print HTML Text to Show if Field is Required or Not
 *
 */
function printRequired($text = '*', $title = 'Wajib Diisi!')
{
    return "<small class='text-danger' title='" . $title . "' data-toggle='tooltip' data-placement='top'>" . $text . "</small>";
}

/**
 * Get FIle Url
 * @param $file
 */
function get_file_link($file)
{
    if ($file) {
        echo '<a href="' . env('APP_URL') . '/storage/' . $file . '" target="_blank" type="button" class="btn btn-link">Download</a>';
    } else {
        echo 'Tidak Ada';
    }
}

/**
 * Get Sender Profile Data
 * @param null $id
 * @return mixed
 */
function get_sender_data($id = null)
{
    return \App\Http\Controllers\WbsSenderController::get_sender_data($id);
}

/**
 * Get Recipient Profile Data
 * @param null $id
 * @return mixed
 */
function get_recipient_data($id = null)
{
    return \App\Http\Controllers\WbsRecipientController::get_recipient_data($id);
}

function get_topic_data($id = null)
{
    return \App\Http\Controllers\WbsTopicController::get_topic_data($id);
}

/**
 * WBS Topic Status String
 * @param null $id
 * @return mixed
 */
function get_wbs_status_string($string = null)
{
    switch ($string) {
        case 'new':
            echo '<span class="hl hl-yellow hl-small">Menunggu Response</span>';
            break;
        case 'on-progress':
            echo '<span class="hl hl-green hl-small">Dalam Proses</span>';
            break;
        case 'closed':
            echo '<span class="hl hl-red hl-small">Tidak Diproses</span>';
            break;
        case 'no-response':
            echo '<span class="hl hl-red hl-small">Tidak Diproses</span>';
            break;
        case 'finish':
            echo '<span class="hl hl-green hl-small">Laporan Selesai</span>';
            break;
        default:
            echo '<span class="hl hl-green hl-small">Menunggu Response</span>';
    }
}

function get_wbs_status_color_badge($string = null)
{
    switch ($string) {
        case 'new':
            return 'primary';
            break;
        case 'on-progress':
            return 'warning';
            break;
        case 'closed':
            return 'danger';
            break;
        case 'no-response':
            return 'danger';
            break;
        case 'finish':
            return 'success';
            break;
        default:
            return 'primary';
    }
}

function get_wbs_status_string_detail($string = null)
{
    switch ($string) {
        case 'new':
            return 'Menunggu Response';
            break;
        case 'on-progress':
            return 'Dalam Proses';
            break;
        case 'closed':
            return 'Tidak Diproses';
            break;
        case 'no-response':
            return 'Tidak Diproses';
            break;
        case 'finish':
            return 'Laporan Selesai';
            break;
        default:
            return 'Menunggu Response';
    }
}

/**
 * Get Post Meta
 */

function get_meta_value($slug, $key)
{
    return PostMetaController::get_meta($slug, $key);
}

function get_response_time($last_time_response)
{
    $origin = date_create(date('Y-m-d H:i:s', strtotime('now')));
    $target = date_create(date('Y-m-d H:i:s', strtotime($last_time_response)));
    if ($origin < $target) {
        $interval = date_diff($origin, $target);
        return $interval->format('%d hari %h jam %i menit %s detik');
    } else {
        return 'Waktu untuk merespon telah habis';
    }
}

function get_last_actor_feedback($type)
{
    if ($type === 'sender-response') {
        return 'Terlapor';
    }
    if ($type === 'recipient-response') {
        return 'Pelapor';
    }
}

function generateCodeLetter($last_number)
{
    $digit = strlen($last_number);
    $new_last_number = $last_number;
    while ($digit < 4) {
        $new_last_number = '0' . $new_last_number;
        $digit++;
    }
    return $new_last_number;
}

function build_page_link($slug_name, $static_slug, $classes, $title = '', $type = 'page', $target = '_self')
{
    $base_url = env('APP_URL', 'https://kemenkopukm.go.id');

    if (Str::slug($slug_name) === Str::slug($static_slug)) {
        $classes = $classes . ' active';
    }

    if ($type === 'page') {
        $base_url = $base_url . 'p';
    }

    if ($type === 'category') {
        $base_url = $base_url . '/kategori';
    }

    echo sprintf(
        '<a href="%1$s" title="%2$s" rel="bookmark" target="%3$s" class="%4$s">%2$s</a>',
        $base_url . '/' . $static_slug,
        $title,
        $target,
        $classes
    );
}

function helperHumanTime($time, $function = 'diffForHumans')
{
    return \Carbon\Carbon::parse($time)->$function();
}


function get_post_category($id, $key = null)
{
    return PostsController::get_post_category($id, $key);
}

function convert_status_gratifikasi_or_conflict_interest($status)
{
    if ($status === 'Belum di proses') {
        return 'draft';
    } else if ($status === 'Di tindaklanjuti') {
        return 'followup';
    } else if ($status === 'Selesai') {
        return 'done';
    }
}

function get_status_gratifikasi_or_conflict_interest($status)
{
    if ($status === 'followup') {
        return 'sedang diproses tindak lanjut';
    } else if ($status === 'done') {
        return 'telah ditindaklanjut dengan hasil sebagaimana terlampir';
    } else {
        return '';
    }
}

function get_is_show_message_gratifikasi_or_conflict_interest($status)
{
    if ($status === 'followup') {
        return true;
    } else if ($status === 'done') {
        return false;
    } else {
        return false;
    }
}

function convert_type_conflict_interest($value)
{
    switch ($value) {
        case 'Afiliasi':
            return 'afiliasi';
            break;
        case 'Gratifikasi':
            return 'gratifikasi';
            break;
        case 'Kerja Tambahan':
            return 'kerja_tambahan';
            break;
        case 'Orang Dalam':
            return 'orang_dalam';
            break;
        case 'Pengadaan Barang':
            return 'pengadaan_barang';
            break;
        case 'Tuntutan Keluarga':
            return 'tuntutan_keluarga';
            break;
        case 'Kedudukan Ganda':
            return 'kedudukan_ganda';
            break;
        case 'Intervensi Jabatan':
            return 'intervensi_jabatan';
            break;
        case 'Rangkap Jabatan':
            return 'rangkap_jabatan';
            break;
        default:
            return false;
            break;
    }
}

function convert_is_accept_gratifikasi($value)
{
    return ($value === 'Diterima') ? 1 : 0;
}

function convert_nominal_gratifikasi($value)
{
    switch ($value) {
        case '< Rp 1.000.000':
            return [0, 999999];
            break;
        case 'Rp. 1.000.000 - Rp. 30.000.000':
            return [1000000, 29999999];
            break;
        case 'Rp. 30.000.000 - Rp. 50.000.000':
            return [30000000, 49999999];
            break;
        case '> Rp. 50.000.000':
            return [50000000, 1000000000000];
            break;
        default:
            return false;
            break;
    }
}

function convert_status_wbs_topic($value)
{
    switch ($value) {
        case 'Belum di proses':
            return 'new';
            break;
        case 'Proses':
            return 'on-progress';
            break;
        case 'Selesai':
            return 'finish';
            break;
        case 'Tidak Diproses':
            return 'no-response';
            break;
        default:
            return false;
            break;
    }
}

function convert_gender_guest($value)
{
    switch ($value) {
        case 'Laki - laki':
            return 'male';
            break;
        case 'Perempuan':
            return 'female';
            break;
        default:
            return false;
            break;
    }
}

function convert_old_guest($value)
{
    switch ($value) {
        case '< 20':
            return [0, 20];
            break;
        case '21 - 30':
            return [21, 30];
            break;
        case '31 - 40':
            return [31, 40];
            break;
        case '41 - 50':
            return [41, 50];
            break;
        case '> 50':
            return [51, 100];
            break;
        default:
            return false;
            break;
    }
}

function convert_last_education($value){
    switch ($value) {
        case 'Sekolah Dasar':
            return 'sd';
            break;
        case 'Sekolah Menengah Pertama':
            return 'smp';
            break;
        case 'Sekolah Menengah Atas':
            return 'sma';
            break;
        case 'Diploma':
            return 'diploma';
            break;
        case 'Sarjana':
            return 's1';
            break;
        case 'Magister':
            return 's2';
            break;
        case 'Doktor':
            return 's3';
            break;
        default:
            return false;
            break;
    }
}

function getDayOff()
{
    //  Jam
    $intervalHourResponse = \App\Models\FeedbackTimeDuration::pluck('duration')->first();

    // Menit yang harusnya jadi 0
    $minuteLoop = $intervalHourResponse * 60;

    // Menit yang akan di return
    $minuteTotal = 0;
    $iterate = 0;
    $full_day_minute = 24 * 60;
    $currDate = date_create(date('Y-m-d H:i:s', strtotime('now')));

    do {
        $currDay = $currDate->format('N');
        $isDayOffDate = App\Models\DayOffSetting::where('date', $currDate->format('Y-m-d'))->where('is_active', 1)->exists();

        // Hari itu bukan hari libur dan hari itu bukan hari sabtu dan minggu
        if (!$isDayOffDate && $currDay != 6 && $currDay != 7) {
            /**
             * Bukan hari libur
             */

            /**
             * Hari itu kurang berapa jam menit dan waktu
             */

            $minute_interval = 0;

            if ($iterate == 0) {
                $maxCurrDate = date_create(date("Y-m-d 23:59:59"));
                $hour = date_diff($currDate, $maxCurrDate)->format('%h');
                $minute = date_diff($currDate, $maxCurrDate)->format('%i');
                $minute_interval = ($hour * 60) + $minute;
                if ($minuteLoop > $minute_interval) {
                    $minuteLoop -= $minute_interval;
                    $minuteTotal += $minute_interval;
                } else if ($minuteLoop < $minute_interval) {
                    $minuteTotal += $minuteLoop;
                    $minuteLoop = 0;
                }
            } else if ($iterate > 0) {
                if ($minuteLoop >= $full_day_minute) {
                    $minuteLoop -= $full_day_minute;
                    $minuteTotal += $full_day_minute;
                } else if ($minuteLoop <= $full_day_minute) {
                    $minuteTotal += $minuteLoop;
                    $minuteLoop = 0;
                }
            }
        } else {
            if ($iterate == 0) {
                $maxCurrDate = date_create(date("Y-m-d 23:59:59"));
                $hour = date_diff($currDate, $maxCurrDate)->format('%h');
                $minute = date_diff($currDate, $maxCurrDate)->format('%i');
                $minute_interval = ($hour * 60) + $minute;

                $minuteTotal += $minute_interval;
            } else if ($iterate > 0) {
                $minuteTotal += $full_day_minute;
            }
        }

        $iterate++;
        $currDate = $currDate->modify('+1 day 00:00:00');
    } while ($minuteLoop > 0);

    return $minuteTotal;
}

function getTimeLastResponse()
{
    //  Jam
    $intervalHourResponse = \App\Models\FeedbackTimeDuration::pluck('duration')->first();

    // Menit yang harusnya jadi 0
    $minuteLoop = $intervalHourResponse * 60;

    // Menit yang akan di return
    $minuteTotal = 0;
    $iterate = 0;
    $full_day_minute = 24 * 60;
    $currDate = date_create(date('Y-m-d H:i:s', strtotime('now')));

    do {
        $currDay = $currDate->format('N');
        $isDayOffDate = App\Models\DayOffSetting::where('date', $currDate->format('Y-m-d'))->where('is_active', 1)->exists();

        // Hari itu bukan hari libur dan hari itu bukan hari sabtu dan minggu
        if (!$isDayOffDate && $currDay != 6 && $currDay != 7) {
            /**
             * Bukan hari libur
             */

            /**
             * Hari itu kurang berapa jam menit dan waktu
             */

            $minute_interval = 0;

            if ($iterate == 0) {
                $maxCurrDate = date_create(date("Y-m-d 23:59:59"));
                $hour = date_diff($currDate, $maxCurrDate)->format('%h');
                $minute = date_diff($currDate, $maxCurrDate)->format('%i');
                $minute_interval = ($hour * 60) + $minute;
                if ($minuteLoop > $minute_interval) {
                    $minuteLoop -= $minute_interval;
                    $minuteTotal += $minute_interval;
                } else if ($minuteLoop < $minute_interval) {
                    $minuteTotal += $minuteLoop;
                    $minuteLoop = 0;
                }
            } else if ($iterate > 0) {
                if ($minuteLoop >= $full_day_minute) {
                    $minuteLoop -= $full_day_minute;
                    $minuteTotal += $full_day_minute;
                } else if ($minuteLoop <= $full_day_minute) {
                    $minuteTotal += $minuteLoop;
                    $minuteLoop = 0;
                }
            }
        } else {
            if ($iterate == 0) {
                $maxCurrDate = date_create(date("Y-m-d 23:59:59"));
                $hour = date_diff($currDate, $maxCurrDate)->format('%h');
                $minute = date_diff($currDate, $maxCurrDate)->format('%i');
                $minute_interval = ($hour * 60) + $minute;

                $minuteTotal += $minute_interval;
            } else if ($iterate > 0) {
                $minuteTotal += $full_day_minute;
            }
        }

        $iterate++;
        $currDate = $currDate->modify('+1 day 00:00:00');
    } while ($minuteLoop > 0);

    return Carbon::now()->addMinutes($minuteTotal)->isoFormat('Y-MM-D HH:mm:ss');
}
