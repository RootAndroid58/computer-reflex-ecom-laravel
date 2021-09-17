<?php

namespace App\Console\Commands;


use MimeMailParser\Parser;
use App\Models\SupportTicket;
use Illuminate\Console\Command;

use App\Models\SupportTicketMsg;
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
        
        $pattern = '/#[TRtr]+0*[1-9][0-9]*/';
        preg_match($pattern, $subject, $output);
        $ticket_id = substr($output[0], 1);
        // $SupportTicket = SupportTicket::where('id', $output[0])->first();


        $ticket = SupportTicket::where('id', $ticket_id)->first();
        if (isset($ticket) && $ticket->user->email == $fromEmail) {
            
            $content = $html;
            $dom = new \DomDocument();
            $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('img');
    
            foreach($imageFile as $item => $image) {
                $data = $image->getAttribute('src');
                $extension = explode('/', explode(':', substr($data, 0, strpos($data, ';')))[1])[1];   // 
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $imgeData = base64_decode($data);
                $image_name= Str::random(4). time().$item.'.'.$extension;
                $path = public_path() . '/storage/attachments/' . $image_name;
                file_put_contents($path, $imgeData);
                $image->removeAttribute('src');
                $image->setAttribute('src', asset('storage/attachments/'.$image_name));
            }
    
            $description = $dom->saveHTML();

            SupportTicket::where('id', $ticket_id)->update([
                'status' => 'open',
            ]);

            $SupportTicketMsg = new SupportTicketMsg; 
            $SupportTicketMsg->ticket_id = $ticket_id; 
            $SupportTicketMsg->user_id = $ticket->user->id;   
            $SupportTicketMsg->type = 'user';   
            $SupportTicketMsg->msg = $description;   
            $SupportTicketMsg->attachments = serialize([]);   
            $SupportTicketMsg->save();

        }


        return 0;
    }
}
