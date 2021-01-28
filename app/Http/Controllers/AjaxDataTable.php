<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AjaxDataTable extends Controller
{
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
