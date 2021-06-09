<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\AffiliateOrderItem;
use App\Models\OrderItem;
use App\Models\AffiliateWalletTxn;
use App\Models\SupportTicket;
use App\Models\Catalog;
use App\Models\Voucher;
use DateTime;

class AjaxDataTable extends Controller
{


    public function AdminFeaturedCatalogsTable(Request $req)
    {
        if (Request()->ajax()) {

            $query = Catalog::with('CatalogProducts')->latest()->get();

            return datatables()->of($query)
            
            ->addColumn('catalog_id', function($data){

                $catalog_id = $data->id;

                return $catalog_id;
            })
            ->addColumn('slug', function($data){

                $slug = $data->slug;

                return $slug;
            })
            ->addColumn('total_products', function($data){

                $total_products = $data->CatalogProducts->count();

                return $total_products;
            })
            ->addColumn('action', function($data){

                $action = '
                        <a target="_blank" href="'.route('show-catalog', $data->slug).'" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        <a target="_blank" href="'.route('admin-edit-catalog', $data->id).'" class="btn btn-dark"><i class="fas fa-cog"></i></a>
                ';

                return $action;
            })

            ->rawColumns(['action', 'total_products', 'slug', 'catalog_id'])->make(true);

        } else 
        { 
            return redirect()->route('home'); 
        }

    }


    public function AdminSupportTicketsTable(Request $req)
    {
        if (Request()->ajax()) {

            if ($req->search_status == 'resolved') {
                $query = SupportTicket::with('msgs.user')->where('status', 'resolved')->orderBy('id', 'desc')->latest()->get();
            } 
            else if ($req->search_status == 'open') {
                $query = SupportTicket::with('msgs.user')->where('status', 'open')->orderBy('id', 'desc')->latest()->get();
            } 
            else {
                $query = SupportTicket::with('msgs.user')->orderBy('id', 'desc')->latest()->get();
            }

            return datatables()->of($query)
            
            ->addColumn('ticket_id', function($data){

                $ticket_id = '<a class=" cursor-pointer static-blue" href="'.route('admin-manage-support-ticket', $data->id).'">  #'.$data->id.'</a>';

                return $ticket_id;
            })
            ->addColumn('subject', function($data){

                $subject = '<a class=" cursor-pointer static-blue" href="'.route('admin-manage-support-ticket', $data->id).'">'.$data->subject.'</a>';;
                
                return $subject;
            })
            ->addColumn('status', function($data){
                if ($data->status == 'open') {
                    $status = '<a href="'.route('admin-manage-support-ticket', $data->id).'" class="btn btn-sm btn-info">Open</a>';
                } elseif ($data->status == 'resolved') {
                    $status = '<a href="'.route('admin-manage-support-ticket', $data->id).'" class="btn btn-sm btn-success">Resolved</a>';
                } else {
                    $status = $data->subject;
                }
                
                return $status;

            })
            ->addColumn('last_replier', function($data){

                $last_replier = '<a href="'.route('admin-manage-support-ticket', $data->id).'" class="static-blue">'.$data->msgs[0]->user->name.'</a>';

                if ($data->msgs[0]->type == 'staff') {
                    $last_replier = $last_replier.' <button type="button" class="btn btn-sm btn-success">Staff <i class="fas fa-check"></i></button></button>';
                }
                return $last_replier;
            })
            ->addColumn('created_at', function($data){
                
                $created_at =  '<a href="'.route('admin-manage-support-ticket', $data->id).'" class="static-blue">'.date_format(new DateTime($data->created_at), 'dS M, Y').'</a>';

                return $created_at;
            })

            ->rawColumns(['ticket_id', 'subject', 'status', 'last_replier', 'created_at'])->make(true);

        } else 
        { 
            return redirect()->route('home'); 
        }
    }

    public function SupportTicketsTable(Request $req)
    {
        
        if (Request()->ajax()) {

            return datatables()->of(SupportTicket::with('msgs.user')->where('user_id', Auth()->user()->id)->orderBy('id', 'desc')->latest()->get())
            
            ->addColumn('ticket_id', function($data){

                $ticket_id = '<a class=" cursor-pointer static-blue" href="'.route('support.show-ticket', $data->id).'">  #'.$data->id.'</a>';

                return $ticket_id;
            })
            ->addColumn('subject', function($data){

                $subject = '<a class=" cursor-pointer static-blue" href="'.route('support.show-ticket', $data->id).'">'.$data->subject.'</a>';;
                
                return $subject;
            })
            ->addColumn('status', function($data){

                if ($data->status == 'open') {
                    $status = '<a href="'.route('support.show-ticket', $data->id).'" class="btn btn-sm btn-info">Open</a>';
                } elseif ($data->status == 'resolved') {
                    $status = '<a href="'.route('support.show-ticket', $data->id).'" class="btn btn-sm btn-success">Resolved</a>';
                } else {
                    $status = $data->subject;
                }
                
                return $status;

            })
            ->addColumn('last_replier', function($data){

                $last_replier = '<a href="'.route('support.show-ticket', $data->id).'" class="static-blue">'.$data->msgs[0]->user->name.'</a>';

                if ($data->msgs[0]->type == 'staff') {
                    $last_replier = $last_replier.' <button type="button" class="btn btn-sm btn-success">Staff <i class="fas fa-check"></i></button></button>';
                }
                return $last_replier;
            })
            ->addColumn('created_at', function($data){
                
                $created_at =  '<a href="'.route('support.show-ticket', $data->id).'" class="static-blue">'.date_format(new DateTime($data->created_at), 'dS M, Y').'</a>';

                return $created_at;
            })

            ->rawColumns(['ticket_id', 'subject', 'status', 'last_replier', 'created_at'])->make(true);

        } else 
        { 
            return redirect()->route('home'); 
        }
    }


    public function WalletTxnTable(Request $req)
    {
        if (Request()->ajax()) {

            return datatables()->of(AffiliateWalletTxn::where('user_id', Auth()->user()->id)->orderBy('id', 'desc')->latest()->get())
            
            ->addColumn('txn_id', function($data){

                $txn_id = $data->id;

                return $txn_id;
            })
            ->addColumn('date', function($data){

                $date = $data->created_at;

                return $date;
            })
            ->addColumn('description', function($data){

                $description = $data->description;

                return $description;
            })
            ->addColumn('type', function($data){

                if ($data->type == 'credit') {
                    $type = 'Cr (+)';
                } elseif ($data->type == 'debit') {
                    $type = 'Dr (-)';
                }

                return $type;
            })
            ->addColumn('amount', function($data){

                $amount =  '<font class="rupees">₹</font>'.moneyFormatIndia($data->txn_amount);

                return $amount;
            })
            ->addColumn('cb', function($data){
                
                $cb = '<font class="rupees">₹</font>'.moneyFormatIndia($data->cb);

                return $cb;
            })

            ->rawColumns(['txn_id', 'description', 'type', 'amount', 'cb'])->make(true);

        } else 
        { 
            return redirect()->route('home'); 
        }
    }






    public function AdminDeliveryConfirmationTable(Request $req)
    {
        if (Request()->ajax()) {

            return datatables()->of(OrderItem::with('product')->with('order.User')->where('status', 'item_shipped')->latest()->get())
            
            ->addColumn('order_id', function($data){

                $order_id = $data->order_id;

                return $order_id;
            })
            ->addColumn('order_date', function($data){

                $order_date = $data->order->created_at;

                return $order_date;
            })
            ->addColumn('item_name', function($data){
                
                $item_name = '<span class="line-limit-2">'.$data->product->product_name.'</span>';

                return $item_name;
            })
            ->addColumn('customer_name', function($data){

                $customer_name = $data->order->User->name;

                return $customer_name;
            })
            ->addColumn('registered_mobile', function($data){

                $registered_mobile = $data->order->User->mobile ?? '';

                return $registered_mobile;
            })
            ->addColumn('registered_email', function($data){
                
                $registered_email = '<a href="mailto:'.$data->order->User->email.'" target="_blank">'.$data->order->User->email.'</a>';

                return $registered_email;
            })
            ->addColumn('price', function($data){

                $price = '<span><font class="rupees">₹</font>'.moneyFormatIndia($data->total_price).'</span>' ;
                
                return $price;
            })
            ->addColumn('status', function($data){

                if ($data->status == 'item_shipped') {
                    $status = '<span style="color: #2874f0"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Item Shipped.</span>';
                }
                    
                return $status;
            })
            ->addColumn('payment_method', function($data){

                if ($data->order->payment_method == 'payu') {
                    $payment_method = 'PayU';
                } 
                elseif ($data->order->payment_method == 'paytm') {
                    $payment_method = 'PayTM';
                } 
                elseif ($data->order->payment_method == 'cod') {
                    $payment_method = 'Cash On Delivery';
                }
                elseif ($data->order->payment_method == 'voucher') {
                    $payment_method = 'Voucher';
                }
                    
                return $payment_method;
            })
            ->addColumn('action', function($data){

                $action = '<a href="'.route('admin-item-delivered-confirmation', $data->id).'" class="btn btn-primary">Delivered</a>';
                    
                return $action;
            })

            ->rawColumns(['order_id', 'item_name', 'status', 'price', 'payment_method', 'registered_email', 'action'])->make(true);

        } else 
        { 
            return redirect()->route('home'); 
        }
    }












    function ReferredPurchasesTable(Request $req)
    {
        if (Request()->ajax()) {

            return datatables()->of(AffiliateOrderItem::with('OrderItem.product')
            ->where('associate_id', Auth()->user()->id)
            ->whereHas('OrderItem', function ($query) use ($req) {
                $query->where('status', '!=', 'checkout_pending');
            })      
            ->latest()->get())

            ->addColumn('product', function($data){

                $product = $data->OrderItem->product->product_name;
                
                return $product;
        })
            ->addColumn('price', function($data){

                $price = '<font class="rupees">₹</font>'.moneyFormatIndia($data->OrderItem->total_price);
                
                return $price;
        })
            ->addColumn('comission', function($data){

                $comission = '<font class="rupees">₹</font>'.moneyFormatIndia($data->comission);

                return $comission;
        })
            ->addColumn('purchase_date', function($data){

                $purchase_date = date_format(new DateTime($data->OrderItem->created_at), "dS M, Y");

                return $purchase_date;
        })
            ->addColumn('status', function($data){
                if ($data->status == 'pending') {
                    $status = 'In-Progress';
                } else if ($data->status == 'comission_credited') {
                    $status = 'Comission Credited';
                } else {
                    $status = $data->status;
                }
                
                
                return $status;
        })
            ->rawColumns(['product', 'price', 'comission', 'purchase_date', 'status'])->make(true);

        } else { return redirect()->route('home'); }

        
    }






























    function SliderProductsTable(Request $req)
    {
        if (Request()->ajax()) {

            return datatables()->of(Product::with('images')->where('product_published', 1)->latest()->get())

            ->addColumn('stock', function($data){

                if ($data->product_stock > 0) {
                    $stock = '<i class="fa fa-circle" style="color: #10c469;"></i>&nbsp;'.$data->product_stock;
                    $stock .= '&nbsp;&nbsp;';
                } 
                elseif ($data->product_stock < 1){
                    $stock = '<i class="fa fa-circle" style="color: #F44336;"></i>&nbsp;Unavailable';
                    $stock .= '&nbsp;&nbsp;';
                } else {

                    $stock = 'Unknown';
                }
                
                return $stock;
        })
            ->addColumn('product_mrp_custom', function($data){

                $mrp = moneyFormatIndia($data->product_mrp);
                
                return $mrp;
        })
            ->addColumn('product_price_custom', function($data){

                $price = moneyFormatIndia($data->product_price);

                return $price;
        })
            ->addColumn('product_status', function($data){

                if ($data->product_status == 1) {
                    $status = '<i class="fa fa-circle" style="color: #10c469;"></i>&nbsp;Active';
                    $status .= '&nbsp;&nbsp;';
                } 
                elseif ($data->product_status == 0) {
                    $status = '<i class="fa fa-circle" style="color: #F44336;"></i>&nbsp;Inactive';
                    $status .= '&nbsp;&nbsp;';
                }
                $data->product_status;

                return $status;
        })
            ->addColumn('action', function($data){

                $ProductURL = route('product-index', $data->id);

                $EditURL = route('edit-product',$data->id);
                $image = asset('storage/images/products/'.$data->images[0]->image);
                $button = '<button type="button" class="btn btn-primary" onclick="AddToSlider(\'' . $data->id . '\',\''.$image.'\',\'' . $data->product_name . '\',\'' . moneyFormatIndia($data->product_mrp) . '\')">Add This Product</button>';

                
                return $button;
        })
            ->rawColumns(['action', 'product_mrp_custom', 'product_price_custom', 'stock', 'product_status'])->make(true);

        } else { return redirect()->route('home'); }

        
    }































    public function AdminShipOrdersTable(Request $req)
    {
        if (Request()->ajax()) {

            return datatables()->of(Order::with(['OrderItems', 'User'])->where('status', 'order_placed')->orwhere('status', 'order_packing')->orwhere('status', 'packing_completed')->orwhere('status', 'shipment_created')->latest()->get())
            
            ->addColumn('order_id', function($data){

                $order_id = $data->id;

                return $order_id;
            })
            ->addColumn('order_date', function($data){

                $order_date = $data->created_at;

                return $order_date;
            })
            ->addColumn('customer_name', function($data){

                $customer_name = $data->User->name;

                return $customer_name;
            })
            ->addColumn('registered_mobile', function($data){

                $registered_mobile = $data->User->mobile ?? '';

                return $registered_mobile;
            })
            ->addColumn('registered_email', function($data){

                $registered_email = '<a href="mailto:'.$data->User->email.'" target="_blank">'.$data->User->email.'</a>';

                return $registered_email;
            })
            ->addColumn('price', function($data){

                $price = '<span><font class="rupees">₹</font>'.moneyFormatIndia($data->price).'</span>' ;
                
                return $price;
            })
            ->addColumn('status', function($data){

                if ($data->status == 'order_placed') {
                    $status = '<span style="color: #2874f0"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Order Placed.</span>';
                } 
                elseif ($data->status == 'payment_failed') {
                    $status = '<span style="color: #ff6161"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Payment Declined.</span>';
                } 
                elseif ($data->status == 'checkout_pending') {
                    $status = '<span style="color: #f6c23e"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Checkout Pending.</span>';
                }
                elseif ($data->status == 'order_packing') {
                    $status = '<span style="color: #2874f0"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Packing Started.</span>';
                }
                elseif ($data->status == 'packing_completed') {
                    $status = '<span style="color: #2874f0"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Packing Completed.</span>';
                }
                elseif ($data->status == 'shipment_created') {
                    $status = '<span style="color: #2874f0"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Shipment Created.</span>';
                }
                    
                return $status;
            })
            ->addColumn('payment_method', function($data){

                if ($data->payment_method == 'payu') {
                    $payment_method = 'PayU';
                } 
                elseif ($data->payment_method == 'paytm') {
                    $payment_method = 'PayTM';
                } 
                elseif ($data->payment_method == 'cod') {
                    $payment_method = 'Cash On Delivery';
                }
                elseif ($data->payment_method == 'voucher') {
                    $payment_method = 'Voucher';
                }
                    
                return $payment_method;
            })
            ->addColumn('action', function($data){

                $action = '<a href="'.route('admin-ship-order', $data->id).'" class="btn btn-primary">Ship</a>';
                    
                return $action;
            })

            ->rawColumns(['order_id', 'status', 'price', 'payment_method', 'registered_email', 'action'])->make(true);

        } else 
        { 
            return redirect()->route('home'); 
        }
    }















    public function AdminOrdersTable(Request $req)
    {
        if (Request()->ajax()) {

            return datatables()->of(Order::with(['OrderItems', 'User'])->latest()->get())
            
            ->addColumn('order_id', function($data){

                $order_id = $data->id;

                return $order_id;
            })
            ->addColumn('order_date', function($data){

                $order_date = $data->created_at;

                return $order_date;
            })
            ->addColumn('customer_name', function($data){

                $customer_name = $data->User->name;

                return $customer_name;
            })
            ->addColumn('registered_mobile', function($data){

                $registered_mobile = $data->User->mobile ?? '';

                return $registered_mobile;
            })
            ->addColumn('registered_email', function($data){

                $registered_email = '<a href="mailto:'.$data->User->email.'" target="_blank">'.$data->User->email.'</a>';

                return $registered_email;
            })
            ->addColumn('price', function($data){

                $price = '<span><font class="rupees">₹</font>'.moneyFormatIndia($data->price).'</span>' ;
                
                return $price;
            })
            ->addColumn('status', function($data){

                if ($data->status == 'order_placed') {
                    $status = '<span style="color: #2874f0"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Order Placed.</span>';
                } 
                elseif ($data->status == 'payment_failed') {
                    $status = '<span style="color: #ff6161"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Payment Declined.</span>';
                } 
                elseif ($data->status == 'checkout_pending') {
                    $status = '<span style="color: #f6c23e"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Checkout Pending.</span>';
                } 
                elseif ($data->status == 'order_packing') {
                    $status = '<span style="color: #2874f0"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Packing Started.</span>';
                }
                elseif ($data->status == 'packing_completed') {
                    $status = '<span style="color: #2874f0"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Packing Completed.</span>';
                }
                elseif ($data->status == 'shipment_created') {
                    $status = '<span style="color: #2874f0"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Shipment Created.</span>';
                }
                elseif ($data->status == 'order_shipped') {
                    $status = '<span style="color: #2874f0"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Order Shipped.</span>';
                }
                elseif ($data->status == 'order_delivered') {
                    $status = '<span style="color: #0f6848"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Order Delivered.</span>';
                } 
                elseif ($data->status == 'order_cancelled') {
                    $status = '<span class="text-danger"><span style=""><i class="fa fa-circle" aria-hidden="true"></i></span> Order Cancelled.</span>';
                }
                else {
                    $status = $data->status;
                }
                    
                return $status;
            })
            ->addColumn('payment_method', function($data){

                if ($data->payment_method == 'payu') {
                    $payment_method = 'PayU';
                } 
                elseif ($data->payment_method == 'paytm') {
                    $payment_method = 'PayTM';
                } 
                elseif ($data->payment_method == 'cod') {
                    $payment_method = 'Cash On Delivery';
                }
                elseif ($data->payment_method == 'voucher') {
                    $payment_method = 'Voucher';
                }
                    
                return $payment_method;
            })
            ->addColumn('action', function($data){

                $action = '<a href="'.route('admin-ship-order', $data->id).'" class="btn btn-dark"><i class="fas fa-cog"></i></a>';
                    
                return $action;
            })

            ->rawColumns(['order_id', 'status', 'price', 'payment_method', 'registered_email', 'action'])->make(true);

        } else 
        { 
            return redirect()->route('home'); 
        }
    }






    function AdminVouchersTable(Request $req)
    {
        if (Request()->ajax()) {

            return datatables()->of(Voucher::with('products.product')->latest()->get())

            ->addColumn('voucher_id', function($data){
                
                $voucher_id = $data->id;

                return $voucher_id;
        })
            ->addColumn('voucher_code', function($data){

                $voucher_code = $data->code;
                
                return $voucher_code;
        })
            ->addColumn('products', function($data){
                $products = '';

                foreach ($data->products as $key => $product) {
                    $products .= 
                    '<div class="">
                        <div>
                            <span class="line-limit-2">'.$product->product->product_name.'</span>
                        </div>
                        <div>
                            <span class="line-limit-2"> Qty: '.$product->qty.'</span>
                        </div>
                            <strong>@'.moneyFormatIndia($product->special_price).'</strong>
                    </div>
                    <hr>'
                    ; 
                }

                return $products;
        })
            ->addColumn('status', function($data){

                if ($data->status == 'active') {
                    $status = '<i class="text-success fas fa-circle"></i> Active';
                } else if ($data->status == 'used') {
                    $status = '<i class="text-info fas fa-circle"></i> Used By: '.$data->used_by;
                } else {
                    $status = $data->status;
                }

                return $status;
        })
            ->addColumn('exp_date', function($data){

                $exp_date = date('d-m-Y', strtotime($data->exp_date));;

                return $exp_date;
        })
            ->addColumn('action', function($data){

                $action = '';

                if ($data->status != 'used') {
                    $action = '<a class="btn btn-sm btn-info" href="'.route('admin-edit-voucher', $data->id).'" target="_blank"><i class="fas fa-cog"></i></a>';
                }

                return $action;
        })
            ->rawColumns(['action', 'exp_date', 'status', 'products', 'voucher_code', 'voucher_id'])->make(true);
        }

    }


    function AdminProductsTable(Request $req)
    {
        if (Request()->ajax()) {

            return datatables()->of(Product::where('product_published', 1)->latest()->get())

            ->addColumn('stock', function($data){

                if ($data->product_stock > 0) {
                    $stock = '<i class="fa fa-circle" style="color: #10c469;"></i>&nbsp;'.$data->product_stock;
                    $stock .= '&nbsp;&nbsp;';
                } 
                elseif ($data->product_stock < 1){
                    $stock = '<i class="fa fa-circle" style="color: #F44336;"></i>&nbsp;Unavailable';
                    $stock .= '&nbsp;&nbsp;';
                } else {

                    $stock = 'Unknown';
                }
                
                return $stock;
        })
            ->addColumn('product_mrp_custom', function($data){

                $mrp = number_format($data->product_mrp, 2, ".", ",");
                
                return $mrp;
        })
            ->addColumn('product_price_custom', function($data){

                $price = number_format($data->product_price, 2, ".", ",");

                return $price;
        })
            ->addColumn('product_status', function($data){

                if ($data->product_status == 1) {
                    $status = '<i class="fa fa-circle" style="color: #10c469;"></i>&nbsp;Active';
                    $status .= '&nbsp;&nbsp;';
                } 
                elseif ($data->product_status == 0) {
                    $status = '<i class="fa fa-circle" style="color: #F44336;"></i>&nbsp;Inactive';
                    $status .= '&nbsp;&nbsp;';
                }
                $data->product_status;

                return $status;
        })
            ->addColumn('action', function($data){

                $ProductURL = route('product-index', $data->id);

                $EditURL = route('edit-product',$data->id);

                $button = '<a href="'.$EditURL.'" class="btn btn-primary" target="_blank"><i class="fa fa-cog"></i></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.$ProductURL.'" class="btn btn-primary" target="_blank"><i class="fa fa-share"></i></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a data-toggle="modal" data-target="#RemoveProductModal'.$data->id.'" class="btn btn-danger"><i class="fa fa-trash"></i></a>';
                
                return $button;
        })
            ->rawColumns(['action', 'product_mrp_custom', 'product_price_custom', 'stock', 'product_status'])->make(true);

        } else { return redirect()->route('home'); }

        
    }


    public function AdminProductsPublishTable(Request $req)
    {
        if (Request()->ajax()) {

            return datatables()->of(Product::where('product_published', 0)->latest()->get())

            ->addColumn('product_status_custom', function($data){

                $status = '<i class="fa fa-circle" style="color: #ffcc00;"></i> Pending';

                return $status;
        })
            ->addColumn('product_mrp_custom', function($data){

                $mrp = number_format($data->product_mrp, 2, ".", ",").' INR';
                
                return $mrp;
        })
            ->addColumn('product_price_custom', function($data){

                $price = number_format($data->product_price, 2, ".", ",").' INR';

                return $price;
        })
            ->addColumn('action', function($data){

                $btnURL = url('/admin/manage-products/publish-product/id/'.$data->id);

                $button = "<a href='$btnURL' class='btn btn-info' target='_blank'><i class='fa fa-check-square'></i></a>";
                
                return $button;
        })
            ->rawColumns(['action', 'product_mrp_custom', 'product_price_custom', 'product_status_custom'])->make(true);

        } else { return redirect()->route('home'); }
    }





}
