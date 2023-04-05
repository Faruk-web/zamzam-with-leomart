<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
@if (Route::currentRouteName() == 'single.product')
        <div class="sticky-footer sticky-content fixed-bottom " style="background-color: transparent; margin-bottom: -3%;">
            <a href="{{route('carts')}}" class="sticky-link active btn" style="text-decoration: none; background-color: #00688B; color: #fffffc;  height: 45px; width: 2px;font-size: 0px;">
                <i class="bi bi-cart3" style="color: #fffffc;margin-top: 13%;margin-bottom: -4%;"></i>
                <p>Cart</p>
            </a>
            <a href="#" id="chat-btn" class="sticky-link btn" style="text-decoration: none; background-color: #43A5BE; color: #fffffc; height: 45px; width: 2px;font-size: 0px;">
                <i class="bi bi-chat-right-text" style="color: #fffffc;margin-top: 13%;margin-bottom: -4%;"></i>
                <p>Chat</p>
            </a>
            <a href="#" onclick="addToCart({{$product->id}})" class="sticky-link btn" style="text-decoration: none; background-color: #00A5F9; color: #fffffc;height: 45px;width: 110px;font-size: 12px;">
                <i class="bi bi-bag" style="color: #fffffc;margin-top: -7%;margin-bottom: -4%;"></i>
                <p>Add To Cart</p>
            </a>
            <a href="#" onclick="addToWishlist({{$product->id}})" class="sticky-link btn" style="text-decoration: none; background-color: #FF9A00; color: #fffffc;height: 45px;width: 110px;font-size: 12px;">
                <i class="bi bi-heart" style="color: #fffffc;margin-top: -7%;margin-bottom: -4%;"></i>
                <p>wishlist</p>
            </a>
        </div>
    @else
        <div class="sticky-footer sticky-content fixed-bottom " style="background-color: #7f00ff;">
            <a href="{{ route('index') }}" class="sticky-link active" style="text-decoration: none; color: #fffffc">
                <i class="bi bi-house" style="color: #fffffc;font-size: 2.3rem;"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('products') }}" class="sticky-link" style="text-decoration: none; color: #fffffc">
                <i class="bi bi-shop" style="color: #fffffc;font-size: 2.3rem;"></i>
                <span>Shop</span>
            </a>
            <a href="{{route('user.profile')}}" class="sticky-link" style="text-decoration: none; color: #fffffc">
                <i class="bi bi-person-fill" style="color: #fffffc;font-size: 2.3rem;"></i>
                <span>Account</span>
            </a>

            <div class="cart-dropdown dir-up">
                <a href="{{ route('carts') }}" class="sticky-link" style="text-decoration: none; color: #fffffc">
                    <i class="bi bi-bag-fill" style="color: #fffffc;font-size: 2.3rem;"><span class="cart-count" style="color: #fffffc" id="mobile_total_count">{{ Cart::count() }}</span></i>
                    <span>Cart</span>
                </a>
{{--                <div class="dropdown-box">--}}
{{--                    <div class="products">--}}
{{--                        <div class="product product-cart">--}}
{{--                            <div class="product-detail">--}}
{{--                                <h3 class="product-name">--}}
{{--                                    <a href="product-default.html">Beige knitted elas<br>tic--}}
{{--                                        runner shoes</a>--}}
{{--                                </h3>--}}
{{--                                <div class="price-box">--}}
{{--                                    <span class="product-quantity">1</span>--}}
{{--                                    <span class="product-price">$25.68</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <figure class="product-media">--}}
{{--                                <a href="#">--}}
{{--                                    <img src="assets/images/cart/product-1.jpg" alt="product" height="84" width="94" />--}}
{{--                                </a>--}}
{{--                            </figure>--}}
{{--                            <button class="btn btn-link btn-close">--}}
{{--                                <i class="fas fa-times"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}

{{--                        <div class="product product-cart">--}}
{{--                            <div class="product-detail">--}}
{{--                                <h3 class="product-name">--}}
{{--                                    <a href="https://www.portotheme.com/html/wolmart/product.html">Blue utility pina<br>fore--}}
{{--                                        denim dress</a>--}}
{{--                                </h3>--}}
{{--                                <div class="price-box">--}}
{{--                                    <span class="product-quantity">1</span>--}}
{{--                                    <span class="product-price">$32.99</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <figure class="product-media">--}}
{{--                                <a href="#">--}}
{{--                                    <img src="assets/images/cart/product-2.jpg" alt="product" width="84" height="94" />--}}
{{--                                </a>--}}
{{--                            </figure>--}}
{{--                            <button class="btn btn-link btn-close">--}}
{{--                                <i class="fas fa-times"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="cart-total">--}}
{{--                        <label>Subtotal:</label>--}}
{{--                        <span class="price">$58.67</span>--}}
{{--                    </div>--}}

{{--                    <div class="cart-action">--}}
{{--                        <a href="cart.html" class="btn btn-dark btn-outline btn-rounded">View Cart</a>--}}
{{--                        <a href="checkout.html" class="btn btn-primary  btn-rounded">Checkout</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!-- End of Dropdown Box -->
            </div>

            <div class="header-search hs-toggle dir-up">
                <a href="#" class="search-toggle sticky-link" style="text-decoration: none; color: #fffffc;">
                    <i class="bi bi-search" style="color: #fffffc;font-size: 2.3rem;"></i>
                    <span>Search</span>
                </a>
                <form action="{{ route('search.result') }}" class="input-wrapper">
                    <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                           required />
                    <button class="btn btn-search" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    @endif



