<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    public function index()
    {
        return view('admin.attributes.index',[
            'colors' => Color::all(),
            'sizes' => Size::all()
        ]);
    }


}
