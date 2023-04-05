@extends('layouts.master')

@section('title')
	{{ 'Shopping Cart' . ' | '. env('APP_NAME') }}
@endsection
@php
    $discount = 0;
    if(Session::has('coupon_discount')){
        $discount = Session::get('coupon_discount');
    }
@endphp
@section('style')
    <style type="text/css">
        input.form-control{
            border: 0.5px solid #000;
        }

        .my-button {
            height: 10%;
            font-size: 1.2rem;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            background-color: #98a8bb75;;
            color: #fff;
        }
    </style>
@endsection

@section('content')

    <style>
        input,
        textarea {
            border: 1px solid #eeeeee;
            box-sizing: border-box;
            margin: 0;
            outline: none;
            padding: 10px;
        }

        input[type="button"] {
            -webkit-appearance: button;
            cursor: pointer;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .input-group {
            clear: both;
            margin: 16px 2px;
            position: relative;
        }

        .input-group input[type='button'] {
            background-color: #eeeeee;
            min-width: 38px;
            width: auto;
            transition: all 300ms ease;
        }

        .input-group .button-minus,
        .input-group .button-plus {
            font-weight: bold;
            height: 38px;
            padding: 0;
            width: 38px;
            position: relative;
        }

        .input-group .quantity-field {
            position: relative;
            height: 38px;
            left: -6px;
            text-align: center;
            width: 44px;
            display: inline-block;
            font-size: 20px;
            margin: 0 0 5px;
            resize: vertical;
        }
        .faruk_qty{
            font-size: 23px;
        }
        .button-plus {
            left: -13px;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            -webkit-appearance: none;
        }
    
            #table_two{
                display: none!important;
            }
            #retunt_cart_mobile{
                display: none!important;
            }
        
        @media (max-width: 767px){
            .table_one{
                display: none!important;
            }
            .retunt_cart{
                display: none!important;
            }
            #retunt_cart_mobile{
                display: block!important;
            }
            #table_two{
                display: block!important;
            }
            .faruk_qty{
              
            }
            /* ----------------------- */
            input,
        textarea {
            border: 1px solid #eeeeee;
            box-sizing: border-box;
            margin: 0;
            outline: none;
            padding: 10px;
        }

        input[type="button"] {
            -webkit-appearance: button;
            cursor: pointer;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .input-group {
            clear: both;
            margin: 6px 14px;
            position: relative;
        }

        .input-group input[type='button'] {
            background-color: #eeeeee;
            min-width: 38px;
            width: auto;
            transition: all 300ms ease;
        }

        .input-group .button-minus,
        .input-group .button-plus {
            font-weight: bold;
            height: 22px;
            padding: 0;
            width: 28px;
            position: relative;
        }

        .input-group .quantity-field {
            position: relative;
            height: 18px;
            left: -6px;
            text-align: center;
            width: 34px;
            display: inline-block;
            font-size: 16px;
            margin: 0 0 5px;
            resize: vertical;
        }
        .faruk_qty{
            font-size: 16px;
        }
        .button-plus {
            left: -13px;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            -webkit-appearance: none;
        }
            
        }
    </style>
    <!-- Start of Main -->
        <main class="main cart">
            @if(count($carts) > 0)
            <!-- Start of Breadcrumb -->
            <div class="breadcrumb-nav">
                <div class="container">
                    <div class="breadcrumb shop-breadcrumb bb-no retunt_cart">
                        <li class="active">Shopping Cart</li>
                        <li>Checkout</li>
                        <li>Order Complete</li>
                    </div>
                    <div class="breadcrumb shop-breadcrumb bb-no" id="retunt_cart_mobile" style="background-color:#3F48CC  !important;">
                        <a style="font-size: 20px;
                        margin-left: 6%; color:#fff" href="" class="btn-icon-left"><i class="w-icon-long-arrow-left"></i> Cart</a>
                    </div>
                </div>
            </div>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg mb-4">
                        <div class="col-lg-12 pr-lg-12">
                            <table class="table-bordered shop-table cart-table table-responsive table_one">
                                <thead>
                                    <tr>
                                        <th class="product-list-in-card" style="width: 5%"><span>Sl No.</span></th>
                                        <th class="product-name" style="width: 15%"><span>Product Name</span></th>
                                        <th class="product-thumbnail" style="width: 15%"><span>Image</span></th>
                                        <th class="product-color-swatch" style="width: 5%"><span>Color</span></th>
                                        <th class="product-size-swatch" style="width: 5%"><span>Size</span></th>
                                        <th class="product-quantity"><span>Quantity</span></th>
                                        <th class="product-price" style="width: 5%"><span>Rate</span></th>
                                        <th class="product-subtotal" style=""><span>Total</span></th>
                                        <th class="product-subtotal" style=""><span>Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($carts as $cart)
                                    <tr>
                                        <td class="product-list-in-card new_btn text-center">{{$loop->iteration}}</td>
                                        <td class="product-name">
                                            <a href="{{ route('single.product', [$cart->id, Str::slug($cart->name)]) }}">
                                                {{ $cart->name }}
                                            </a>
                                        </td>
                                        <td class="product-thumbnail">
                                            <a href="{{ route('single.product', [$cart->id, Str::slug($cart->name)]) }}">
                                                <figure>
                                                    <img src="{{ asset($cart->options->image) }}" alt="{{ $cart->name }}" style="width: 80%">
                                                </figure>
                                            </a>
                                        </td>
                                        <td class="product-color-swatch">
                                            {{$cart->options->color_name}}
                                        </td>
                                        <td class="product-size-swatch">
                                            {{$cart->options->size}}
                                        </td>
                                        <td class="product-quantity">

                                            <form action="{{ route('cart.update') }}" method="POST" id="update">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="button" value="-" onclick="quickViewQunatityIncr(event);event.preventDefault(); document.getElementById('update').submit();" class="button-minus faruk_qty" data-field="quantity">
                                                    <input type="text" step="1" readonly name="qty" value="{{ $cart->qty }}" class="quantity-field">
                                                    <input type="button" value="+" onclick="quickViewQunatityIncr(event);event.preventDefault(); document.getElementById('update').submit();" class="button-plus faruk_qty" data-field="quantity">
                                                </div>
                                                <input type="hidden" name="rowId" value="{{ $cart->rowId }}">

                                            </form>
                                        </td>
                                        <td class="product-price"><span class="amount">&#2547; {{ number_format($cart->price) }}</span></td>
                                        <td class="product-subtotal">
                                            <span>&#2547; {{number_format($cart->price * $cart->qty)}}</span>
                                        </td>
                                        <td class="product-size-swatch">
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="rowId" value="{{ $cart->rowId }}">
                                                <button type="submit"><i class="fas fa-times faruk_cross"></i>&nbsp;Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div id="table_two">
                                <div>
                                    @foreach($carts as $cart)

                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <a href="{{ route('single.product', [$cart->id, Str::slug($cart->name)]) }}">
                                                        <figure>
                                                            <img src="{{ asset($cart->options->image) }}" alt="{{ $cart->name }}" style="width:14%;
                                                            margin-top: -10px;">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <div class="col-lg-6" style="margin-left:13%;margin-top: -12%;">
                                                    @php
                                                    $truncated = \Illuminate\Support\Str::limit($cart->name, 20, '....');
                                                    @endphp
                                                    <h6><a href="{{ route('single.product', [$cart->id, Str::slug($cart->name)]) }}">
                                                        {{ $truncated }}
                                                    </a></h6>
                                                    @if($cart->options->color_name == true)
                                                    <p>Color : {{$cart->options->color_name}}</p>
                                                    @endif
                                                    @if($cart->options->size == true)
                                                    <p> Size : {{$cart->options->size}}</p>
                                                    @endif
                                                   
                                                    <h6>Price : &#2547; {{ number_format($cart->price) }}</h6>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4" style="margin-left: 60%;
                                        margin-top: -21%;">
                                           <div>
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="rowId" value="{{ $cart->rowId }}">
                                                <button style="margin-left: 72%;margin-top: -1px;
                                                border-radius: 66px;
                                                background: #fdfbfb00;" type="submit"><i class="fas fa-times faruk_cross"></i></button>
                                            </form>
                                           </div>
                                            <div class="product-quantity">

                                                <form action="{{ route('cart.update') }}" method="POST" id="update">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="button" value="-" onclick="quickViewQunatityIncr(event);event.preventDefault(); document.getElementById('update').submit();" class="button-minus faruk_qty" data-field="quantity">
                                                        <input type="text" step="1" readonly name="qty" value="{{ $cart->qty }}" class="quantity-field">
                                                        <input type="button" value="+" onclick="quickViewQunatityIncr(event);event.preventDefault(); document.getElementById('update').submit();" class="button-plus faruk_qty" data-field="quantity">
                                                    </div>
                                                    <input type="hidden" name="rowId" value="{{ $cart->rowId }}">
    
                                                </form>
                                            </div>
                                            <div>
                                                <span style="margin-left: 56%;">&#2547; {{number_format($cart->price * $cart->qty)}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="cart-action">
                            <a href="{{ route('products') }}" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"style="color:#fff;background-color:#3F48CC !important;margin-left: 5%;"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                            <!-- <button type="submit" class="btn btn-rounded btn-default btn-clear" name="clear_cart" value="Clear Cart">Clear Cart</button>
                            <button type="submit" class="btn btn-rounded btn-update disabled" name="update_cart" value="Update Cart">Update Cart</button> -->
                        </div>
                    </div>
                    <hr style="border: solid grey 1px"/>
                    <div class="row">
                        <div class="col-lg-8">

                        <!-- @if(Session::has('coupon_discount'))
                            <form action="{{ route('coupon.remove') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark btn-outline btn-rounded">Remove Coupon</button>
                            </form>
                            @endif -->
                        </div>
                        <div class="col-lg-4">
                            <div class="cart-summary mb-4" style="border: solid grey 0.5px;">
                                <div class="cart-subtotal d-flex align-items-center justify-content-between mb-2">
                                    <label class="ls-25">Subtotal: </label>
                                    <span> &#2547; {{ number_format(Cart::subtotal()) }}</span>
                                </div>
                                @php($subTotal = (Cart::subtotal()*15)/100)
                                <div class="cart-subtotal d-flex align-items-center justify-content-between mb-2">
                                    <label class="ls-25">Tax <small>(included tax 15%)</small> : </label>
                                    <span> &#2547; {{ number_format($subTotal)}}</span>
                                </div>
                                <div class="cart-subtotal d-flex align-items-center justify-content-between mb-2">
                                    <label class="ls-25">Shipping Cost: </label>
                                    <span> &#2547; 0</span>
                                </div>
                                @if(Session::has('coupon_discount'))
                                    <div class="cart-subtotal d-flex align-items-center justify-content-between mb-2">
                                        <label class="ls-25">Discount: </label>
                                        <span> &#2547; {{ Session::get('coupon_discount') }}</span>
                                    </div>
                                @endif
                                <div class="order-total d-flex justify-content-between align-items-center mb-2">
                                    <label>Total: </label>
                                    <span class="ls-50"> &#2547; {{ number_format(Cart::subtotal() + $subTotal - $discount ) }}</span>
                                </div>
                            </div>
                            <a href="{{ route('checkout') }}" style="color:#fff;background-color:#3F48CC !important;"
                               class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
            @else
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg mb-10">
                        <h3 class="mt-4 text-center">Your Cart is Empty</h3>
                    </div>
                </div>
            </div>
            @endif
        </main>
        <!-- End of Main -->


@endsection

