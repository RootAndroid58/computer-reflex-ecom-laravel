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
        ob_start(); 
        phpinfo(); 
        $phpinfo = ob_get_clean();

        Mail::raw($phpinfo, function ($m) {
            $m->to('aniket.das.in@gmail.com')->subject('Cron Test');
          });

        return 0;
    }
}
