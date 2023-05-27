<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Date;

class WbsNewTopicRecipient extends Mailable
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
        return $this->subject('Laporan Baru '.$this->welcome['reference_number'].' Diterima - Deputi Bidang Kewirausahaan')->markdown('emails.wbs-new-topic', [
            'recipient_name' => $this->welcome['recipient_name'],
            'recipient_url' => $this->welcome['recipient_url'],
            'date' => $this->welcome['date'],
            'hour' => $this->welcome['hour'],
            'reference_number' => $this->welcome['reference_number'],
            'title' => 'Laporan Layanan SI PINTAR',
            'hour_max' => $this->welcome['hour_max']
        ]);
    }
}
