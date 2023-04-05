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
                <h1 class="page-title mb-0">Vendor Account</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>Vendor account</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content container pt-2">
            <div class="row">
                <div class="col-md-3">
                    @include('pages.vendor.nav')
                </div>
                <div class="col-md-9">
                    <div class="tab-pane mb-4" id="account-orders">
                            <div>
                               <h5>Wishlist</h5>
                            </div>
                            <table class="table table-hover table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">S.N</th>
                                        <th style="width: 30%">Product</th>
                                        <th style="width: 20%">Image</th>
                                        <th style="width: 40%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wishlists as $wishlist)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $wishlist->product->title }}</td>
                                        <td><img src="{{ asset('images/product/'.$wishlist->product->image) }}" width="200"></td>
                                        <td>

                                            
                                        <form action="{{ route('wishlist.remove', $wishlist->id) }}" method="POST">
                                            @csrf
                                            <a onclick="addToCart({{ $wishlist->product->id }})" class="btn btn-rounded btn-dark" style="color: #fff;">Add To Cart</a>
                                            <button class="btn btn-rounded btn-dark"><i class="fas fa-times"></i></button>
                                        </form>
                                        </td>
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
@endsection