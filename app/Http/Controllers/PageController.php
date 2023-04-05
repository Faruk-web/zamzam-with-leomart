<?php
namespace App\Http\Controllers;
use App\Models\Color;
use App\Models\Page;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductRefund;
use App\Models\ProductVariation;
use App\Models\RatingReview;
use App\Models\Refund;
use App\Models\Size;
use App\Models\Variation;
use App\Models\VariationProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Slider;
use App\Models\Subscriber;
use App\Models\Wishlist;
use App\Models\User;
use App\Models\ProductImage;
use App\Models\Gallery;
use App\Models\Wallet;
use App\Models\WalletEntry;
use App\Models\Payment;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;
use Cart;
use Auth;
use Session;
use Carbon\Carbon;
use PDF;
use File;
use Image;
use Alert;
use Mail;
use App\Mail\OrderMail;
use App\Mail\ContactMail;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('referral')) {
            $id = $request->referral;
            if (!is_null($id)) {
                $user = User::find($id);
                if (!is_null($user)) {
                    session(['referral_id' => $id]);
                }
            }
        }
        $products = Product::with('ratingReview','reviews')->where('is_active', 1)->orderBy('id', 'ASC')->limit(8)->get();
        // dd($products);
        $vendor_products = Product::where('vendor_p', 1)->where('is_active', 1)->orderBy('id', 'DESC')->limit(12)->get();
        $random_products = Product::where('is_active', 1)->inRandomOrder()->limit(12)->get();
        $deals = Product::where('is_active', 1)->inRandomOrder()->limit(2)->get();
        $categories = Category::where('is_active', 1)->where('parent_id', 0)->orderBy('position', 'ASC')->get();
        $featured_categories = Category::where('is_active', 1)->where('is_featured', 1)->get();
        $sliders = Slider::all();
        $top_sales = Product::where('is_active', 1)->orderBy('sold', 'DESC')->limit(3)->get();
        $page = Page::find(1);
//        $vendor_products = Product::where('vendor_p', 1)->latest()->take(8)->get();
        return view('pages.index', compact('products', 'categories', 'featured_categories', 'deals', 'random_products', 'sliders', 'page', 'top_sales','vendor_products'));
    }


    public function products()
    {
        $products = Product::where('is_active', 1)->orderBy('id', 'DESC')->paginate(30);
        $page = Page::find(2);
        $min_price = Product::min('price');
        $max_price = Product::max('price');
//        foreach ($products as $product)
//        {
//            $path1 = asset($product->image);
//            $path2 = asset('images/product/'. $product->image);
//        }
        return view('pages.products', compact('products', 'page', 'min_price', 'max_price'));
    }

    public function offer_products()
    {
        $products = Product::where('is_active', 1)->where('is_sale', 1)->orderBy('id', 'DESC')->get();
        $page = Page::find(7);
        return view('pages.offer-products', compact('products', 'page'));
    }

    public function single_product($id, $slug)
    {
        $product = Product::with('ratingReview')->find($id);
        $user_id = $product->user_id;
        if (!is_null($product)) {
            $shareButtons = \Share::page(
                'https://www.leotechbd.com/',
                'Your share text comes here'
            )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();
            $posts = Product::get();
            $cart = Cart::content();
            $vendor_info = Product::with('user')->find($id);
            $similar_products = Product::where('category_id', $product->category_id)->inRandomOrder()->take(6)->get();
            $vendor_products = Product::where('user_id', $user_id)->inRandomOrder()->limit(6)->get();
            $selectedColorIds = explode(',', $product->color_id);
            $colors = Color::whereIn('id', $selectedColorIds)->get();
            $selectedSize = explode(',', $product->size_id);
            $sizes = Size::whereIn('id', $selectedSize)->get();
            $rating_reviews = RatingReview::where('product_id', $id)->paginate(5);
            $positive_rating = RatingReview::where('product_id', $id)->where('rating', '>=', 3)->count();
            $totalRatingsCount = RatingReview::where('product_id', $id)->count();
            $positiveRatingsPercent = 0;
            if ($totalRatingsCount > 0) {
                $positiveRatingsPercent = ($positive_rating / $totalRatingsCount) * 100;
            }

            $refund = Refund::find(1);
//            dd($rating_reviews);
//            $product_variation = ProductVariation::where('product_id', $id)->get();
            return view('pages.single-product', compact('product','refund', 'positiveRatingsPercent' , 'rating_reviews' ,'similar_products','shareButtons','posts', 'cart', 'colors', 'sizes', 'vendor_products', 'vendor_info'));
        }
        else{
            session()->flash('error','Page Not Found');
            return back();
        }
    }
    public function color_product($id)
    {
        $variation_product = ProductVariation::find($id);
        // dd($variation_product);
        $product = Product::with('ratingReview')->find($variation_product->product_id);
        $vendor_info = Product::with('user')->find($variation_product->product_id);
        if (!is_null($product)) {
            $shareButtons = \Share::page(
                'https://www.leotechbd.com/',
                'Your share text comes here',
            )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();
            $posts = Product::get();
            $cart = Cart::content();
            $similar_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();
            $vendor_products = Product::where('category_id', $product->category_id)->where('vendor_p', 1)->inRandomOrder()->limit(4)->get();
            $selectedColorIds = explode(',', $product->color_id);
            $colors = Color::whereIn('id', $selectedColorIds)->get();
            $selectedSize = explode(',', $product->size_id);
            $sizes = Size::whereIn('id', $selectedSize)->get();
            $rating_reviews = RatingReview::where('product_id', $id)->get();
            return view('pages.color-product', compact('product','rating_reviews','vendor_info','variation_product', 'similar_products','shareButtons','posts', 'cart', 'colors', 'sizes', 'vendor_products'));
        }
        else{
            session()->flash('error','Page Not Found');
            return back();
        }
    }

    public function categories()
    {
        $categories = Category::where('is_active', 1)->where('parent_id', 0)->orderBy('position', 'ASC')->get();
        return view('pages.categories', compact('categories'));
    }

    public function category_products($id, $slug)
    {
        $category = Category::find($id);
        $products = Product::where('category_id', $id)->orWhere('sub_category_id', $id)->where('is_active', 1)->paginate(30);
        if (!is_null($category)) {
            return view('pages.category-product', compact('category', 'products'));
        }
        else{
            session()->flash('error','Page Not Found');
            return back();
        }
    }

    public function brand_products($id, $slug)
    {
        $brand = Brand::find($id);
        $products = Product::where('brand_id', $id)->where('is_active', 1)->paginate(30);
        if (!is_null($brand)) {
            return view('pages.brand-product', compact('brand', 'products'));
        }
        else{
            session()->flash('error','Page Not Found');
            return back();
        }
    }

    public function search(Request $request)
    {
          $query = $request->get('search');
          $filterResult = Product::where('title', 'LIKE', '%'. $query. '%')
        //   ->orWhere('description', 'LIKE', '%'. $query. '%')
          ->where('is_active', 1)
          ->pluck('title');
          // $filterResult = Product::where('title', 'LIKE', '%'. $query. '%')
          // ->orWhere('description', 'LIKE', '%'. $query. '%')
          // ->where('is_active', 1)
          // ->get();
          return $filterResult;
    }

    public function search_result(Request $request)
    {
        $query = $request->search;
        // $products = Product::where('title', 'LIKE', '%'. $query. '%')->orWhere('description', 'LIKE', '%'. $query. '%')->get();
        $products = Product::where('title', 'LIKE', '%'. $query. '%')->get();
        return view('pages.search-result', compact('products'));

    }

    public function product_filter(Request $request)
    {
        $category_id = $request->category_id;
        $brand_id = $request->brand_id;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        if ($category_id != 'all' && $brand_id != 'all') {
            $products = Product::where('category_id', $category_id)->where('brand_id', $brand_id)->whereBetween('price', [$min_price, $max_price])->where('is_active', 1)->get();
        }
        else if ($category_id != 'all' && $brand_id == 'all') {
            $products = Product::where('category_id', $category_id)->whereBetween('price', [$min_price, $max_price])->where('is_active', 1)->get();
        }
        else if ($category_id == 'all' && $brand_id != 'all') {
            $products = Product::where('brand_id', $brand_id)->whereBetween('price', [$min_price, $max_price])->where('is_active', 1)->get();
        }
        else{
            $products = Product::where('is_active', 1)->whereBetween('price', [$min_price, $max_price])->get();
        }

        $product_filtered = '';

        foreach ($products as $product) {
            $product_filtered .= '
                <div class="product-wrap product text-center" style="">
                    <div style="border: 1px solid blue;padding-bottom: 15px;margin: 0px 5px;">
                    <figure class="product-media">
                        <a href="'. route('single.product', [$product->id, Str::slug($product->title)]) .'">
                            <img src="'. asset('images/product/'. $product->image) .'" alt="Product"
                                width="216" height="243" />
                        </a>
                        <div class="product-action-vertical">
                            <a onclick="addToCart('. $product->id .')" class="btn-product-icon w-icon-cart peoduct_cart"
                                title="Add to cart"></a>
                            <a onclick="addToWishlist('. $product->id .')" class="btn-product-icon w-icon-heart peoduct_cart"
                                title="Add to wishlist"></a>

                        </div>
                    </figure>
                    <div class="product-details">
                        <h4 class="product-name"><a href="'. route('single.product', [$product->id, Str::slug($product->title)]) .'">'. $product->title .'</a>
                        </h4>
                        <p>'. $product->weight . $product->unit.'</p>
                        <div class="product-price">';
                            if($product->type == 'single'){
                                if ($product->is_sale == 1) {
                                    $product_filtered .= '<ins class="new-price">'. env('CURRENCY') .  $product->discount_price . env('UAE_CURRENCY') .'</ins><del class="old-price">'. env('CURRENCY') . $product->price . env('UAE_CURRENCY') .'</del>';
                                }
                                else{
                                    $product_filtered .= '<ins class="new-price">'. env('CURRENCY') .  $product->price . env('UAE_CURRENCY') .'</ins>';
                                }
                            }
                            else{
                                if(count($product->variation) == 1){

                                    $product_filtered .='<ins class="new-price">'. env('CURRENCY') . $product->variation->first()->price . env('UAE_CURRENCY') .'</ins>';
                                }
                                else{
                                    $product_filtered .='<ins class="new-price">'. env('CURRENCY') . $product->variation->where('price', $product->variation->min('price'))->first()->price . env('UAE_CURRENCY') . '-' .  env('CURRENCY') . $product->variation->where('price', $product->variation->max('price'))->first()->price  .env('UAE_CURRENCY') .'</ins>';
                                }
                            }
                        $product_filtered .='</div>
                        <button onclick="addToCart('. $product->id .')" class="btn btn-primary added_to_cart_'. $product->id;
                            if ( !is_null(Cart::content()->where('id', $product->id)->first())) {
                                $product_filtered .= ' added_to_cart';
                            }
                            else{
                                $product_filtered .= ' ';
                            }

                        $product_filtered .= '" id="">';
                            if ( !is_null(Cart::content()->where('id', $product->id)->first())) {
                                $product_filtered .= 'Added To Cart';
                            }
                            else{
                                $product_filtered .= 'Add to Cart';
                            }
                    $product_filtered .= '</button></div>
                    </div>
                </div>
                        ';
        }
        return ['product_filtered' => $product_filtered];
    }

    public function generate_product_filter()
    {

    }

    public function about()
    {
        $page = Page::find(4);
        $galleries = Gallery::orderBy('id', 'DESC')->get();
        return view('pages.about', compact('page', 'galleries'));
    }

    public function privacy_policy()
    {
        $page = Page::find(5);
        return view('pages.privacy-policy', compact('page'));
    }

    public function term_condition()
    {
        $page = Page::find(6);
        return view('pages.terms-and-conditions', compact('page'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function send_message(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        Mail::send(new ContactMail($request));


        session()->flash('success', 'Thank you for contacting us, we will be in touch within 24 to 48 hours');
        return redirect()->route('contact');
    }

    public function subscribe(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        $subscriber = Subscriber::where('email',$request->email)->first();
        if (is_null($subscriber)) {
            $subscriber = new Subscriber;
            $subscriber->email = $request->email;
            $subscriber->save();

            Alert::success('Thanks, Welcome to our NEWSLETTER', '');
            return back();
        }
        else {
            Alert::error('Thanks, You already subscribed us!', '');
            return back();
        }
    }

    public function order_data($inputValue)
    {
        $order = Order::with('order_product.product')->where('code', $inputValue)->first();
//        dd($order);
        return response()->json([
            'order' => $order
        ]);
    }

    public function get_refund_price()
    {
        $this->productId       = $_GET['id'];
        $this->order_product    = OrderProduct::where('product_id', $this->productId)->get();
        return response()->json($this->order_product);
    }

    public function my_orders()
    {
        if (Auth::check()) {
            $orders = Order::where('customer_id', Auth::id())->get();
            return view('pages.customer.orders', compact('orders'));
        }
        else{
            return redirect()->route('index');
        }
    }

    public function my_wishlist()
    {
        if (Auth::check()) {
            $wishlists = Wishlist::where('customer_id', Auth::id())->get();
            return view('pages.customer.wishlist', compact('wishlists'));
        }
        else{
            Alert::error('Login first', '');
            return back();
        }
    }

    public function my_account()
    {
        if (Auth::check()) {
            if(Auth::user()->user_type == 'vendor'){
                return redirect()->route('vendor.desboard');
            }
            if (Auth::user()->type == 1) {
                return redirect()->route('home');
            }
            else{
                $orders = Order::where('customer_id', Auth::id())->get();
                $wishlists = Wishlist::where('customer_id', Auth::id())->get();
                return view('pages.customer.account', compact('orders', 'wishlists'));
            }
        }
        else{
            return redirect()->route('index');
        }
    }
    public function customer_account_update(Request $request, $id)
    {
        $customer = User::find($id);
        if (!is_null($customer)) {
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->address = $request->address;

            // image save
            if ($request->image){
                $image = $request->file('image');
                $img = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/customer/'. $img);
                Image::make($image)->save($location);
                $customer->image = $img;
            }

            // NID save
            if ($request->nid){
                $nid = $request->file('nid');
                $img = time() . '.' . $nid->getClientOriginalExtension();
                $location = public_path('images/customer/nid/'. $img);
                Image::make($nid)->save($location);
                $customer->nid = $img;
            }

            $customer->save();
            Alert::success('Profile Updated!', '');
            return back();
        }
        else{
            Alert::error('Something went wrong!', '');
            return back();
        }
    }

    public function change_password(Request $request)
    {
        $user = Auth::user();
        $c_password = $request->c_password;
        $n_password = $request->n_password;
        $cf_password = $request->cf_password;
        //dd(Hash::make($c_password));
        if (Hash::check($request->c_password, $user->password)) {
            if ($n_password == $cf_password) {
                $user->password = Hash::make($n_password);
                $user->save();
                Alert::success('Password has been updated', '');
                return back();
            }
            else {
                Alert::error('Password do not match !', '');
                return back();
            }
        }
        else{
            Alert::error('Your current password is wrong !', '');
            return back();
        }
    }

    public function my_wallet()
    {
        if (Auth::check()) {
            if (Auth::user()->type == 1) {
                return redirect()->route('home');
            }
            else{
                $wallet = Wallet::where('customer_id', Auth::id())->first();
                return view('pages.customer.wallet', compact('wallet'));
            }
        }
        else{
            return redirect()->route('index');
        }
    }

    public function refund()
    {
        if (Auth::check()) {
            $orders = Order::where('customer_id', Auth::id())->get();
            $product_refunds = ProductRefund::all();
            return view('pages.customer.refund', compact('orders', 'product_refunds'));
        }
        else{
            return redirect()->route('index');
        }
    }


    public function refund_request()
    {
        if (Auth::check()) {
            $orders = Order::where('customer_id', Auth::id())->get();
            return view('pages.customer.refund-request', compact('orders'));
        }
        else{
            return redirect()->route('index');
        }
    }
    public function refund_request_faruk($id)
    {
        if (Auth::check()) {
            $order = Order::find($id);
            return view('pages.customer.refund-request-faruk', compact('order'));
        }
        else{
            return redirect()->route('index');
        }
    }
    public function refund_return_search(Request $request)
    {
        $order = Order::where('code',$request->order_number)->first();

        $orderProduct = OrderProduct::where('order_id',$order->id)->first();
        return view('pages.customer.refund-request-faruk', compact('orderProduct'));

    }
    public function refund_return(Request $request)
    {
        $refund = new ProductRefund();
        $refund->user_id = $request->user_id;
        $refund->order_number = $request->order_number;
        $refund->type = $request->type;
        $refund->product_id = implode(',' , $request->product_id);
        $refund->refund_getway = $request->refund_getway;
        $refund->account_no = $request->account_no;
        $refund->cause = $request->cause;
        $refund->save();
        Alert::success('Refund and return request successfull!');
        return back();
    }

    public function my_wallet_point_convert(Request $request)
    {
        if (Auth::check()) {
            $validatedData = $request->validate([
                'point' => 'required|numeric',
            ]);
            //dd($request->all());

            $wallet = Wallet::where('customer_id', Auth::id())->first();
            if (!is_null($wallet)) {
                $point = $request->point;
                $minimum_point = $request->minimum_point;
                if ($point >= $minimum_point) {
                    $entry = new WalletEntry;
                    $entry->wallet_id = $wallet->id;
                    $entry->point_out = $point;
                    $entry->cash_in = $point/$minimum_point;
                    $entry->note = 'Point Conversion';
                    $entry->save();
                    Alert::success('Point Conversion Successful!');
                    return back();
                }
                else{
                    Alert::error('Minimum Point Not Matched');
                    return back();
                }
            }
            else{
                Alert::error('Walet Not Found!');
                return back();
            }
        }
        else{
            return redirect()->route('index');
        }
    }

    // Affliate Request Submit
    public function affiliate_apply()
    {
        $customer = User::find(Auth::id());
        $customer->affiliate_applied = 1;
        $customer->save();
        Alert::success('Your application is pending for admin approval');
        return back();
    }

    public function affiliate_dashboard()
    {
        if (Auth::check()) {
            $orders = Order::where('referral_id', Auth::id())->get();
            $referrals = User::where('referral_id', Auth::id())->get();
            $payments = Payment::where('customer_id', Auth::id())->orderBy('id', 'DESC')->get();
            $coupons = Coupon::where('affiliate_id', Auth::id())->get();
            return view('pages.customer.affiliate-dashboard', compact('orders', 'referrals', 'payments', 'coupons'));
        }
        else{
            return redirect()->route('index');
        }
    }

    public function payment_request(Request $request)
    {
        if (Auth::check()) {
            $validatedData = $request->validate([
                    'request_amount' => 'required|numeric',
                ]);
            $payment = new Payment;
            $payment->customer_id = Auth::id();
            $payment->request_amount = $request->request_amount;
            $payment->note = 'Payment Requested';
            $payment->save();
            Alert::success('Your payment request has been submitted');
            return back();
        }
        else{
            return redirect()->route('index');
        }
    }

    public function coupone_store(Request $request)
    {
        if (Auth::check()) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:255',
                'discount' => 'required|numeric',
                'coupon_type' => 'required|string',
                'valid_to' => 'required|date',
            ]);
            $coupon = new Coupon;
            $coupon->name = $request->name;
            $coupon->code = $request->code;
            if ($request->coupon_type == 'percent') {
                $coupon->discount = $request->discount;
            }
            if ($request->coupon_type == 'flat') {
                $coupon->amount = $request->discount;
            }
            $coupon->valid_from = date('Y-m-d');
            $coupon->valid_to = $request->valid_to;
            if ($request->has('single_use')) {
                $coupon->single_use = 1;
            }
            $coupon->affiliate_id = Auth::id();

            $coupon->save();

            Alert::success('Coupon Added Successfully');
            return back();
        }
        else{
            return redirect()->route('index');
        }
    }

    public function coupone_update(Request $request, $id)
    {
        if (Auth::user()->type == 2) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:255',
                'discount' => 'required|numeric',
                'valid_to' => 'required|date',
            ]);
            $coupon = Coupon::find($id);
            if (!is_null($coupon)) {
                $coupon->name = $request->name;
                $coupon->code = $request->code;
                $coupon->discount = $request->discount;
                $coupon->valid_to = $request->valid_to;
                if ($request->coupon_type == 'percent') {
                    $coupon->discount = $request->discount;
                    $coupon->amount = NULL;
                }
                if ($request->coupon_type == 'flat') {
                    $coupon->amount = $request->discount;
                    $coupon->discount = NULL;
                }
                $coupon->save();

                Alert::success('Coupon updated Successfully');
                return back();
            }
            else {
                session()->flash('error','Something went wrong!');
                return back();
            }
        }
    }

    public function coupone_delete($id)
    {
        if (Auth::user()->type == 2) {
            $coupon = Coupon::find($id);
            if (!is_null($coupon)) {
                $coupon->delete();
                Alert::success('Coupon has been deleted');
                return back();
            }
            else {
                Alert::error('Something went wrong!');
                return back();
            }
        }
        else {
            Alert::error('Something went wrong!');
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }

    public function generateUniqueCode()
    {

        $characters = '0123456789';
        $charactersNumber = strlen($characters);
        $codeLength = 6;

        $code = '';

        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }
        $code = date('y').'-'.$code;

        if (Order::where('code', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;

    }
    public function order_create(Request $request)
    {
        $order = new Order;
        $order->code = $this->generateUniqueCode();
        if (Auth::user()) {
            $order->customer_id = Auth::id();
            $order->vendor_id = Auth::id();
        }

        $discount = 0;
        if (Session::has('coupon_discount')) {
            $discount = Session::get('coupon_discount');
        }

        $order->price = Cart::subtotal() - $discount;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->district_id = $request->district_id;
        $order->division_id = $request->division_id;
        $order->shipping_address = $request->shipping_address;
        $order->payment_method = $request->payment_method;
        if ($request->payment_method == 'online') {
            https://localhost/tester/payment_caller.php
            $url = 'http://45.251.57.195/leopayment/api/marchant/merchant_receiver.php';
            $merchant_id = 231001;
            $merchant_key = "toll_1234";
            $cur_random_value = rand(000, 999);
            $transaction_id = "TOLL" . date('y') . date('m') . date('d') . $cur_random_value;
            $amount = 10;
            $transaction_date = date("Y-m-d H:i:s");

            $data = array(
                'merchant_id' => "$merchant_id",
                'merchant_key' => "$merchant_key",
                'transaction_id' => "$transaction_id",
                'amount' => "$amount"
            );
            // var_dump($data);
            // exit();
            echo "<br/>";
            echo "<br/>";
            echo "<br/>";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, ["msg" => json_encode($data)]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            echo $result = curl_exec($ch);
            //$url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));
            curl_close($ch);
        }
        $order->save();

        foreach (Cart::content() as $cart) {
            $order_product = new OrderProduct;
            $order_product->order_id = $order->id;
            $order_product->order_code = $order->code;
            $order_product->product_id = $cart->id;
            $order_product->price = $cart->price;
            $order_product->order_qty = $cart->qty;
            $order_product->save();

            Cart::remove($cart->rowId);
        }

        // if (!is_null($request->email)) {
        //     Mail::send(new OrderMail($order));
        // }

        Session::forget('coupon_discount');
        return redirect()->route('order.complete', $order->id);
    }
    public function order_complete($id)
    {
        $order = Order::find($id);
        if (!is_null($order)) {
            return view('pages.order-complete', compact('order'));
        }
        else{
            session()->flash('error','Page Not Found');
            return back();
        }
    }
    public function order_track()
    {
        return view('pages.track-order');
    }
    public function order_track_result(Request $request)
    {
        $code = $request->code;
        $order = Order::where('code', $code)->first();
        if (!is_null($order)) {
            return view('pages.track-order-result', compact('order'));
        }
        else{
            session()->flash('error','Page Not Found');
            return back();
        }
    }
    // customer profile
    public function my_profile(){
        if (Auth::check()) {
            $user = Auth::user();
            return view('pages.customer.profile', compact('user'));
        }
        else{
            return redirect()->route('index');
        }
    }
    // customer profile update
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
        	return redirect()->route('customer.profile.update');
    	}
    }
     //search raw material
     public function rawmaterialsearch(Request $request) {
        $output = '';
        $product_search_code = $request->product_search_code;
          $products =DB::table('order_products')
          ->join('orders', 'orders.id', '=', 'order_products.order_id')
          ->Join('products', 'products.id', '=', 'order_products.product_id')
          ->where('order_code',$request->product_search_code)
          ->select('orders.*', 'order_products.*', 'products.*')
                            ->limit(10)
                            ->get(['order_code', 'id']);
          if(!empty($product_search_code)) {
              if(count($products) > 0) {
                $output .= '<table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($products as $product) {
                    $output.='<tr>'.
                    '<td>
                    ' .$product->title.'
                       </td>'.
                    '<td>
                 ' .$product->order_qty.'
                    </td>'.
                    '<td>
                    ' .$product->price.'
                       </td>'.
                    '<td>  <button type="button" onclick="setMember('.$product->id.',\''.$product->title.'\', \''.$product->order_qty.'\', \''.$product->price.'\')" class="mt-2 btn btn-success btn-sm btn-block btn-rounded">Select</button></td>'.

                        '</tr>';
                    }
                $output .= '</tbody>
            </table>';
              }
              else {
                $output.='<div colspan="6" class="text-center"><h2>No Result Found</h2></div>';
            }
        }
        return Response($output);
    }
}
