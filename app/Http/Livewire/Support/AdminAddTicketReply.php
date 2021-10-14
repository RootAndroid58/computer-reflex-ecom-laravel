<?php

namespace App\Http\Livewire\Support;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SupportTicket;
use App\Models\SupportTicketMsg;
use App\Jobs\SendEmailJob;
use App\Mail\AdminSupportTicketReplyMail;
use Str;
use Storage;
use Mail;

class AdminAddTicketReply extends Component
{
    use WithFileUploads;
    public $ticket;
    public $reply_as='staff';
    public $attachments=[];
    public $attachments_input=[];
    public $description;

    protected function rules()
    {
        return [
            'description'   => 'required',
            'reply_as'      => 'in:staff,user',
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);

        if ($field == 'attachments_input') {
            $this->addAttachments();
        }
    }

     
    public function addAttachments()
    {
        $this->attachments = array_merge($this->attachments, $this->attachments_input);
        $this->attachments_input=[];
    }

    public function removeAttachment($i)
    {
        unset($this->attachments[$i]);
    }

    public function submit()
    {
        $this->validate();

        $content = $this->description;
        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');
  
        foreach($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if (explode(':', substr($data, 0, strpos($data, ';')))[1] ?? false) {
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
        }
  
        $description = $dom->saveHTML();

        SupportTicket::where('id', $this->ticket->id)->update([
            'status' => 'open',
        ]);

        $header = '<p>Hi <b>'.$this->ticket->user->name.'</b>,<br><br>This message is regarding the <b>Ticket #'.$this->ticket->id.' </b>raised by you.&nbsp;</p>';
        $body = $description;
        $footer = '<br><p><b >Best Regards,</b><br></p><p><span ><span style="font-family: Arial;">'.Auth()->user()->name.'</span><br></span><span >Computer Reflex Support Team<br></span><a href="tel:+917003373754" target="_blank" style="background-color: rgb(255, 255, 255); ">+91 7003 373 754</a><span >&nbsp;| </span><a href="mailto:contact@computerreflex.tk" target="_blank" style="background-color: rgb(255, 255, 255); ">contact@computerreflex.tk</a></p>';
        
        if ($this->reply_as == 'staff') {
            $description = $header.$description.$footer;
        }

        $SupportTicketMsg = new SupportTicketMsg; 
        $SupportTicketMsg->ticket_id = $this->ticket->id; 
        if ($this->reply_as == 'staff') {
            $SupportTicketMsg->user_id = Auth()->user()->id;  
        } else if ($this->reply_as == 'user') {
            $SupportTicketMsg->user_id = $this->ticket->user_id;  
        }
        $SupportTicketMsg->type = $this->reply_as;   
        $SupportTicketMsg->msg = $description;   
        $SupportTicketMsg->attachments = serialize([]);   
        $SupportTicketMsg->save();

        $attachments=[];

        foreach ($this->attachments as $key => $attachment) {
            $storedFileName = $this->ticket->id.'-'.md5_file($attachment->getRealPath()).'.'.$attachment->getClientOriginalExtension();
            $attachment->storeAs('attachments', $storedFileName, 'public');
            $attachments[] = json_decode(json_encode([
                'name'          => $attachment->getClientOriginalName(),
                'attachment'    =>  $storedFileName
            ]));
        }

        $attachments = serialize($attachments);

        SupportTicketMsg::where('id', $SupportTicketMsg->id)->update([
            'attachments' => $attachments,
        ]);       

        $data = [
            'ticket'    => $this->ticket, 
            'header'    => $header,
            'body'      => $body,
            'footer'    => $footer,
        ];

        if ($this->reply_as == 'staff') {
            Mail::to($this->ticket->user->email)->queue(new AdminSupportTicketReplyMail($data));
        }

        return redirect(route('admin-manage-support-ticket', $this->ticket->id));

    }

    public function render()
    {
        return view('livewire.support.admin-add-ticket-reply');
    }
}
