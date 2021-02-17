<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class AjaxDataTable extends Controller
{
    public function AdminShipOrdersTable(Request $req)
    {
        if (Request()->ajax()) {

            return datatables()->of(Order::with(['OrderItems', 'User'])->where('status', 'order_placed')->orwhere('status', 'order_packing')->latest()->get())
            
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

                $registered_mobile = $data->User->mobile;

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

                $registered_mobile = $data->User->mobile;

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
                    
                return $payment_method;
            })

            ->rawColumns(['order_id', 'status', 'price', 'payment_method', 'registered_email'])->make(true);

        } else 
        { 
            return redirect()->route('home'); 
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
