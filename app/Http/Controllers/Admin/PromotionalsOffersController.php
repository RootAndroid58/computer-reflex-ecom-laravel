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

    public function EditVoucher($voucher_id)
    {
        $voucher = Voucher::with('products.product')->where('id', $voucher_id)->first();
        if (!isset($voucher) || $voucher->status == 'used') {
            abort(404);
        }
        return view('admin.voucher.edit-voucher', [
            'voucher' => $voucher,
        ]);
    }

    public function EditVoucherSubmit(Request $req)
    {
        // dd($req);
        $req->validate([
            'voucher_id'        => 'required|exists:vouchers,id',
            'product_ids'       => 'required|exists:products,id',
            'special_prices.*'  => 'required|numeric',
            'exp_date'          => 'required',
        ]);

        if (count($req->qty) != count($req->product_ids)) {
            abort(500);
        }

        $voucher = Voucher::where('id', $req->voucher_id)->first();

        if ($voucher->status == 'used') {
            abort(404);
        }

        $voucher->update([
            'exp_date' => $req->exp_date,
        ]);

        VoucherProduct::where('voucher_id', $req->voucher_id)->delete();

        foreach ($req->product_ids as $key => $product_id) {
            $VoucherProduct = new VoucherProduct;
            $VoucherProduct->voucher_id = $req->voucher_id;
            $VoucherProduct->product_id = $product_id;
            $VoucherProduct->qty = $req->qty[$key];
            $VoucherProduct->save();
        }
        
        return redirect()->route('admin-edit-voucher', $req->voucher_id)->with([
            'voucherEdited' => $req->voucher_id,
        ]);

    }

    public function CreateVoucherSubmit(Request $req)
    {        
        $req->validate([
            'product_ids'       => 'required|exists:products,id',
            'special_prices.*'  => 'required|numeric',
            'exp_date'          => 'required',
        ]);

        if (count($req->qty) != count($req->product_ids)) {
            abort(500);
        }

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
        
        return redirect()->route('admin-edit-voucher', $req->voucher_id)->with([
            'voucherCreated' => $Voucher->id,
        ]);
    }

    public function Redeem(Request $req)
    {

        $voucher = Voucher::with('products.product.images')->where('code', $req->code)->first();

        if (isset($req->code) && !isset($voucher)) {
            $error = 'Oops! The Voucher code is invalid, please check for any typo.';
        }

        return view('redeem-voucher', [
            'voucher' => $voucher ?? null,
            'error' => $error ?? null,
        ]);
    }
}
