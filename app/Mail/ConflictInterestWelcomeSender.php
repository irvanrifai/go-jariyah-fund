<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConflictInterestWelcomeSender extends Mailable
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
        return $this->subject('Laporan Benturan Kepentingan Anda '.$this->welcome['reference_number'].' Diterima - Deputi Bidang Kewirausahaan')->markdown('emails.conflict-interest-new-sender', [
            'sender_name' => $this->welcome['sender_name'],
            'reference_number' => $this->welcome['reference_number'],
            'hour' => $this->welcome['hour'],
            'date' => $this->welcome['date'],
            'title' => 'Laporan Pengaduan Benturan Kepentingan'
        ]);
    }
}
