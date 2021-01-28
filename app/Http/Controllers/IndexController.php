<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class IndexController extends Controller
{
    public function Index()
    {
        $banners = Banner::where('banner_status', 1)->orderBy('banner_position', 'ASC')->get();

        return view('index', ['banners' => $banners]);
    }
}
