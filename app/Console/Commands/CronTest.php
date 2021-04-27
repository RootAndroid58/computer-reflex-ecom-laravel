<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;


class CronTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CronTest';

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
        Mail::raw('This is a simple text string', function ($m) {
            $m->to('toemail@abc.com')->subject('Email Subject');
          });

        return 0;
    }
}
