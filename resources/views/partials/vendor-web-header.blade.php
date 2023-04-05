<style>
    ul.typeahead.dropdown-menu li {
            padding: 2px 0px;
            font-size: 11px!important;
            text-align:left;margin-bottom: 0.8rem!important;font-size: 1.5rem!important; font-weight: 500!important;display: -webkit-box;
            -webkit-box-orient: vertical!important;
            -webkit-line-clamp:2!important;
            overflow: hidden;width:87%;
            text-overflow: ellipsis;"
        }
    @media only screen and (max-width: 800px) {
      .header-top #header-right #sing-in-a{
        margin-left: 0px !important;
      }
    }
</style>
<header class="header">
    <div class="header-top" style="background-color: #7f00ff;">
        <div class="container">
            <div class="header-left">
                <div class="row">
                    <div class="col-md-12">
                        <span class="w-icon-call"><a href="tel:#" style="text-decoration: none;">+88{{$business->phone}}</a></span>
                    </div>
                </div>

                <div class="row d-none d-md-flex" style="margin-left: 10px">
                    <div class="col-md-12">
                        <span class="w-icon-envelop3"> <a href="mailto:#" style="text-decoration: none;">{{$business->email}}</a></span>
                    </div>
                </div>
            </div>
            <div class="header-right" id="header-right">
                <a href="{{ route('contact') }}" class="d-lg-show float-right" style="text-decoration: none; font-size: 15px">Complain Box</a>
                <!-- <span class="divider d-lg-show"></span> -->
                <!-- <a href="blog.html" class="d-lg-show">Blog</a> -->
                <a href="{{ route('contact') }}" class="d-lg-show" style="text-decoration: none;"><i class="w-icon-facebook"></i></a>
                <a href="{{ route('vendor.desboard') }}" class="" style="text-decoration: none;"><i class="w-icon-twitter"></i></a>
                <a href="{{ route('home') }}" class="" style="text-decoration: none;"><i class="w-icon-instagram"></i></a>
                <a href="{{ route('customer.account') }}" class="" style="text-decoration: none;"><i class="w-icon-youtube-solid"></i></a>
            </div>
        </div>
    </div>
{{--    <a href="{{ route('contact') }}" class="d-lg-show">Contact Us</a>--}}
{{--    @if(Auth::check())--}}
{{--        @php--}}
{{--            $users=Auth::user();--}}
{{--        @endphp--}}
{{--        @if(Auth::user()->type == 2)--}}
{{--            <a href="{{ route('vendor.desboard') }}" class="">Vendor Account</a>--}}
{{--            <a href="{{ route('logout') }}" class=""--}}
{{--               onclick="event.preventDefault();--}}
{{--                               document.getElementById('logout-form').submit();">Logout</a>--}}
{{--        @elseif(Auth::user()->type == 1)--}}
{{--            <a href="{{ route('home') }}" class="">Admin Account</a>--}}
{{--            <a href="{{ route('logout') }}" class=""--}}
{{--               onclick="event.preventDefault();--}}
{{--                               document.getElementById('logout-form').submit();">Logout</a>--}}
{{--        @else--}}
{{--            <a href="{{ route('customer.account') }}" class="">Customer Account</a>--}}
{{--            <a href="{{ route('logout') }}" class=""--}}
{{--               onclick="event.preventDefault();--}}
{{--                               document.getElementById('logout-form').submit();">Logout</a>--}}
{{--        @endif--}}
{{--    @else--}}
{{--        <a id="sing-in-a" href="{{ route('login') }}" class=""><i--}}
{{--                class="w-icon-account"></i>Sign In</a>--}}
{{--        <span class="delimiter d-lg-show">/</span>--}}
{{--        <a href="{{ route('register') }}" class="header_right_a ml-0">Register</a>--}}
{{--    @endif--}}
{{--    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--        @csrf--}}
{{--    </form>--}}
    <!-- End of Header Top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left mr-md-4 ">
                <a href="#" class="mobile-menu-toggle  w-icon-hamburger" style="text-decoration: none;">
                </a>
                <a href="{{ route('index') }}" class="logo ml-lg-0 " style="text-decoration: none;">
                    <img src="{{ asset('images/website/'.$business->logo) }}" alt="logo" width="144" height="45" />
                </a>
                <form method="get" action="{{ route('search.result') }}" class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper" style="border-left: 2px solid #336699;" autocomplete="off">
                    @csrf

                    <input type="text" class="form-control" name="search" id="search" placeholder="Search in..." required />
                    <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                    </button>
                </form>
            </div>
            <div class="header-right ml-4">
{{--                <div class="header-call d-xs-show d-lg-flex align-items-center">--}}
{{--                    <a href="tel:#" class="w-icon-call"></a>--}}
{{--                    <div class="call-info d-lg-show">--}}
{{--                        <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">--}}
{{--                            <a href="mailto:#" class="text-capitalize">Live Chat</a> or :</h4>--}}
{{--                        <a href="tel:#" class="phone-number font-weight-bolder ls-50">{{ $business->phone }}</a>--}}
{{--                    </div>--}}
{{--                    --}}
{{--                </div>--}}
                @if(Auth::check())
                    @php
                        $users=Auth::user();
                    @endphp
                    @if(Auth::user()->user_type == 'vendor')
                        <div class="header-call">
                            <h5 class="mb-0"> <i class="w-icon-account"></i>  <a href="{{ route('vendor.desboard') }}" class="" style="text-decoration: none;">Vendor Account</a></h5>
                        </div>
                            <h5 class="mb-0"> <i class="w-icon-logout"></i> <a href="{{ route('logout') }}" class=""
                                                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();" style="text-decoration: none;">Logout</a></h5>
                    @elseif(Auth::user()->type == 1)
                        <div class="header-call">
                        <h5 class="mb-0"> <i class="w-icon-account"></i> <a href="{{ route('home') }}" class="" style="text-decoration: none;">Admin Account</a></h5>
                        </div>
                        <h5 class="mb-0"><i class="w-icon-logout"></i> <a href="{{ route('logout') }}" class=""
                                            onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();" style="text-decoration: none;">Logout</a></h5>
                    @else
                        <div class="header-call">
                        <h5 class="mb-0"> <i class="w-icon-account"></i> <a href="{{ route('customer.account') }}" class="" style="text-decoration: none;">Customer Account</a></h5>
                        </div>
                        <h5 class="mb-0"><i class="w-icon-logout"></i> <a href="{{ route('logout') }}" class=""
                                            onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();" style="text-decoration: none;">Logout</a></h5>
                    @endif
                @else
                    <div class="header-call d-none d-md-flex">
                   <h5 class="mb-0"> <a id="sing-in-a" href="{{ route('login') }}" class="" style="text-decoration: none;">
                           <i class="w-icon-account"></i>Sign In</a></h5>
                    </div>
                    <h5 class="mb-0 d-none d-md-flex"> <i class="w-icon-account"></i> <a href="{{ route('register') }}" class="header_right_a ml-0" style="text-decoration: none;">Register</a></h5>
                @endif
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>


                <!-- <a class="compare label-down link d-xs-show" href="compare.html">
                    <i class="w-icon-compare"></i>
                    <span class="compare-label d-lg-show">Compare</span>
                </a> -->
                <!-- <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                    <div class="cart-overlay"></div>
                    <a href="#" class="cart-toggle label-down link">
                        <i class="w-icon-cart">
                            <span class="cart-count" id="total_count">{{ Cart::count() }}</span>
                        </i>
                        <span class="cart-label">Cart</span>
                    </a>
                    <div class="dropdown-box">
                        <div class="cart-header">
                            <span>Shopping Cart</span>
                            <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
                        </div>

                        <div class="products" id="cart_sidebar">
                            @foreach(Cart::content() as $cart)
                            <div class="product product-cart">
                                <div class="product-detail">
                                    <a href="{{ route('single.product', [$cart->id, Str::slug($cart->name)]) }}" class="product-name">{{ $cart->name }}</a>
                                    <div class="price-box">
                                        <span class="product-quantity">{{ $cart->qty }}</span>
                                        <span class="product-price">{{ env('CURRENCY') }}{{ $cart->price }} {{ env('UAE_CURRENCY') }}</span>
                                    </div>
                                </div>
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="{{ asset('images/product/'. $cart->options->image) }}" alt="product" height="84"
                                            width="94" />
                                    </a>
                                </figure>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="rowId" value="{{ $cart->rowId }}">
                                    <button type="submit" class="btn btn-link btn-close"><i
                                        class="fas fa-times"></i></button>
                                </form>
                            </div>
                            @endforeach
                        </div>

                        <div class="cart-total">
                            <label>Subtotal:</label>
                            <span class="price" id="cart_sidebar_total">{{ env('CURRENCY') }}{{ Cart::subtotal() }} {{ env('UAE_CURRENCY') }}</span>
                        </div>

                        <div class="cart-action">
                            <a href="{{ route('carts') }}" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                            <a href="{{ route('checkout') }}" class="btn btn-primary  btn-rounded">Checkout</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- End of Header Middle -->

    <div class="header-bottom sticky-content fix-top sticky-header has-dropdown">
        <div class="container">
            <div class="inner-wrap">
                <div class="header-left">
                    @include('partials.category-nav')
                    @include('partials.vendor-nav')
                </div>
                <div class="header-right">
                    <a href="{{ route('order.track') }}" style="text-decoration: none;" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                    <!-- <a href="#"><i class="w-icon-sale"></i>Daily Deals</a> -->
                    <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                    <div class="cart-overlay"></div>
                    <a href="#" class="cart-toggle label-down link" style="text-decoration: none;">
                        <i class="w-icon-cart">
                            <span class="cart-count" id="total_count">{{ Cart::count() }}</span>
                        </i>
                        <!-- <span class="cart-label">Cart</span> -->
                    </a>
                    <div class="dropdown-box">
                        <div class="cart-header">
                            <span>Shopping Cart</span>
                            <a href="#" class="btn-close" style="text-decoration: none;">Close<i class="w-icon-long-arrow-right"></i></a>
                        </div>

                        <div class="products" id="cart_sidebar">
                            @foreach(Cart::content() as $cart)
                            <div class="product product-cart">
                                <div class="product-detail">
                                    <a href="{{ route('single.product', [$cart->id, Str::slug($cart->name)]) }}" class="product-name" style="text-decoration: none;">{{ $cart->name }}</a>
                                    <div class="price-box">
                                        <span class="product-quantity">{{ $cart->qty }}</span>
                                        <span class="product-price">{{ env('CURRENCY') }}{{ $cart->price }} {{ env('UAE_CURRENCY') }}</span>
                                    </div>
                                </div>
                                <figure class="product-media">
                                    <a href="{{ route('single.product', [$cart->id, Str::slug($cart->title)]) }}" style="text-decoration: none;">
                                        <img src="{{ asset('images/product/'. $cart->options->image) }}" alt="product" height="84"
                                            width="94" />
                                    </a>
                                </figure>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="rowId" value="{{ $cart->rowId }}">
                                    <button type="submit" class="btn btn-link btn-close"><i
                                        class="fas fa-times"></i></button>
                                </form>
                            </div>
                            @endforeach
                        </div>


                        <div class="cart-total">
                            <label>Subtotal:</label>
                            <span class="price" id="cart_sidebar_total">{{ env('CURRENCY') }}{{ Cart::subtotal() }} {{ env('UAE_CURRENCY') }}</span>
                        </div>

                        <div class="cart-action">
                            <a href="{{ route('carts') }}" class="btn btn-dark btn-outline btn-rounded" style="text-decoration: none;">View Cart</a>
                            <a href="{{ route('checkout') }}" class="btn btn-primary  btn-rounded" style="text-decoration: none;">Checkout</a>
                        </div>
                    </div>
                </div>
                    <div class=" cart-offcanvas ml-5 mr-lg-2">
                    <div class="cart-overlay"></div>
                        <a class="wishlist label-down link d-xs-show" href="{{ route('customer.wishlist') }}" style="text-decoration: none;">
                            <i class="w-icon-heart">
                                @if(Auth::check())
                                    @php
                                        $wishlists = App\Models\Wishlist::where('customer_id', Auth::id())->get();
                                    @endphp
                                    <sup>{{ count($wishlists) }}</sup>
                                @endif
                            </i>
                        </a>
                </div>
                </div>
            </div>
        </div>
    </div>
</header>
