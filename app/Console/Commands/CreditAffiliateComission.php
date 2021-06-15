<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OrderItem;
use App\Models\AffiliateOrderItem;
use App\Models\AffiliateWalletTxn;
use App\Models\User;
use App\Mail\AffiliateComissionCreditedMail;
use Mail;

class CreditAffiliateComission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CreditAffiliateComission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and credit all comissions for Affiliate Purchases';

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
        $orderItems = OrderItem::with('OrderItemLicenses')->with('shipment')->with('order')->whereHas('AffiliateOrderItem', function($q){
            $q->where('status', 'pending');
        })
        ->where('status', 'item_delivered')
        ->get();

        if ($orderItems->count() > 0) {
            foreach ($orderItems as $key => $orderItem) {

                // Check if the Purchase is affiliated
                if (isset($orderItem->AffiliateOrderItem)) {

                    if ($orderItem->AffiliateOrderItem->status == 'pending') {

                        if ($orderItem->order->delivery_type == 'physical') {
                            $deliveryDate = new \DateTime($orderItem->shipment->delivery_date);
                            $returnDate = $deliveryDate->modify('+20 days');
                        } 
                        else if ($orderItem->order->delivery_type == 'electronic') {
                            $deliveryDate = new \DateTime($orderItem->OrderItemLicenses[0]->delivery_date);
                            $returnDate = $deliveryDate;
                        }
                        
                        $today = new \DateTime();
                        
                        // Process if return date is over for the Affiliate Purchase
                        if ($today > $returnDate) {

                            // Mark the Affiliate Purchase as comission credited
                            AffiliateOrderItem::where('order_item_id', $orderItem->id)->update([
                                'status' => 'comission_credited',
                            ]);

                            // Get info of the last Txn of Associate's wallet
                            $wallet = AffiliateWalletTxn::where('user_id', $orderItem->AffiliateOrderItem->associate_id)->orderBy('id', 'desc')->first();

                            // Credit the comission to Associate's Wallet
                            $walletTxn = new AffiliateWalletTxn;
                            $walletTxn->user_id     = $orderItem->AffiliateOrderItem->associate_id;
                            $walletTxn->type        = 'credit';
                            $walletTxn->txn_amount  = $orderItem->AffiliateOrderItem->comission;
                            $walletTxn->description = 'Comission for Affiliate Purchase #'.$orderItem->AffiliateOrderItem->id;
                            
                            if (isset($wallet)) {
                                $walletTxn->ob      = $wallet->cb;
                                $walletTxn->cb      = $wallet->cb + $orderItem->AffiliateOrderItem->comission;
                            } else {
                                $walletTxn->ob      = 0;
                                $walletTxn->cb      = 0 + $orderItem->AffiliateOrderItem->comission;
                            }
                            
                            $walletTxn->save();

                            $user = User::where('id', $walletTxn->user_id)->first();
                            
                            // Send a notification mail to the associate with the Txn info
                            $data = [
                               'user'       => $user,
                               'orderItem'  => $orderItem,
                               'walletTxn'  => $walletTxn,
                            ];

                            Mail::to($user->email)->send(new AffiliateComissionCreditedMail($data));
                        } 

                    }
                }
            }
        }

        return 0;
    }
        
}
