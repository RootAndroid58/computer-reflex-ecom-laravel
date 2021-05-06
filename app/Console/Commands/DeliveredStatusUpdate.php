<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeliveredStatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:DeliveredStatusUpdate';

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

        $OrderItems = OrderItem::with('shipment')->where('status', 'item_shipped')->whereHas('shipment', function($q) {
            $q->where('courier_name', 'Shiprocket')
            ->whereNotNull('shipment_id');
        })->get();

        foreach ($OrderItems as $OrderItem) {
            $token =  Shiprocket::getToken();
            $track = Shiprocket::track($token)->throwShipmentId($OrderItem->shipment->shipment_id);
            
            if ($track['tracking_data']['track_status'] == 7) {
                OrderItem::where('id', $OrderItem->id)->update([
                    'status' => 'item_delivered',
                ]);
            }

            $a = OrderItem::where('order_id', $OrderItem->order_id)->get();
            $b = OrderItem::where('order_id', $OrderItem->order_id)->where('status', 'item_delivered')->get();
                
            if ($a->count() == $b->count()) {
                Order::where('id', $OrderItem->order_id)->update([
                    'status' => 'order_delivered',
                ]);
            }

            // Send Notification To User That Ordered Item Delivered
            
        }

        return 0;
    }
}
