<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
