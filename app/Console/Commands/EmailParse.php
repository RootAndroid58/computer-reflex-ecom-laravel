<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;

class EmailParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'EmailParse';

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

        $parser = new Parser();
        $parser->setText($rawEmail);
        
        $to = $parser->getHeader('to');
        $delivered_to = $parser->getHeader('delivered-to');
        $from = $parser->getHeader('from');
        $subject = $parser->getHeader('subject');
        $text = $parser->getMessageBody('text');
        $html = $parser->getMessageBody('html');
        $attachments = $parser->getAttachments();

        $data = $to.'<br><br><br>'.$delivered_to.'<br><br><br>'.'<br><br><br>'.$from.'<br><br><br>'.$subject.'<br><br><br>'.$text.'<br><br><br>'.$html.'<br><br><br>'.$attachments;

        Mail::raw($data , function ($m) {
            $m->to('aniket.das.in@gmail.com')->subject('Raw Email');
        });

        return 0;
    }
}
