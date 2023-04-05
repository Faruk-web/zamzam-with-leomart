<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Share;

class SocialShareController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $shareButtons = Share::page(
            'http://127.0.0.1:8000/product/2/mabroom-super-premium-1kg',
            'Your share text comes here'
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()
        ->reddit();

        $posts = Product::get();

        return view('socialshare', compact('shareButtons', 'posts'));
    }
}
