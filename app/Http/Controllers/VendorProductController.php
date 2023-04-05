<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Offer;
use App\Models\Package;
use App\Models\ProductVariation;
use App\Models\Size;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Page;
use App\Models\User;
use App\Models\RatingReview;
use App\Models\Variation;
use Auth;
use Image;
use File;
use Alert;
use WisdomDiala\Countrypkg\Models\Country;

class VendorProductController extends Controller
{

    public function vendorStore(Request $request, Product $product)
    {
        $product->title = $request->title;
        $product->user_id = Auth::user()->id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->unit = $request->unit;
        $product->vendor_p = 1;
        $product->submission = 1;
        $product->is_active = 0;
        $product->weight = $request->weight;
        $product->code = 'UL'.'-'.$this->generateUniqueCode();
        if (!$request->wholesale) {
            $product->wholesale = 2;
        } else {
            $product->wholesale = 1;
        }
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
    public function update1(Request $request)
    {
        $submission = Product::where('submission', 1)->first();
        $product = Product::findOrNew($submission->id);
        $product->title = $request->title;
        $product->user_id = Auth::user()->id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->unit = $request->unit;
        $product->weight = $request->weight;
        if (!$request->wholesale) {
            foreach ($product->package as $pack)
            {
                $pack->delete();
            }
            $product->wholesale = 2;
            $product->minimum_order_quantity = '';
            $product->color_id = '';
            $product->size_id = '';
        } else {
            $product->wholesale = 1;
            $product->qty = null;
            $product->price = null;
            $product->discount_price = null;
            $product->offer_start = null;
            $product->offer_end = null;
            foreach ($product->variation as $variant)
            {
                if (file_exists($variant->variation_image))
                {
                    unlink($variant->variation_image);
                }
                $variant->delete();
            }
        }
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

    public function update2(Request $request)
    {
        $submission = Product::where('submission', 1)->first();
        $product = Product::findOrNew($submission->id);
        $product->description = $request->description;
        $product->description2 = $request->description2;
        $product->save();
        return redirect()->back();
    }

    public function update3(Request $request)
    {
        $submission = Product::where('submission', 1)->first();
        $product = Product::findOrNew($submission->id);
        if ($product->wholesale == 1)
        {
            $product->minimum_order_quantity = $request->minimum_order_quantity;
            $product->color_id = $request->color_id;
            $product->size_id = $request->size_id;
            $product->qty = $request->qty;
            $product->save();
            return redirect()->back();
        }
    }
    public function update4(Request $request)
    {
        $submission = Product::where('submission', 1)->first();
        $product = Product::findOrNew($submission->id);
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->offer_start = $request->offer_start;
        $product->offer_end = $request->offer_end;
        $product->save();
        return redirect()->back();
    }

    public function serviceUpdate(Request $request)
    {
        $submission = Product::where('submission', 1)->first();
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
        $product->submission = $submission->id;
        $product->save();
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
        if (!$request->wholesale) {
            foreach ($product->package as $pack)
            {
                $pack->delete();
            }
            $product->wholesale = 2;
            $product->minimum_order_quantity = '';
            $product->color_id = '';
            $product->size_id = '';
        } else {
            $product->wholesale = 1;
            $product->qty = null;
            $product->price = null;
            $product->discount_price = null;
            $product->offer_start = null;
            $product->offer_end = null;
            foreach ($product->variation as $variant)
            {
                if (file_exists($variant->variation_image))
                {
                    unlink($variant->variation_image);
                }
                $variant->delete();
            }
        }
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

    public function editUpdate3(Request $request)
    {
        // $submission = Product::where('submission', 1)->first();
        $product = Product::findOrNew($request->product_id);
        if ($product->wholesale == 1)
        {
            $product->minimum_order_quantity = $request->minimum_order_quantity;
            $product->color_id = $request->color_id;
            $product->size_id = $request->size_id;
            $product->qty = $request->qty;
            $product->save();
            return redirect()->back();
        }
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


    public function packageStore(Request $request)
    {
        $package = new Package();
        $package->product_id = $request->product_id;
        $package->pack_name = $request->pack_name;
        $package->quantity = $request->quantity;
        $package->price = $request->price;
        $package->discount_price = $request->discount_price;
        $package->offer_start = $request->offer_start;
        $package->offer_end = $request->offer_end;
        $package->save();
        return redirect()->back();
    }

    // vendor product
    public function vendorProductShow()
    {
        if (Auth::check()) {
            if (Auth::user()->type == 1) {
                return redirect()->route('home');
            } else {
                $products = Product::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
                return view('pages.vendor.product.show', compact('products'));
            }
//                $categories = Category::where('parent_id', 0)->orderBy('id', 'DESC')->get();
//                $brands = Brand::orderBy('id', 'DESC')->get();
//                $random_products= Product::where('user_id', Auth::user()->id)->where('is_active', 0)->orderBy('id', 'DESC')->get();
//                //   $products = Product::where('is_active', 1)->orderBy('id', 'DESC')->limit(8)->get();
//
//        $deals = Product::where('is_active', 1)->inRandomOrder()->limit(2)->get();
//        $categories = Category::where('is_active', 1)->where('parent_id', 0)->orderBy('position', 'ASC')->get();
//        $featured_categories = Category::where('is_active', 1)->where('is_featured', 1)->get();
//        $sliders = Slider::all();
//        $top_sales = Product::where('is_active', 1)->orderBy('sold', 'DESC')->limit(3)->get();
//        $page = Page::find(1);
//                return view('pages.vendor.product.show', compact('categories', 'brands','random_products','featured_categories', 'deals', 'random_products', 'sliders', 'page', 'top_sales'));
//            }
        } else {
            return redirect()->route('index');
        }
    }

    public function edit($id)
    {
        if (Auth::user()->type == 2) {
            $product = Product::find($id);
            // dd($product);
            $category_edit = Category::where('parent_id', 0)->find($product->category_id);
            // dd($category_edit);
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
                $package = Package::where('product_id', $id)->get();
                $submission = Product::where('submission', $product->id)->first();
//                dd($submission);
                return view('pages.vendor.product.edit', compact('product','category_edit','categories','selectedColors','selectedSizes', 'sub_categories', 'brands', 'colors', 'sizes', 'offers', 'countries', 'package', 'submission'));
            }
            else{
                Alert::toast('Page Not Found !', 'error');
            }
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
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
            $product->delete();
            Alert::toast('Product has been deleted !', 'success');
            return back();
        }
        else {
            session()->flash('error','Something went wrong !');
            return back();
        }
    }

    public function deletePackage(Request $request)
    {
        $pack_id = $request->pack_id;
        $package = Package::find($pack_id);
        $package->delete();
        return redirect()->back();
    }
    public function vendorProductTutorial()
    {
        return view('pages.vendor.product.tutorial', ['tutorial' => Tutorial::where('type', 'product')->where('status', 1)->first()]);
    }
    //reviw replay
    public function reviewReplay()
    {
        $review_replay = RatingReview::get();
        // dd($review_replay);
        return view('pages.vendor.product.review_replay',compact('review_replay'));
    }
    //    conversationStore
    public function conversationStore(Request $request){
        //
    }

}

