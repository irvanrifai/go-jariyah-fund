<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Date;

class WbsNewReplyRecipient extends Mailable
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
        return $this->subject('Laporan '.$this->welcome['reference_number'].' Telah Dibalas - Deputi Bidang Kewirausahaan')->markdown('emails.wbs-new-feedback-recipient', [
            'recipient_name' => $this->welcome['recipient_name'],
            'recipient_url' => $this->welcome['recipient_url'],
            'reference_number' => $this->welcome['reference_number'],
            'date' => $this->welcome['date'],
            'hour' => $this->welcome['hour'],
            'status' => $this->welcome['status'],
            'title' => 'Laporan Layanan SI PINTAR'
        ]);
    }
}
