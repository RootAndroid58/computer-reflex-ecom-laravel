<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminated\Console\WithoutOverlapping;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductLicense;
use App\Models\OrderItemLicense;
use App\Mail\ItemDeliveredMail;

use Mail;

class SendProductLicenseKeys extends Command
{
    use WithoutOverlapping;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SendProductLicenseKeys';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Product License Keys';

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
        $OrderItems = OrderItem::with('order.User')->where('status', 'order_placed')->whereHas('order', function ($q){
            $q->where('delivery_type', 'electronic');
        })->get();
        
        foreach ($OrderItems as $key => $OrderItem) {
            
            $OrderItemLicenses = OrderItemLicense::where('order_item_id', $OrderItem->id)->get();

            if ($OrderItemLicenses->count() == 0) {

                $ProductLicenses = ProductLicense::where('product_id', $OrderItem->product_id)
                ->where('status', 'unused')
                ->take($OrderItem->qty)
                ->get();
                
                if ($ProductLicenses->count() == $OrderItem->qty) {

                    ProductLicense::whereIn('id', $ProductLicenses->pluck('id'))->update([
                        'status' => 'used',
                    ]);

                    OrderItem::where('id', $OrderItem->id)->update([
                        'status' => 'item_delivered',
                    ]);
    
                    $i = 0;
                    
                    while ($OrderItem->qty > $i) {

                        OrderItemLicense::create([
                            'order_item_id'         => $OrderItem->id,
                            'product_license_id'    => $ProductLicenses[$i]->id,
                            'delivery_date'         => new \DateTime(),
                        ]);
    
                        
    
                        $i++;
                    }
    
                    $data = [
                        'OrderItem' => $OrderItem,
                    ];
                    
                    Mail::to($OrderItem->order->User->email)->send(new ItemDeliveredMail($data));
                }
            }   

            $a = OrderItem::where('order_id', $OrderItem->order->id)->get();
            $b = OrderItem::where('order_id', $OrderItem->order->id)->where('status', 'item_delivered')->get();
                
            if ($a->count() == $b->count()) {
                Order::where('id', $OrderItem->order->id)->update([
                    'status' => 'order_delivered',
                ]);
                // admin-delivery-confirmation
            } 
        }

        return 0;
    }
}
