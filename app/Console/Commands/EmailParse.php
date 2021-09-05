<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmailParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:EmailParse';

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
            // read from stdin
            $fd = fopen("php://stdin", "r");
            $rawEmail = "";
            while (!feof($fd)) {
                $rawEmail .= fread($fd, 1024);
            }
            fclose($fd);

            Mail::raw($rawEmail, function ($m) {
                $m->to('aniket.das.in@gmail.com')->subject('Raw Email');
              });

        return 0;
    }
}
