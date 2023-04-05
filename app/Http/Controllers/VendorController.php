<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Page;
use App\Models\Category;
use App\Models\Brand;
use App\Mail\OrderMail;
use App\Mail\ContactMail;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Wallet;
use Cart;
use Auth;
use Session;
use Carbon\Carbon;
use PDF;
use File;
use Image;
use Alert;
use Mail;
use WisdomDiala\Countrypkg\Models\Country;

class VendorController extends Controller
{

    public function ppp()
    {
        if (Auth::check()) {
            if (Auth::user()->type == 1) {
                return redirect()->route('home');
            }
            else{
                $categories = Category::where('parent_id', 0)->orderBy('id', 'DESC')->get();
                $brands = Brand::orderBy('id', 'DESC')->get();
                $colors = Color::where('status', 1)->get();
                $sizes = Size::where('status', 1)->get();
                $offers = Offer::where('status', 1)->get();
                $countries = Country::all();
                return view('pages.vendor.order.index', compact('categories', 'brands', 'colors', 'sizes', 'offers', 'countries'));
            }
        }
        else{
            return redirect()->route('index');
        }
    }
    // vendor account
    public function vendor_account()
    {
        if (Auth::check()) {
            if (Auth::user()->type == 1) {
                return redirect()->route('home');
            }
            else{
                $orders = Order::where('customer_id', Auth::id())->get();
                $wishlists = Wishlist::where('customer_id', Auth::id())->get();
                return view('pages.vendor.account', compact('orders', 'wishlists'));
            }
        }
        else{
            return redirect()->route('index');
        }
    }
    public function vendor_desboard(){
        if (Auth::check()) {
            if (Auth::user()->type == 1) {
                return redirect()->route('home');
            }
            else{
                $orders = Order::where('customer_id', Auth::id())->get();
                $wishlists = Wishlist::where('customer_id', Auth::id())->get();
                return view('pages.vendor.desboard', compact('orders', 'wishlists'));
            }
        }
        else{
            return redirect()->route('index');
        }
    }
    // vendor product
    public function vendor_product(){
        if (Auth::check()) {
            if (Auth::user()->type == 1) {
                return redirect()->route('home');
            }
            else{
                $categories = Category::where('parent_id', 0)->orderBy('id', 'DESC')->get();
                $brands = Brand::orderBy('id', 'DESC')->get();
                $colors = Color::where('status', 1)->get();
                $sizes = Size::where('status', 1)->get();
                $offers = Offer::where('status', 1)->get();
                $countries = Country::all();
                $submission = Product::where('submission', 1)->first();

                if ($submission == true)
                {
                    $product = Product::findOrNew($submission->id);
                    return view('pages.vendor.product.index', compact('categories', 'brands', 'colors', 'sizes', 'offers', 'countries', 'product'));
                }
                else
                {
                    return view('pages.vendor.product.index', compact('categories', 'brands', 'colors', 'sizes', 'offers', 'countries'));
                }

            }
        }
        else{
            return redirect()->route('index');
        }
    }
    //vendor order
    public function vendorOrders()
    {
        if (Auth::check()) {
            $orders = Order::where('customer_id', Auth::id())->get();
            return view('pages.vendor.order.orders', compact('orders'));
        }
        else{
            return redirect()->route('index');
        }
    }
    // vendor profile
    public function vendorProfile(){
        if (Auth::check()) {
            $user = Auth::user();
            return view('pages.vendor.profile.index', compact('user'));
        }
        else{
            return redirect()->route('index');
        }
    }
    //vendor wallet
    public function vendor_wallet()
    {
        if (Auth::check()) {
            if (Auth::user()->type == 1) {
                return redirect()->route('home');
            }
            else{
                $wallet = Wallet::where('vendor_id', Auth::id())->first();
                return view('pages.vendor.wallet', compact('wallet'));
            }
        }
        else{
            return redirect()->route('index');
        }
    }
    //vendor wishlist
    public function vendor_wishlist()
    {
        $wishlists = Wishlist::where('customer_id', Auth::id())->get();
        return view('pages.vendor.wishlist', compact('wishlists'));
    }
    // vendor profile update
    public function profile_update(Request $request)
    {
    	$user = Auth::user();
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,'.$user->id,
            'phone' => 'required|max:255|unique:users,phone,'.$user->id,
            'image' => 'nullable|image',
        ]);
    	if (!is_null($user)) {
    		$user->name = $request->name;
	        $user->last_name = $request->last_name;
	        $user->email = $request->email;
	        $user->phone = $request->phone;
            $user->city = $request->city;
	        // $user->dob = $request->dob;
         //    $user->gender = $request->gender;
         //    $user->country = $request->country;
	        // if (Auth::user()->type != 3) {
	        // 	$user->description = $request->description;



	        // }
            // image save
            if ($request->image){
                if (Auth::user()->type == 2) {
                    if (File::exists('images/admin/'.$user->image)){
                        File::delete('images/admin/'.$user->image);
                    }
                    $image = $request->file('image');
                    $img = time() . '.' . $image->getClientOriginalExtension();
                    $location = public_path('images/admin/'. $img);
                    Image::make($image)->save($location);
                    $user->image = $img;
                }

            }
	        $user->save();
            Alert::toast('Profile has been updated', 'success');
        	return redirect()->route('vendor.profile.update');
    	}
    }
    //vendor Visit stor
    public function vendor_visit_stor($id){
        $products = Product::where('user_id', $id)->where('is_active', 1)->orderBy('id', 'DESC')->paginate(18);
        $v_products = Product::where('user_id', $id)->where('is_active', 1)->get();
        $user_info = User::find($id);
        return view('pages.vendor.product.visit-stor', compact('products', 'v_products', 'user_info'));
    }
}
