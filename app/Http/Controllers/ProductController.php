<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Gallery;
use App\Models\Offer;
use App\Models\Package;
use App\Models\ProductVariation;
use App\Models\Size;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Variation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Image;
use File;
use Alert;
use WisdomDiala\Countrypkg\Models\Country;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == 1) {
            $products = Product::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
            return view('admin.product.index', compact('products'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }
    // vendor product list
    public function productRequest()
    {
        if (Auth::user()->type == 1) {
            $products = Product::where('is_active', 0)->orderBy('id', 'DESC')->get();
            // $random_products= Product::where('user_id', Auth::user()->id)->where('is_active', 0)->orderBy('id', 'DESC')->get();
            return view('admin.product.vendor.index', compact('products'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }

    public function productApprovedList()
    {
        if (Auth::user()->type == 1) {
            $products = Product::where('is_active', 1)->where('vendor_p', 1)->orderBy('id', 'DESC')->get();
            // $random_products= Product::where('user_id', Auth::user()->id)->where('is_active', 0)->orderBy('id', 'DESC')->get();
            return view('admin.product.vendor.approved', compact('products'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }

    public function vendorShow($id)
    {
        $product = Product::with('subCategory')->find($id);
        $selectedColors = explode(',', $product->color_id);
        $colors = Color::whereIn('id', $selectedColors)->pluck('name')->toArray();
        $separator = ',';
        $colorsName = implode($separator, $colors);
        $selectedSize = explode(',', $product->size_id);
        $sizes = Size::whereIn('id', $selectedSize)->pluck('name')->toArray();
        $sizeName = implode($separator,$sizes);
        $packages = Package::where('product_id', $id)->get();
        $startDate = Carbon::parse($product->created_at);
        $endDate = Carbon::parse($product->maximum_delivery_date);
        $numberOfDay = $startDate->diffInDays($endDate);
        return view('admin.product.vendor.view', compact('product', 'colorsName', 'sizeName', 'packages', 'numberOfDay'));
    }
    // vendor list
    public function vendorlist()
    {
        if (Auth::user()->type == 1) {
            $users = User::where('type', 2)->orderBy('id', 'DESC')->get();
            // dd($users);
            return view('admin.product.vendor.list', compact('users'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }
    // ---------------Active-----------------
    public function vendorActive($id){
        //   dd($id);
        User::findOrFail($id)->update(['vendor_status' => 1]);
       return redirect()->back();
        }
    // -----------------deactive----------------------
    public function vendorDeactive($id){
        User::findOrFail($id)->update(['vendor_status' => 0]);
        return redirect()->back();
    }

     // ---------------Active-----------------
     public function Active($id){

        Product::findOrFail($id)->update(['vendor_status' => 0 ]);
       return redirect()->back();
        }
    // -----------------deactive----------------------
    public function Deactive($id){
        Product::findOrFail($id)->update(['vendor_status' => 1 ]);
        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->type == 1) {
            $categories = Category::where('parent_id', 0)->orderBy('id', 'DESC')->get();
            $brands = Brand::orderBy('id', 'DESC')->get();
            $colors = Color::where('status', 1)->get();
            $sizes = Size::where('status', 1)->get();
            $offers = Offer::where('status', 1)->get();
            $countries = Country::all();
            $submission = Product::where('submission', 2)->first();

            if ($submission == true)
            {
                $product = Product::findOrNew($submission->id);
                return view('admin.product.create', compact('categories', 'brands', 'colors', 'sizes', 'offers', 'countries', 'product'));
            }
            else
            {
                return view('admin.product.create', compact('categories', 'brands', 'colors', 'sizes', 'offers', 'countries'));
            }
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }

    public function productStore(Request $request, Product $product)
    {
        $product->title = $request->title;
        $product->user_id = Auth::user()->id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->unit = $request->unit;
        $product->submission = 2;
        $product->is_active = 2;
        $product->weight = $request->weight;
        $product->code = 'UL'.'-'.$this->generateUniqueCode();
        $product->product_variation = $request->product_variation;
        if (!$request->retail) {
            $product->retail = 2;
        } else {
            $product->retail = 1;
        }
        if (!$request->cross_border) {
            $product->cross_border = 2;
        } else {
            $product->cross_border = 1;
        }
        if (!$request->pre_order) {
            $product->pre_order = 2;
        } else {
            $product->pre_order = 1;
        }
        if ($request->image) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $directory = 'images/product/';
            $image->move($directory, $imageName);
            $imageUrl = $directory . $imageName;
            $product->image = $imageUrl;
        }
        $product->save();

        if (count($request->gallery) > 0) {
            $i = 0;
            foreach ($request->gallery as $gallery) {
                $imageName = time() . $i . '.' . $gallery->getClientOriginalExtension();
                $directory = 'images/product/gallery/';
                $gallery->move($directory, $imageName);
                $galleryUrl = $directory . $imageName;

                $gallery = new ProductImage;
                $gallery->image = $galleryUrl;
                $gallery->product_id = $product->id;
                $gallery->save();
                $i = $i + 1;
            }
        }
        return redirect()->back();
    }

    public function productUpdate1(Request $request)
    {
        $submission = Product::where('submission', 2)->first();
        $product = Product::findOrNew($submission->id);
        $product->title = $request->title;
        $product->user_id = Auth::user()->id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->unit = $request->unit;
        $product->weight = $request->weight;
        $product->product_variation = $request->product_variation;
        if (!$request->retail) {
            $product->retail = 2;
        } else {
            $product->retail = 1;
        }
        if (!$request->cross_border) {
            $product->cross_border = 2;
        } else {
            $product->cross_border = 1;
        }
        if (!$request->pre_order) {
            $product->pre_order = 2;
        } else {
            $product->pre_order = 1;
        }
        if ($request->image) {
            if (file_exists($product->image))
            {
                unlink($product->image);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $directory = 'images/product/';
            $image->move($directory, $imageName);
            $imageUrl = $directory . $imageName;
        }
        else
        {
            $imageUrl = $product->image;
        }
        $product->image = $imageUrl;

        $product->save();


        if ($request->file('gallery'))
        {
            $gallerys = ProductImage::where('product_id', $submission->id)->get();
            foreach ($gallerys as $gallery)
            {
                if (file_exists($gallery->image))
                {
                    unlink($gallery->image);
                }
                $gallery->delete();
            }
            if (count($request->gallery) > 0){
                $i = 0;
                foreach ($request->gallery as $gallery){
                    $imageName = time() . $i . '.' . $gallery->getClientOriginalExtension();
                    $directory = 'images/product/gallery/';
                    $gallery->move($directory, $imageName);
                    $galleryUrl = $directory.$imageName;

                    $gallery = new ProductImage;
                    $gallery->image = $galleryUrl;
                    $gallery->product_id = $product->id;
                    $gallery->save();
                    $i = $i + 1;
                }
            }
        }
        return redirect()->back();
    }
    public function productUpdate2(Request $request)
    {
        $submission = Product::where('submission', 2)->first();
        $product = Product::findOrNew($submission->id);
        $product->description = $request->description;
        $product->description2 = $request->description2;
        $product->save();
        return redirect()->back();
    }

    public function productUpdate4(Request $request)
    {
        $submission = Product::where('submission', 2)->first();
        $product = Product::findOrNew($submission->id);
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->offer_start = $request->offer_start;
        $product->offer_end = $request->offer_end;
        $product->save();
        return redirect()->back();
    }

    public function productServiceUpdate(Request $request)
    {
        $submission = Product::where('submission', 2)->first();
        $product = Product::findOrNew($submission->id);
        $product->origin_country_id = $request->origin_country_id;
        $product->product_quality = $request->product_quality;
        $product->lenth = $request->lenth;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->free_shipping = $request->free_shipping;
        $product->wa_gu = $request->wa_gu;
        $product->w_g_type = $request->w_g_type;
        $product->duration_time = $request->duration_time;
        $product->duration = $request->duration;
        $product->country_id = $request->country_id;
        $product->maximum_delivery_date = $request->maximum_delivery_date;
        $product->is_active = 1;
        $product->submission = $submission->id;
        $product->save();
        return redirect()->back();
    }

    public function variantStore(Request $request)
    {
        $variationImg = $request->file('variation_image');
        $imageNames = time() .'.' . $variationImg->getClientOriginalExtension();
        $directory = 'images/product/variation-images/';
        $variationImg->move($directory,$imageNames);
        $variationUrl = $directory.$imageNames;
//                dd($variationUrl);

        $product_id = $request->product_id;
        $variation = new ProductVariation();
        $variation->product_id = $product_id;
        $variation->color_id = $request->color_id;
        $variation->size_id = $request->size_id;
        $variation->qty = $request->qty;
        $variation->price = $request->price;
        $variation->discount_price = $request->discount_price;
        $variation->offer_start = $request->offer_start;
        $variation->offer_end = $request->offer_end;
        $variation->variation_image = $variationUrl;
        $variation->save();
        return redirect()->back();

    }

    public function editUpdate1(Request $request)
    {
//        $submission = Product::where('id',$request->product_id)->first();
        $product = Product::findOrNew($request->product_id);
        $product->title = $request->title;
        $product->user_id = Auth::user()->id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->unit = $request->unit;
        $product->weight = $request->weight;
        $product->code = 'UL'.'-'.$this->generateUniqueCode();
        $product->product_variation = $request->product_variation;
        if (!$request->retail) {
            $product->retail = 2;
        } else {
            $product->retail = 1;
        }
        if (!$request->cross_border) {
            $product->cross_border = 2;
        } else {
            $product->cross_border = 1;
        }
        if (!$request->pre_order) {
            $product->pre_order = 2;
        } else {
            $product->pre_order = 1;
        }
        if ($request->image) {
            if (file_exists($product->image))
            {
                unlink($product->image);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $directory = 'images/product/';
            $image->move($directory, $imageName);
            $imageUrl = $directory . $imageName;
        }
        else
        {
            $imageUrl = $product->image;
        }
        $product->image = $imageUrl;

        $product->save();


        if ($request->file('gallery'))
        {
            $gallerys = ProductImage::where('product_id', $request->product_id)->get();
            foreach ($gallerys as $gallery)
            {
                if (file_exists($gallery->image))
                {
                    unlink($gallery->image);
                }
                $gallery->delete();
            }
            if (count($request->gallery) > 0){
                $i = 0;
                foreach ($request->gallery as $gallery){
                    $imageName = time() . $i . '.' . $gallery->getClientOriginalExtension();
                    $directory = 'images/product/gallery/';
                    $gallery->move($directory, $imageName);
                    $galleryUrl = $directory.$imageName;

                    $gallery = new ProductImage;
                    $gallery->image = $galleryUrl;
                    $gallery->product_id = $product->id;
                    $gallery->save();
                    $i = $i + 1;
                }
            }
        }
        return redirect()->back();
    }

    public function editUpdate2(Request $request)
    {
        // $submission = Product::where('id',$request->product_id)->first();
        $product = Product::findOrNew($request->product_id);
        $product->description = $request->description;
        $product->description2 = $request->description2;
        $product->save();
        return redirect()->back();
    }

    public function edit_update4(Request $request)
    {
        $product = Product::findOrNew($request->product_id);
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->offer_start = $request->offer_start;
        $product->offer_end = $request->offer_end;
        $product->save();
        return redirect()->back();
    }


    public function editServiceUpdate(Request $request)
    {
        // $submission = Product::where('submission', 1)->first();
        $product = Product::findOrNew($request->product_id);
        $product->origin_country_id = $request->origin_country_id;
        $product->product_quality = $request->product_quality;
        $product->lenth = $request->lenth;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->free_shipping = $request->free_shipping;
        $product->wa_gu = $request->wa_gu;
        $product->w_g_type = $request->w_g_type;
        $product->duration_time = $request->duration_time;
        $product->duration = $request->duration;
        $product->country_id = $request->country_id;
        $product->maximum_delivery_date = $request->maximum_delivery_date;
        // $product->submission = $submission->id;
        $product->save();
        return redirect()->back();
    }

    public function generateUniqueCode()
    {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;

        $code = '';

        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if (Product::where('code', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
//        dd($request);
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            //'type' => 'required|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable',
        ]);


        $product = new Product;
        $product->title = $request->title;
        $product->user_id = Auth::user()->id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->unit = $request->unit;
        if (!empty($request->code)) {
            $product->code = $request->code;
        } else {
            $product->code = $this->generateUniqueCode();
        }
        $product->product_variation = $request->product_variation;
        if (!$request->retail) {
            $product->retail = 2;
        } else {
            $product->retail = 1;
        }
        if (!$request->cross_border) {
            $product->cross_border = 2;
        } else {
            $product->cross_border = 1;
        }
        if (!$request->pre_order) {
            $product->pre_order = 2;
        } else {
            $product->pre_order = 1;
        }
        if ($request->product_variation == 1) {
            $product->color_id = implode(',', $request->color_id);
            $product->size_id = implode(',', $request->size_id);
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->qty = $request->qty;
            $product->offer_start = $request->offer_start;
            $product->offer_end = $request->offer_end;
        }
        if ($request->product_variation == 2) {
            $product->color_id = $request->color_ids;
            $product->size_id = $request->size_ids;
            $product->price = $request->prices;
            $product->discount_price = $request->discount_prices;
            $product->qty = $request->qtys;
            $product->offer_start = $request->offer_starts;
            $product->offer_end = $request->offer_ends;
        }
        $product->description = $request->description;
        $product->description2 = $request->description2;
        $product->specification = $request->specification;
        $product->origin = $request->origin;
        $product->free_shipping = $request->free_shipping;
        //$product->type = $request->type;
        $product->is_active = 1;
        $product->weight = $request->weight;
        $product->wa_gu = $request->wa_gu;
        $product->w_g_type = $request->w_g_type;
        $product->duration_time = $request->duration_time;
        $product->duration = $request->duration;
        if ($request->cross_border == 1) {
            $product->country_id = $request->country_id;
        }
        if ($request->pre_order == 1) {
            $product->maximum_delivery_date = $request->maximum_delivery_date;
        }
        if ($request->has('is_sale')) {
            $product->is_sale = 1;
        }
        // image save
        if ($request->image) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $directory = 'images/product/';
            $image->move($directory, $imageName);
            $imageUrl = $directory . $imageName;
            $product->image = $imageUrl;
        }
        $product->save();
        // check if any gallery image then save
        if (count($request->gallery) > 0) {
            $i = 0;
            foreach ($request->gallery as $gallery) {
                $imageName = time() . $i . '.' . $gallery->getClientOriginalExtension();
                $directory = 'images/product/gallery/';
                $gallery->move($directory, $imageName);
                $galleryUrl = $directory . $imageName;

                $gallery = new ProductImage;
                $gallery->image = $galleryUrl;
                $gallery->product_id = $product->id;
                $gallery->save();
                $i = $i + 1;
            }
        }

        Alert::toast('Product Added!', 'success');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->type == 1) {
            $product = Product::find($id);
            if (!is_null($product)) {
                $categories = Category::where('parent_id', 0)->orderBy('id', 'DESC')->get();
                $sub_categories = optional($product->category)->child;
                $brands = Brand::orderBy('id', 'DESC')->get();
                $colors = Color::where('status', 1)->get();
                $sizes = Size::where('status', 1)->get();
                $offers = Offer::where('status', 1)->get();
                $selectedColors =  explode(',', $product->color_id);
                $selectedSizes =  explode(',', $product->size_id);
                $countries = Country::all();
                return view('admin.product.edit', compact('product','categories','selectedColors','selectedSizes', 'sub_categories', 'brands', 'colors', 'sizes', 'offers', 'countries'));
            }
            else{
                Alert::toast('Page Not Found !', 'error');
            }
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }

    public function productApproved(Request $request, $id)
    {
        $product = Product::find($id);
        $product->is_active = $request->is_active;
        $product->save();
        return redirect()->back()->with('success', 'Vendor Product Approved Successfull');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        $validatedData = $request->validate([
//            'title' => 'required|max:255',
//            //'type' => 'required|max:255',
//            'price' => 'required|numeric',
//            'image' => 'nullable',
//        ]);


        $product = Product::find($id);
        if (!is_null($product)) {
            $product->title = $request->title;
            $product->user_id = Auth::user()->id;
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->brand_id = $request->brand_id;
            $product->unit = $request->unit;
            if (!empty($request->code))
            {
                $product->code = $request->code;
            }
            else
            {
                $product->code = $this->generateUniqueCode();
            }
            $product->product_variation = $request->product_variation;
            if (!$request->retail) {
                $product->retail = 2;
            } else {
                $product->retail = 1;
            }
            if (!$request->cross_border) {
                $product->cross_border = 2;
            } else {
                $product->cross_border = 1;
            }
            if (!$request->pre_order) {
                $product->pre_order = 2;
            } else {
                $product->pre_order = 1;
            }
            if ($request->product_variation == 1) {
                $product->color_id = implode(',', $request->color_id);
                $product->size_id = implode(',', $request->size_id);
                $product->price = $request->price;
                $product->discount_price = $request->discount_price;
                $product->qty = $request->qty;
                $product->offer_start = $request->offer_start;
                $product->offer_end = $request->offer_end;
            }
            if ($request->product_variation == 2) {
                $product->color_id = $request->color_ids;
                $product->size_id = $request->size_ids;
                $product->price = $request->prices;
                $product->discount_price = $request->discount_prices;
                $product->qty = $request->qtys;
                $product->offer_start = $request->offer_starts;
                $product->offer_end = $request->offer_ends;
            }
            $product->description = $request->description;
            $product->description2 = $request->description2;
            $product->specification = $request->specification;
            $product->origin = $request->origin;
            $product->free_shipping = $request->free_shipping;
            //$product->type = $request->type;
            $product->is_active = 1;
            $product->weight = $request->weight;
            $product->wa_gu = $request->wa_gu;
            $product->w_g_type = $request->w_g_type;
            $product->duration_time = $request->duration_time;
            $product->duration = $request->duration;
            if ($request->cross_border == 1) {
                $product->country_id = $request->country_id;
            }
            if ($request->pre_order == 1) {
                $product->maximum_delivery_date = $request->maximum_delivery_date;
            }
            if ($request->has('is_sale')) {
                $product->is_sale = 1;
            }
            // check if any gallery image then save
            if ($request->file('image'))
            {
                if (file_exists($product->image))
                {
                    unlink($product->image);
                }
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $directory = 'images/product/';
                $image->move($directory, $imageName);
                $imageUrl = $directory.$imageName;
            }
            else
            {
                $imageUrl = $product->image;
            }
            $product->image = $imageUrl;
            $product->save();
            // check if any gallery image then save
            if ($request->file('gallery'))
            {
                $gallerys = ProductImage::where('product_id', $id)->get();
                foreach ($gallerys as $gallery)
                {
                    if (file_exists($gallery->image))
                    {
                        unlink($gallery->image);
                    }
                    $gallery->delete();
                }
                if (count($request->gallery) > 0){
                    $i = 0;
                    foreach ($request->gallery as $gallery){
                        $imageName = time() . $i . '.' . $gallery->getClientOriginalExtension();
                        $directory = 'images/product/gallery/';
                        $gallery->move($directory, $imageName);
                        $galleryUrl = $directory.$imageName;

                        $gallery = new ProductImage;
                        $gallery->image = $galleryUrl;
                        $gallery->product_id = $product->id;
                        $gallery->save();
                        $i = $i + 1;
                    }
                }
            }

            Alert::toast('Product Updated!', 'success');
            return redirect()->route('product.index');
        }
        else{
            Alert::toast('Something went wrong!', 'error');
            return redirect()->route('product.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!is_null($product)) {
            // Deleting the gallery files
            foreach ($product->product_image as $image) {
                if (file_exists($image->image))
                {
                    unlink($image->image);
                }
                $image->delete();
            }
            foreach ($product->package as $item)
            {
                $item->delete();
            }
            // Deleting the product image
            if (file_exists($product->image))
            {
                unlink($product->image);
            }
            // Deleting the variations
            foreach ($product->variation as $variation) {
                $variation->delete();
            }
            $product->delete();
            Alert::toast('Product has been deleted !', 'success');
            return back();
        }
        else {
            session()->flash('error','Something went wrong !');
            return back();
        }
    }
}
