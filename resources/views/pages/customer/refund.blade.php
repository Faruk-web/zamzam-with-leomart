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
                <h1 class="page-title mb-0">Refund And Return</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <link href="{{asset('/')}}backend/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>Refund And Return</li>
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
                    <div class="tab-pane mb-4" id="account-orders">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Refund And Return</h3>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('refund.return-new')}}" type="button" class="btn btn-sm btn-dark btn-rounded float-right" >New Refund</a>
{{--                                <a href="{{route('refund.return-faruk')}}" type="button" class="btn btn-sm btn-dark btn-rounded float-right" >New Refund last</a>--}}
                            </div>
                        </div>
                        <table class="table table-hover table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th style="width: 5%;">Sn</th>
                                <th style="width: 40%;">Product Name</th>
                                <th style="width: 30%;">Date</th>
                                <th style="width: 20%;">Total</th>
                                <th style="width: 30%;">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product_refunds as $product_refund)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product_refund->product_id }}</td>
                                <td>{{\Carbon\Carbon::parse($product_refund->created_at)->format('d M, Y g:iA')}}</td>
{{--                                <td>{{ $product_refund-> }}</td>--}}
{{--                                <td>--}}
{{--                                    <span class="order-price">{{ env('CURRENCY') }}{{ $order->price }} {{ env('UAE_CURRENCY') }}</span> for--}}
{{--                                    <span class="order-quantity"> {{ $order->order_product->sum('qty') }}</span> item--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{ route('order.invoice.generate', $order->id) }}"--}}
{{--                                        class="btn btn-outline btn-default btn-block btn-sm btn-rounded">Download Invoice</a>--}}
{{--                                </td>--}}
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    <!-- End of Main -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Refund And Return</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
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
                                    <option value="" selected disabled>Select option</option>
                                    <option value="re">Refund and Return</option>
                                    <option value="ex">Exchange</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Products</label>
                                <select class="select2 form-control select2-multiple"
                                        multiple="multiple" name="product_id[]" id="productId" data-placeholder="Choose ...">
                                    <option value="" selected disabled>Select Products</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Refund Getway</label>
                                <select name="refund_getway" id="" class="form-control">
                                    <option value="" selected disabled>Select option</option>
                                    <option value="bkash">Bkash</option>
                                    <option value="nagad">Nagad</option>
                                    <option value="bank">Bank</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Account Number</label>
                                <input type="text" name="account_no" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Refund And Return cause</label>
                                <textarea name="cause" id=""></textarea>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="event.preventDefault();document.getElementById('refundForm').submit();" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
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
                        // console.log(orderId);
                        var productId = $('#productId')
                        productId.empty();
                        //
                        var option = '';
                        option += '<option value="" style="background-color: #5fa4cc; color: #0c525d"> Please Chose a order </option>';
                        $.each(orderId, function (key, value) {
                            // console.log(value);
                            option += '<option value=" '+ value.product.id +' " > ' + value.product.title+ ' </option>';

                        });
                        //
                        productId.append(option);

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle any errors
                        console.error(textStatus, errorThrown);
                    }
                });
            }
        });
    </script>

    <script src="{{asset('/')}}backend/libs/select2/js/select2.min.js"></script>
@endsection
