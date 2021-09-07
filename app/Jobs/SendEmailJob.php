<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;
use App\Mail\SupportTicketRaisedMail;
use App\Mail\AffiliateComissionCreditedMail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $type;
    protected $to;
    protected $data;

    public function __construct($type, $to, $data)
    {
        $this->type = $type;
        $this->to = $to;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $to = $this->to;
        
        if ($this->type == 'order_placed_email') {
            Mail::to($to)
            ->send(new OrderPlacedMail($this->data)); 
        }

        if ($this->type == 'affiliate_comission_credited') {
            Mail::to($to)
            ->send(new AffiliateComissionCreditedMail($this->data));
        }
        
        if ($this->type == 'support_ticket_raised_mail') {
            Mail::to($to)
            ->send(new SupportTicketRaisedMail($this->data));
        }
        
    }
}
