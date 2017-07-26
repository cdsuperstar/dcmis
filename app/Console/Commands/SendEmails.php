<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emailthelog:send {tech_email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send log e-mails to a email';

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
     * @return mixed
     */
    public function handle()
    {
        //
        Mail::send('logmail', ['name' => "DC system"], function($m){
            $m->from('181977814@qq.com');
            $m->to($this->argument('tech_email'), 'Tech')->subject('Log of DC System');
        });
    }
}
