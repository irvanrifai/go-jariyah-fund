<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GratifikasiNewReplySender extends Mailable
{
    use Queueable, SerializesModels;
    protected $welcome;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($welcome)
    {
        $this->welcome = $welcome;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->welcome['is_show_message']) {
            return $this->subject('Laporan Gratifikasi Anda ' . $this->welcome['reference_number'] . ' Telah Diproses - Deputi Bidang Kewirausahaan')
                ->markdown('emails.gratifikasi-new-reply-sender', [
                    'sender_name' => $this->welcome['sender_name'],
                    'reference_number' => $this->welcome['reference_number'],
                    'date' => $this->welcome['date'],
                    'hour' => $this->welcome['hour'],
                    'status' => $this->welcome['status'],
                    'is_show_message' => $this->welcome['is_show_message'],
                    'title' => 'Laporan Pengaduan Gratifikasi'
                ]);
        } else {
            $message = $this->subject('Laporan Gratifikasi Anda ' . $this->welcome['reference_number'] . ' Telah Diproses - Deputi Bidang Kewirausahaan')
                ->markdown('emails.gratifikasi-new-reply-sender', [
                    'sender_name' => $this->welcome['sender_name'],
                    'reference_number' => $this->welcome['reference_number'],
                    'date' => $this->welcome['date'],
                    'hour' => $this->welcome['hour'],
                    'status' => $this->welcome['status'],
                    'is_show_message' => $this->welcome['is_show_message'],
                    'title' => 'Laporan Pengaduan Gratifikasi'
                ]);

            if($this->welcome['file'] != ''){
                $message->attach(public_path() .'/storage'. '/' . $this->welcome['file']);
            }
            $message->attach(public_path() .'/storage'.'/'. $this->welcome['file_report']);

            return $message;
        }
    }
}
