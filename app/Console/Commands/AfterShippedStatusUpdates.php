<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Seshac\Shiprocket\Shiprocket;
use App\Models\OrderItem;
use App\Models\Order;
use App\Mail\ItemDeliveredMail;
use Mail;

class AfterShippedStatusUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:AfterShippedStatusUpdates';

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
        $OrderItems = OrderItem::with('shipment')->with('order.User')->with('product.images')->where('status', 'item_shipped')->orWhere('status', 'rto_initiated')->whereHas('shipment', function($q) {
            $q->where('courier_name', 'Shiprocket')
            ->whereNotNull('shipment_id');
        })->get();

        foreach ($OrderItems as $OrderItem) {
            $track = Shiprocket::track(Shiprocket::getToken())->throwShipmentId($OrderItem->shipment->shipment_id);

            // if status is Shiprocket status is Cancelled 
            if (isset($track['tracking_data']['shipment_status']) && $track['tracking_data']['shipment_status'] == 8) {
                OrderItem::where('id', $OrderItem->id)->update([
                    'status' => 'order_cancelled',
                ]);
                $a = OrderItem::where('order_id', $OrderItem->order_id)->get();
                $b = OrderItem::where('order_id', $OrderItem->order_id)->where('status', 'order_cancelled')->get();
                    
                if ($a->count() == $b->count()) {
                    Order::where('id', $OrderItem->order_id)->update([
                        'status' => 'order_cancelled',
                    ]);
                }
            }

            // if status is Shiprocket status is RTO Initiated 
            if (isset($track['tracking_data']['shipment_status']) && $track['tracking_data']['shipment_status'] == 9) {
                OrderItem::where('id', $OrderItem->id)->update([
                    'status' => 'rto_initiated',
                ]);
            }

            // if status is Shiprocket status is RTO Delivered 
            if (isset($track['tracking_data']['shipment_status']) && $track['tracking_data']['shipment_status'] == 10) {
                OrderItem::where('id', $OrderItem->id)->update([
                    'status' => 'order_cancelled',
                ]);
                $a = OrderItem::where('order_id', $OrderItem->order_id)->get();
                $b = OrderItem::where('order_id', $OrderItem->order_id)->where('status', 'order_cancelled')->get();
                    
                if ($a->count() == $b->count()) {
                    Order::where('id', $OrderItem->order_id)->update([
                        'status' => 'order_cancelled',
                    ]);
                }
            }

        }



        return 0;
    }
}
