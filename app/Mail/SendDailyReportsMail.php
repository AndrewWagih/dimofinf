<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendDailyReportsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $files;

    /**
     * Create a new message instance.
     *
     * @param  array  $files
     * @return void
     */
    public function __construct($files)
    {
        $this->files = $files;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Daily Report';

        return $this->subject($subject)
            ->view('emails.daily-reports');
    }
}
