<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendDailyReportsMail;
use Illuminate\Support\Facades\Mail;
class SendDailyReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:daily-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $files = [
            route('export.users.daily-report'),
            route('export.posts.daily-report'),
        ];
        Mail::to('employee@demofinf.net')->send(new SendDailyReportsMail($files));
    }
}
