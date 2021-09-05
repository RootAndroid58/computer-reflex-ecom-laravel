<?php

namespace App\Http\Livewire\Support;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Order;
use App\Models\SupportTicket;
use App\Models\SupportTicketMsg;
use Str;
use Storage;

class RaiseTicket extends Component
{
    use WithFileUploads;

    public $user_id;
    public $help_topic="General Query";
    public $order_id;
    public $description;
    public $orders=[];
    public $attachments=[];

    public function mount()
    {
        $this->user_id = Auth()->user()->id;
        $this->orders = Order::where('user_id', $this->user_id)->take(10)->get();
    }

    protected function rules()
    {
        return [
            'help_topic'    => 'required',
            'description'   => 'required',
            'order_id'      => 'required_if:help_topic,Order Related,Return/Refund',
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function submit()
    {
        $this->validate();
       
        if ($this->help_topic == 'Order Related' || $this->help_topic == 'Return/Refund') {
            $order = Order::where('id', $this->order_id)->where('user_id', Auth()->user()->id)->first();

            if ($this->help_topic == 'Order Related') {
                $subject = 'Order#'.$this->order_id.' Related';
            }
            else if ($this->help_topic == 'Return/Refund') {
                $subject = 'Return/Refund Related - Order#'.$this->order_id;
            }
        }



        $content = $this->description;
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
        // dd($description);
        $SupportTicket = new SupportTicket;
        $SupportTicket->user_id = $this->user_id;
        $SupportTicket->status = 'open';
        $SupportTicket->subject = $subject ?? $this->help_topic;
        $SupportTicket->save();

        $SupportTicketMsg = new SupportTicketMsg; 
        $SupportTicketMsg->ticket_id = $SupportTicket->id; 
        $SupportTicketMsg->user_id = $this->user_id;   
        $SupportTicketMsg->type = 'user';   
        $SupportTicketMsg->msg = $description ;   
        $SupportTicketMsg->save();

        $attachments=[];

        foreach ($this->attachments as $key => $attachment) {
            $attachment->store('attachments', 'public');
            $attachments[] = $attachment->hashName();
        }

        $attachments = serialize($attachments);

        SupportTicketMsg::where('id', $SupportTicketMsg->id)->update([
            'attachments' => $attachments,
        ]);

        $ticket = SupportTicket::with('user')->where('id', $SupportTicket->id)->first();

        // Send Ticket Raised Confirmation Mail To The User
        $data = [
            'ticket' => $ticket,
        ];

        // Mail::to($ticket->user->email)->send(new SupportTicketRaisedMail($data));

        session()->flash('ticket_raised', $SupportTicket->id);
        return redirect(route('support.show-ticket', $SupportTicket->id));

    }

    public function render()
    {
        return view('livewire.support.raise-ticket');
    }
}
