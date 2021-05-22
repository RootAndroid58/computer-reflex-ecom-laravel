<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Voucher;
use App\Models\VoucherProduct;
use Str;

class PromotionalsOffersController extends Controller
{
    public function ManageOffers()
    {
        return view('admin.manage-offers');
    }

    public function ManageVouchers()
    {
        return view('admin.voucher.manage-vouchers');
    }

    public function CreateVoucher()
    {
        return view('admin.voucher.create-voucher');
    }

    public function CreateVoucherSubmit(Request $req)
    {        
        $req->validate([
            'product_ids'       => 'required|exists:products,id',
            'special_prices.*'  => 'required|numeric',
            'exp_date'          => 'required',
        ]);

        $Voucher = new Voucher;
        $Voucher->code = newVoucherCode();
        $Voucher->status = 'active';
        $Voucher->exp_date = $req->exp_date;
        $Voucher->save();

        foreach ($req->product_ids as $key => $product_id) {
            $VoucherProduct = new VoucherProduct;
            $VoucherProduct->voucher_id = $Voucher->id;
            $VoucherProduct->product_id = $product_id;
            $VoucherProduct->special_price = $req->special_prices[$key];
            $VoucherProduct->qty = $req->qty[$key];
            $VoucherProduct->save();
        }
        
        return redirect()->back();
    }
}
