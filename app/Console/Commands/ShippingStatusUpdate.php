<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminated\Console\WithoutOverlapping;

use Seshac\Shiprocket\Shiprocket;
use App\Models\OrderItem;
use App\Models\Order;
use App\Mail\ItemShippedMail;
use App\Http\Controllers\Admin\ManageOrdersController;
use Mail;

class ShippingStatusUpdate extends Command
{
    use WithoutOverlapping;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ShippingStatusUpdate';

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
        $OrderItems = OrderItem::with('shipment')->with('order.User')->where('status', 'shipment_created')
        ->whereHas('shipment', function($q) {
            $q->where('courier_name', 'Shiprocket')
            ->whereNotNull('shipment_id');
        })->get();

        foreach ($OrderItems as $OrderItem) {
            $token =  Shiprocket::getToken();
            $track = Shiprocket::track($token)->throwShipmentId($OrderItem->shipment->shipment_id);
            
            if (isset($track['tracking_data']['shipment_status']) && $track['tracking_data']['shipment_status'] == 6) {
                OrderItem::where('id', $OrderItem->id)->update([
                    'status' => 'item_shipped',
                ]);

                $a = OrderItem::where('order_id', $OrderItem->order_id)->get();
                $b = OrderItem::where('order_id', $OrderItem->order_id)->where('status', 'item_shipped')->get();
                    
                if ($a->count() == $b->count()) {
                    Order::where('id', $OrderItem->order_id)->update([
                        'status' => 'order_shipped',
                    ]);

                    $order = Order::where('id', $OrderItem->order_id)->with('PendingCancelRequest')->first();

                    OrderCancelRequest::where('id', $order->PendingCancelRequest->id)->update([
                        'status' => 'rejected',
                        'reason' => 'Order already shipped, we will try our best to cancel the order. If the delivery person attempt to deliver the parcel, please do not accept it, Thanks :)',
                    ]);
                }
                
                // Send Notification To User That Ordered Item Shipped
                $data = [
                    'OrderItem' => $OrderItem,
                ];

                Mail::to($OrderItem->order->User->email)->send(new ItemShippedMail($data));
            } 
            
        
            
        }

        return 0;
    }
}
