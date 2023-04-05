@extends('layouts.master')

@section('title')
{{ 'My Account' . ' | '. env('APP_NAME') }}
@endsection

@section('content')
	<!-- Start of Main -->
    <main class="main">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Refund And Return Request</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <link href="{{asset('/')}}backend/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>Refund And Return Request</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->

        <div class="page-content container pt-2">
            <div class="row">
                <div class="col-md-3">
                    @include('pages.customer.nav')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3>Refund And Return Request</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('refund.return-form')}}" method="POST" id="refundForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row form-group">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control">
                                    <div class="col-md-6 mb-3">
                                        <label for=""> Order Number</label>
                                        <input type="text" name="order_number" id="myInput" class="form-control" placeholder="#order-number">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Type</label>
                                        <select name="type" id="" class="form-control">
                                            <option value="re">Refund and Return</option>
                                            <option value="ex">Exchange</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Products</label>
                                        <select class="form-control" name="product_id[]" onchange="getOrderProductPrice(this.value)" id="productId" data-placeholder="Choose ...">
                                            <option value="" selected disabled>Select Products</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Refund Getway</label>
                                        <select name="refund_getway" id="" class="form-control">
                                            <option value="bkash">Bkash</option>
                                            <option value="nagad">Nagad</option>
                                            <option value="bank">Bank</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="qty">Details</label>
                                        <div class="row text-center">
                                            <div class="col-md-12" id ='productIdFaruk' style="line-height: 305%;">
                                                {{-- <button type="button" class="btn-sm my-button"  onclick="quickViewQunatityDec(event);" ><i class="fas fa-minus" style="color: #26252dcc;" ></i></button>
                                                <input id="qty" type="text" name="qty" value="1" min="1" style="width: 27%;font-size: 18px;border: none;height: 100%;text-align: center;" readonly>
                                                <button type="button" class="btn-sm my-button" onclick="quickViewQunatityIncr(event)"><i class="fas fa-plus" style="color: #26252dcc;" ></i></button> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Account Number</label>
                                        <input type="text" name="account_no" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Total Amount</label>
                                        <input type="text" name="order_number" id="myInput" id="pricetotalFaruk"  class="form-control" readonly placeholder="Total Amount">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Refund And Return cause</label>
                                        <textarea name="cause" id=""></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    <!-- End of Main -->
    <script>
        const input = document.getElementById('myInput');
        input.addEventListener('blur', function() {
            const inputValue = input.value;
            getOrderData(inputValue);
            // do something with the input value here
            function getOrderData(inputValue) {
                $.ajax({
                    url: '/orders-data/' + inputValue,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Do something with the order data
                        // console.log(response);

                        var orderId = $(response.order.order_product);
                        var orderIdFaruk = $(response.order.order_product);
                        // console.log(orderIdFaruk);

                        var productId = $('#productId')
                        productId.empty();
                        //
                        var productIdFaruk = $('#productIdFaruk')
                        productIdFaruk.empty();
                        //
                        var pricetotalFaruk = $('#pricetotalFaruk')
                        pricetotalFaruk.empty();
                        var option = '';
                        option += '<option value="" style="background-color: #5fa4cc; color: #0c525d"> Please Chose a order </option>';
                        var oqty = '';
                        $.each(orderId, function (key, value) {
                            option += '<option value=" '+ value.product.id +' " > ' + value.product.title+ '<span> (Product Qty: ' + value.qty+ ') </span></option>';

                        });
                        //
                        productId.append(option);
                        $.each(orderIdFaruk, function (key, valueqty) {
                            console.count(valueqty.order_id);
                            let sum = 0, i = 1;
                            // looping from i = 1 to number
                            while(i <= valueqty.lenght) {
                                sum += i;
                                i++;
                            }
                            console.log(sum);
                            // oqty + = '<tr><td><input type="hidden" name="material_id[]" '+ valueqty.product.id +'" value="'+ valueqty.product.id +'"> <input type="number" class="form-control qty" required name="quantity[]" oninput="qty('+valueqty.product.title+')" value="" id="qty" '+valueqty.product.title+'" ></td><td> <input type="number" class="form-control price" required name="price[]" oninput="price('+ valueqty.qty+')" value="'+ valueqty.qty+'" ></td><td> <input type="number" class="form-control total" name="total_price[]" value="0" id="total'+ valueqty.price+'" readonly></td></tr>';
                            oqty += '<div style="margin-left:-11%;" value=" '+ valueqty.product.id +' " > ' +valueqty.product.title+ '<span style="margin-left: 11%;"> (Product Qty : ' + valueqty.qty+ ') </span> <span style="margin-left: 11%;"> (Product Price : ' + valueqty.price+ ') </span> </div>';
                        });
                        productIdFaruk.append(oqty);
                        pricetotalFaruk.append(sum);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle any errors
                        console.error(textStatus, errorThrown);
                    }
                });
            }
            // ---------------------------faruk---------------
        });

        function getOrderProductPrice(id)
        {
            $.ajax({
                method: "GET",
                url: "{{url('/get-refund-product-price-by-id')}}",
                data: {id: id},
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    // $('#qty').val(response.order_product.price)
                }
            });
        }
    </script>

    <script src="{{asset('/')}}backend/libs/select2/js/select2.min.js"></script>
@endsection
