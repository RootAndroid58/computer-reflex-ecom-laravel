<?php

namespace App\Console\Commands;


use MimeMailParser\Parser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

use ZBateson\MailMimeParser\Message;
use ZBateson\MailMimeParser\MailMimeParser;
use ZBateson\MailMimeParser\Header\HeaderConsts;

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
        $mailParser = new MailMimeParser();
        $message = $mailParser->parse(fopen("php://stdin", "r"), true);
        $subject = $message->getHeaderValue('Subject');
        $text = $message->getTextContent();
        $html = $message->getHtmlContent();
        $from = $message->getHeader('From');
        $fromName = $from->getName();
        $fromEmail = $from->getEmail();
        $to = $message->getHeader('To');
        $firstToName = $to->getName();
        $firstToEmail = $to->getEmail();
        
        // $pattern = '/#[TRtr]+0*[1-9][0-9]*/';
        // $str = 'The quick brown fox jumps over the lazy dog #TR0123456789  - Computer Reflex';
        // preg_match($pattern, $str, $output);

        // dd($output[0]);

        Mail::raw($subject.'<br><br>'.$text.'<br><br>'.$html , function ($m) {
            $m->to('aniket.das.in@gmail.com')->subject('Raw Email');
        });

        return 0;
    }
}
