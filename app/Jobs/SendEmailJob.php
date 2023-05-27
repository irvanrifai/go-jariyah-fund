<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\WbsWelcomeSender;
use App\Models\WbsTopic;
use Illuminate\Support\Facades\DB;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $email;
    protected $class;
    protected $message;
    protected $set_status;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $class, $message, $set_status = null)
    {
        $this->email = $email;
        $this->class = $class;
        $this->message = $message;
        $this->set_status = $set_status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Change Status Automatically
        if(!is_null($this->set_status)){
            $post = WbsTopic::where('id', '=', $this->set_status['id'])->first();
            $post->status = $this->set_status['status'];
            $post->save();
        }

        // Send Email Automatically
        Mail::to($this->email)->send(new $this->class($this->message));
    }
}
