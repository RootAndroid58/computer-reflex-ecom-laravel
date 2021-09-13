<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminated\Console\WithoutOverlapping;

use App\Models\AffiliateOrderItem;
use App\Models\AffiliateWalletTxn;
use App\Jobs\SendEmailJob;
use App\Models\User;
use DateTime;
use Mail;

class CreditAffiliateComission extends Command
{
    use WithoutOverlapping;
    
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
        $AffiliateOrderItems = AffiliateOrderItem::with('OrderItem')
        ->where('status', 'pending')
        ->get();


        foreach ($AffiliateOrderItems as $key => $AffiliateOrderItem) {
            $OrderItem = $AffiliateOrderItem->OrderItem;
            
            if (isset($OrderItem->delivered_on)) {
                
                $today = new DateTime();
                $delivery_date = new DateTime($OrderItem->delivered_on);
                $return_date = new DateTime($OrderItem->delivered_on); $return_date->modify( '+10 days' );


                if ($today > $return_date) {

                    if ($OrderItem->status == 'item_delivered') {
                        $status = 'comission_credited';

                        // Mark as comission_credited
                        AffiliateOrderItem::where('id', $AffiliateOrderItem->id)->update([
                            'status' => 'comission_credited',
                        ]);

                        // Get info of the last Txn of Associate's wallet
                        $wallet = AffiliateWalletTxn::where('user_id', $AffiliateOrderItem->associate_id)->orderBy('id', 'desc')->first();
                    
                        // Credit the comission to Associate's Wallet
                        $walletTxn = new AffiliateWalletTxn;
                        $walletTxn->user_id     = $AffiliateOrderItem->associate_id;
                        $walletTxn->type        = 'credit';
                        $walletTxn->txn_amount  = $AffiliateOrderItem->comission;
                        $walletTxn->description = 'Comission for Affiliate Purchase #'.$AffiliateOrderItem->id;
                        
                        if (isset($wallet)) {
                            $walletTxn->ob      = $wallet->cb;
                            $walletTxn->cb      = $wallet->cb + $AffiliateOrderItem->comission;
                        } 
                        else {
                            $walletTxn->ob      = 0;
                            $walletTxn->cb      = $AffiliateOrderItem->comission;
                        }
                        
                        $walletTxn->save();

                        $user = User::where('id', $walletTxn->user_id)->first();
                            
                        // Send a notification mail to the associate with the Txn info
                        $data = [
                           'user'       => $user,
                           'orderItem'  => $AffiliateOrderItem->OrderItem,
                           'walletTxn'  => $walletTxn,
                        ];

                        //Send the Affiliate Comission Credited Mail To The User (Queue)
                        dispatch(new SendEmailJob('affiliate_comission_credited', $user->email, $data));
                    
                    } 
                    else {
                        // Mark as comission_credited
                        AffiliateOrderItem::where('id', $AffiliateOrderItem->id)->update([
                            'status' => 'not_eligible',
                        ]);
                    }


                }


            }
            
        }


        
        return 0;
    }
        
}
