@extends('layouts.master')

@section('title')
	{{ 'Checkout' . ' | '. env('APP_NAME') }}
@endsection

@php
    $discount = 0;
    if(Session::has('coupon_discount')){
        $discount = Session::get('coupon_discount');
    }
@endphp

@section('style')
    <style type="text/css">
        .checkout input.form-control{
            border: 0.5px solid #000;
        }
        .checkout select.form-control {
            border: 0.5px solid #000;
        }
    </style>
@endsection

@section('content')

        <!-- Start of Main -->
        <main class="main checkout">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="passed">Shopping Cart</li>
                        <li class="active">Checkout</li>
                        <li>Order Complete</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->


            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <div class="mb-4">
                        Returning customer? <a href="{{ route('login') }}"
                            class="show-login font-weight-bold text-uppercase text-dark">Login</a>
                    </div>

                        <div class="row">
                            <div class="col-lg-7 pr-lg-4 mb-4">
                                <form action="{{ route('order.create') }}" method="post" id="placeOrderForm">
                                    @csrf
                                <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                    Shipping Address/Billing Address
                                </h3>

                                <div class="row gutter-sm">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>First Name <span style="color: red">*</span></label>
                                            <input type="text" class="form-control form-control-md" name="first_name" value="{{ optional(Auth::user())->first_name }}" placeholder="Enter first name" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Last Name <span style="color: red">*</span></label>
                                            <input type="text" class="form-control form-control-md" name="last_name" value="{{ optional(Auth::user())->last_name }}" placeholder="Enter last name" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Email <span style="color: red">*</span></label>
                                            <input type="email" class="form-control form-control-md" name="email" value="{{ optional(Auth::user())->email }}" placeholder="Enter your valid email " required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Mobile <span style="color: red">*</span></label>
                                            <input type="text" class="form-control form-control-md" name="phone" value="{{ optional(Auth::user())->phone }}" placeholder="Enter your mobile number" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label>Country *</label>
                                    <div class="select-box">
                                        <select name="country" class="form-control form-control-md">
                                            <option value="default" selected="selected">United States
                                                (US)
                                            </option>
                                            <option value="uk">United Kingdom (UK)</option>
                                            <option value="us">United States</option>
                                            <option value="fr">France</option>
                                            <option value="aus">Australia</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label>House No & name <span style="color: red">*</span></label>
                                    <input type="text" placeholder="House number and name" class="form-control form-control-md mb-2" name="house_no_and_name" value="{{ optional(Auth::user())->address }}" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country <span style="color: red">*</span></label>
                                            <select name="country_id" onchange="getDivision(this.value)" class="form-control @error('country') is-invalid @enderror" required>
                                                <option value="" selected disabled style="background-color: #5fa4cc; color: #0c525d">Please Chose country</option>
                                                @foreach($countries as $country)
                                                <option value="{{$country->id}}" {{$country->id == 18 ? 'selected' : ''}} style="background-color: #5fa4cc;color: #0c525d">{{$country->name}}</option>
                                                @endforeach

                                            </select>
                                            @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Division<span style="color: red">*</span></label>
                                            <select name="division_id" id="getDivisionId" onchange="getDistrict(this.value)" class="form-control @error('division_id') is-invalid @enderror" required>
                                                <option value="" selected disabled style="background-color: #5fa4cc; color: #0c525d">Please Chose a Division</option>
                                                @foreach($divisions as $item)
                                                    <option value="{{ $item->id }}" style="background-color: #5fa4cc; color: #0c525d">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('district_id')
                                            <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State/District<span style="color: red">*</span></label>
                                            <select name="district_id" id="getDistrictId" onchange="getThana(this.value)" class="form-control @error('district_id') is-invalid @enderror" required >
                                                <option value="" selected disabled >Please Chose a State/District</option>
                                            </select>
                                            @error('district_id')
                                            <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City/Thana <span style="color: red">*</span></label>
                                            <select name="thana_id" id="getThanaId" class="form-control @error('thana_id') is-invalid @enderror" required>
                                                <option value="" selected disabled>Please Chose a City/Thana</option>

                                            </select>
                                            @error('thana_id')
                                            <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Zip Code <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="zip_code" placeholder="Enter zip code">
                                            </select>
                                            @error('area_id')
                                            <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Village/Area <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="village_name" placeholder="Enter village/area"/>
                                            </select>
                                            @error('area_id')
                                            <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group mt-3">
                                    <label for="order-notes">Notes to seller (optional)</label>
                                    <textarea class="form-control mb-0" id="order-notes" name="order-notes" cols="30"
                                              rows="4"
                                              placeholder="Notes about your order, e.g special notes for delivery"></textarea>
                                </div>
                                </form>
                            </div>
                            <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                                <div class="order-summary-wrapper sticky-sidebar">
                                    <h3 class="title text-uppercase ls-10">Your Order</h3>
                                    <div class="order-summary">
                                        <table class="order-table">
                                            <thead>
                                            <tr>
                                                <th colspan="2">
                                                    <b>Product</b>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($carts as $cart)
                                                <tr class="bb-no">
                                                    <td class="product-name">{{ $cart->name }} <i
                                                            class="fas fa-times"></i> <span
                                                            class="product-quantity">{{ $cart->qty }}</span></td>
                                                    <td class="product-total">&#2547; {{ number_format($cart->qty * $cart->price) }} </td>
                                                </tr>
                                            @endforeach
                                            @php($subTotal = (Cart::subtotal() - $discount))
                                            <tr class="cart-subtotal bb-no">
                                                <td>
                                                    <b>Sub Total</b>
                                                </td>
                                                <td>
                                                    <b>&#2547; {{ number_format($subTotal) }} </b>
                                                </td>
                                            </tr>
                                            @php($tax = ( $subTotal *15)/100)
                                            <tr class="cart-taxtotal bb-no">
                                                <td>
                                                    <b>Tax <small>(included tax 15%)</small> :</b>
                                                </td>
                                                <td>
                                                    <b>&#2547; {{ number_format($tax) }} </b>
                                                </td>
                                            </tr>
                                            @if(Session::has('coupon_discount'))
                                                <tr class="cart-subtotal bb-no">
                                                    <td>
                                                        <b>Voucher/Coupon</b>
                                                    </td>
                                                    <td>
                                                        <p ><a href="{{route('coupon.remove')}}"><b style="color: #00cd5a">{{Session::get('coupon_code')}}</b></a>
                                                            <a href="{{route('coupon.remove')}}"><span aria-hidden="true" style="color: red" >&times;</span></a></p>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr class="cart-subtotal bb-no">
                                                    <td>
                                                        <b>Voucher</b>
                                                    </td>
                                                    <td>
                                                        <button onclick="toggleRow('voucher')"><i class="fa fa-arrow-right"></i></button>
                                                    </td>
                                                </tr>
                                                <tr data-rowname="voucher" style="display: none">
                                                    <td>
                                                        <form class="coupon"  action="{{ route('coupon.apply') }}" method="POST" id="applyForm">
                                                            @csrf
                                                            @foreach($vouchers as $voucher)
                                                                <button type="submit" class="btn btn-warning btn-sm" name="code" value="{{$voucher->code}}" >{{$voucher->code}}</button>
                                                            @endforeach
                                                            @if(Session::has('success'))
                                                                <p class="alert alert-success">{{ Session::get('success') }} </p>
                                                            @endif

                                                            @if(Session::has('invalid'))
                                                                <p class="alert alert-danger">{{ Session::get('invalid') }}</p>
                                                            @endif
                                                            @if(Session::has('coupon_discount'))
                                                                <a href="{{ route('coupon.remove') }}" class="btn btn-dark btn-outline btn-rounded">Remove Coupon</a>
                                                            @endif
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                            @if(Session::has('coupon_discount'))
                                            @else
                                                <tr class="cart-subtotal bb-no">
                                                    <td>
                                                        <b>Coupon</b>
                                                    </td>
                                                    <td>
                                                        <button onclick="toggleRow('coupon')"><i class="fa fa-arrow-right"></i></button>
                                                    </td>
                                                </tr>
                                                <tr data-rowname="coupon" style="display: none">
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-10">
                                                                        <form class="coupon"  action="{{ route('coupon.apply') }}" method="POST" id="applyForm">
                                                                            @csrf
                                                                            <input type="text" name="code" class="form-control" placeholder="Enter coupon code here" style="border: 0.5px solid #000;" />
                                                                            @if(Session::has('success'))
                                                                                <p class="alert alert-success">{{ Session::get('success') }} </p>
                                                                            @endif

                                                                            @if(Session::has('invalid'))
                                                                                <p class="alert alert-danger">{{ Session::get('invalid') }}</p>
                                                                            @endif
                                                                            @if(Session::has('coupon_discount'))
                                                                                <a href="{{ route('coupon.remove') }}" class="btn btn-dark btn-outline btn-rounded">Remove Coupon</a>
                                                                            @endif
                                                                        </form>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <button onclick="event.preventDefault(); document.getElementById('applyForm').submit();" class="btn btn-sm btn-dark btn-outline btn-rounded">Apply Coupon</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                            @php($grandTotal = $tax + $subTotal)

                                            <tr class="cart-subtotal bb-no">
                                                <td>
                                                    <b>Payable Amount</b>
                                                </td>
                                                <td>
                                                    <b>&#2547; {{ number_format($grandTotal) }} </b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><hr style="border: solid grey 0.5px"></td>
                                            </tr>
                                            <tr class="cart-subtotal bb-no">
                                                <td>
                                                    <b>Sub Total</b>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="price" value="{{round($grandTotal)}}" />
                                                    <b>&#2547; {{ number_format($grandTotal) }} </b>
                                                </td>
                                            </tr>

                                            </tbody>

                                        </table>

                                        <script>
                                            window.onload = function() {
                                                var rows = document.getElementsByTagName("tr");
                                                for (var i = 0; i < rows.length; i++) {
                                                    rows[i].style.display = "none";
                                                }
                                            }

                                            function toggleRow(rowName) {
                                                var row = document.querySelector("[data-rowname='" + rowName + "']");
                                                try {
                                                    if (row.style.display === "none") {
                                                        row.style.display = "";
                                                    } else {
                                                        row.style.display = "none";
                                                    }
                                                } catch (error) {
                                                    console.error(error);
                                                    var button = row.getElementsByTagName("button")[0];
                                                    button.disabled = true;
                                                    row.style.display = "";
                                                }
                                            }
                                        </script>


                                        <div class="payment-methods" id="payment_method">
                                            <h4 class="title font-weight-bold ls-25 pb-0 mb-3">Payment Methods</h4>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" checked name="payment_method" id="inlineRadio1" value="cash_on_delivery">
                                                                <label class="form-check-label" for="inlineRadio1">Cash On Delivery</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-check-input" type="radio" name="payment_method" id="inlineRadio2" value="online">
                                                            <label class="form-check-label" for="inlineRadio2">Online payment</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group place-order pt-6">
                                            <button onclick="event.preventDefault(); document.getElementById('placeOrderForm').submit();" class="btn btn-dark btn-block btn-rounded">Place Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->


@endsection

@section('scripts')

    <script>

        function getDivision(id)
        {
            $.ajax({
                method: "GET",
                url: "{{url('/get-division-by-country-id')}}",
                data: {id: id},
                dataType: "JSON",
                success: function (response) {
                    console.log(response);

                    var getDivisionId = $('#getDivisionId');
                    getDivisionId.empty();

                    var option = '';
                    option += '<option value="" style="background-color: #5fa4cc; color: #0c525d"> Please Chose a Division </option>';
                    $.each(response, function (key, value) {
                        option += '<option value=" '+ value.id +' " style="background-color: #5fa4cc; color: #0c525d"> ' + value.name+ ' </option>';
                    });

                    getDivisionId.append(option);
                }
            });
        }

    </script>

    <script>

        function getDistrict(id)
        {
            $.ajax({
                method: "GET",
                url: "{{url('/get-district-by-division-id')}}",
                data: {id: id},
                dataType: "JSON",
                success: function (response) {
                    console.log(response);

                    var getDistrictId = $('#getDistrictId');
                    getDistrictId.empty();

                    var option = '';
                    option += '<option value="" style="background-color: #5fa4cc; color: #0c525d"> Please Chose a State/District </option>';
                    $.each(response, function (key, value) {
                        option += '<option value=" '+ value.id +' " style="background-color: #5fa4cc; color: #0c525d"> ' + value.name+ ' </option>';
                    });

                    getDistrictId.append(option);
                }
            });
        }

    </script>


    <script>

        function getThana(id)
        {
            $.ajax({
                method: "GET",
                url: "{{url('/get-thana-by-district-id')}}",
                data: {id: id},
                dataType: "JSON",
                success: function (response) {
                    console.log(response);

                    var getThanaId = $('#getThanaId');
                    getThanaId.empty();

                    var option = '';
                    option += '<option value="" style="background-color: #5fa4cc; color: #0c525d"> Please Chose a City/Thana </option>';
                    $.each(response, function (key, value) {
                        option += '<option value=" '+ value.id +' " style="background-color: #5fa4cc; color: #0c525d"> ' + value.name+ ' </option>';
                    });

                    getThanaId.append(option);
                }
            });
        }

    </script>
@endsection

