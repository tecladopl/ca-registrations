<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing email configuration';

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
        $email = $this->argument('email');
        $this->info('Address is: ' . $email);
        Mail::send('email.test', ['email' => $email], function ($message) use ($email) {
            $message->to($email)->subject("Configuration test");
        });
        $this->info('The command was successful!');
    }
}
