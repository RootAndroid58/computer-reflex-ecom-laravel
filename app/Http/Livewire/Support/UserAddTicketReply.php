<?php

namespace App\Http\Livewire\Support;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SupportTicket;
use App\Models\SupportTicketMsg;
use App\Jobs\SendEmailJob;
use Str;
use Storage;

class UserAddTicketReply extends Component
{
    use WithFileUploads;

    public $ticket;
    public $attachments=[];
    public $attachments_input=[];
    public $description;

    protected function rules()
    {
        return [
            'description'   => 'required',
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
            if (base64_encode(base64_decode($data, true)) === $data) {
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

        $SupportTicketMsg = new SupportTicketMsg; 
        $SupportTicketMsg->ticket_id = $this->ticket->id; 
        $SupportTicketMsg->user_id = Auth()->user()->id;   
        $SupportTicketMsg->type = 'user';   
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

        return redirect(route('support.show-ticket', $this->ticket->id));

    }


    public function render()
    {
        return view('livewire.support.user-add-ticket-reply');
    }
}
