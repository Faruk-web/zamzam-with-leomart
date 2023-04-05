@extends('layouts.master')

@section('title')
	{{ $product->title }}
@endsection
@php
$averageRating = $product->reviews->avg('rating');
$Ratingfive = $product->reviews->where('rating',5)->count();
$Ratingfour = $product->reviews->where('rating',4)->count();
$Ratingthree = $product->reviews->where('rating',3)->count();
$Ratingtwo = $product->reviews->where('rating',2)->count();
$Ratingone = $product->reviews->where('rating',1)->count();
$total = $Ratingone+$Ratingtwo+$Ratingthree+$Ratingfour+$Ratingfive;
if ($total > 0) {
    $Ratingfiveper=($Ratingfive/$total)*100;
    $Ratingfourper=($Ratingfour/$total)*100;
    $Ratingtreeper=($Ratingthree/$total)*100;
    $Ratingtwoper=($Ratingtwo/$total)*100;
    $Ratingoneper=($Ratingone/$total)*100;
}
// dd($Ratingfiveper);
$rating = $product->reviews->count('rating');
$review = $product->reviews->count('review');
$recommended=$rating+$review ;
// dd($rating);
@endphp
@section('content')
{{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
{{--<!-- Include Magnific Popup CSS -->--}}
{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">--}}

{{--<!-- Include Magnific Popup JS -->--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>--}}

<style>
    /*.main-container {*/
    /*    position: relative;*/
    /*}*/

    .expanded-image {
        position: absolute;
        bottom: -100%;
        left: 0;
        width: 100%;
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        transition: bottom 0.3s ease-out;
        display: none;
    }
    .my-button {
        height: 10%;
        font-size: 1.2rem;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        background-color: #98a8bb75;;
        color: #fff;
    }
    .rating-stars a::before {
            content: "";
            position: absolute;
            left: 0;
            height: 40px!important;
            line-height: 1!important;
         }
         .rating-stars {
            display: flex;
            position: relative;
            height: 15px;
            font-size: 2.2rem;
            margin-left: 1rem;
            margin-top: -2%;
            }
            .rating-form label {
            font-size: 1.9rem;
            }
            #product-tab-reviews p {
            font-size: 1.7rem;
            color:#7f00ff
            }
            #product-tab-reviews .ratings-list .progress-value {
            margin-left: 2rem;
            min-width: 5rem;
            }
         
            @media only screen and (max-width: 600px) {
                #social-links ul li a {
                padding: 6px;
                margin: 1px;
                font-size: 25px;
                margin-left: 47%;
            }
            .faruk_shear{
                    margin-top: -17%;
                  margin-left: 11%;
                }
        }
            @media only screen and (min-width: 600px) {
                .ad_wi_fu {
                    width: 30%!important;*/
            }
            .wish_list{
                margin-left: 2%;
            }
            
            
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Start of Breadcrumb -->
    <style>
        .social-btn-sp #social-links {
                margin: 0 auto;
                max-width: 500px;
            }
            .social-btn-sp #social-links ul li {
                display: inline-block;
            }
            .social-btn-sp #social-links ul li a {
                padding: 15px;
                margin: 1px;
                font-size: 25px;
            }
            table #social-links{
                display: inline-table;
            }
            table #social-links ul li{
                display: inline;
            }
            table #social-links ul li a{
                padding: 5px;
                margin: 1px;
                font-size: 15px;
                background: #e3e3ea;
            }
            .btn_faruk{
                font-size: 0.4rem!important;
                background-color: #62b2e1!important;
            }
            .sidebar {
                border: 1px solid #fff;
                }
    </style>
<style>
    #image-preview img {
        width: 80px; /* Set desired width */
        height: 80px; /* Set desired height */
        margin: 5px; /* Add some margin for spacing */
    }
</style>

    <nav class="breadcrumb-nav container">
        <ul class="breadcrumb bb-no">
            <li><a href="{{route('index')}}" style="text-decoration: none;">Home</a></li>
            <li>Products</li>
        </ul>
        <!-- <ul class="product-nav list-style-none">
            <li class="product-nav-prev">
                <a href="#">
                    <i class="w-icon-angle-left"></i>
                </a>
                <span class="product-nav-popup">
                    <img src="{{ asset('') }}assets/images/products/product-nav-prev.jpg" alt="Product" width="110"
                        height="110" />
                    <span class="product-name">Soft Sound Maker</span>
                </span>
            </li>
            <li class="product-nav-next">
                <a href="#">
                    <i class="w-icon-angle-right"></i>
                </a>
                <span class="product-nav-popup">
                    <img src="{{ asset('') }}assets/images/products/product-nav-next.jpg" alt="Product" width="110"
                        height="110" />
                    <span class="product-name">Fabulous Sound Speaker</span>
                </span>
            </li>
        </ul> -->
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row gutter-lg">
                <div class="">
                    {{-- @dd($product->product_variation); --}}
                    @if(count($product->variation) > 0 )
                    <div class="card mb-3">
                        <div class="card-body" style="background-color: #cecbd754">
                            <div class="product product-single row mb-2">
                                <div class="col-md-3 mb-4 mb-md-8">
                                    <div class="product-gallery">
                                        <div
                                            class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                                            @foreach($product->product_image as $image)
                                                <figure class="product-image">
                                                    <img src="{{ asset($image->image) }}"
                                                         data-zoom-image="{{ asset($image->image) }}"
                                                         alt="{{ $product->title }}" style="height: 300px; width: 300px">
                                                </figure>
                                            @endforeach
                                        </div>
                                        <div class="product-thumbs-wrap">
                                            <div class="product-thumbs row cols-4 gutter-sm">
                                                @foreach($product->product_image as $image)
                                                    <div class="product-thumb active">
                                                        <img src="{{ asset($image->image) }}"
                                                             alt="{{ $product->title }}" style="height: 80px; width: 80px">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                                            <button class="thumb-down disabled"><i class="w-icon-angle-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-6 mb-md-8" >
                                    <div class="product-details" style="background-color: #cecbd703" >
                                        <h1 class="product-title">{{ $product->title }}</h1>
                                        <div class="product-bm-wrapper">
                                            <div class="product-meta">
                                                @if(!is_null($product->category))
                                                    <div class="product-categories">
                                                        <div class="ratings-container" style="font-size: 10px">
                                                            @if($averageRating == 1)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 20%;"></span>

                                                                </div>
                                                                <span style="margin-top: 3px;font-size:14px;color:#7f00ff!important">(1) Ratings | Answered Questions</span>

                                                            @elseif($averageRating == 2)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 40%;"></span>

                                                                </div>
                                                                <span style="margin-top: 3px;font-size:14px;color:#7f00ff!important">(2) Ratings | Answered Questions</span>

                                                            @elseif($averageRating == 3)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 60%;"></span>

                                                                </div>
                                                                <span style="margin-top: 3px;font-size:14px;color:#7f00ff!important">(3) Ratings | Answered Questions</span>

                                                            @elseif($averageRating == 4)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 80%;"></span>

                                                                </div>
                                                                <span style="margin-top: 3px;font-size:14px;color:#7f00ff!important">(4) Ratings | Answered Questions</span>

                                                            @elseif($averageRating == 5)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 100%;"></span>

                                                                </div>
                                                                <span style="margin-top: 3px;font-size:14px;color:#7f00ff!important">(5) Ratings | Answered Questions</span>
                                                            @else
                                                                <div class="ratings-full">
                                                                    {{-- <span class="rating" style="width:0%;"></span> --}}
                                                                </div>
                                                                <span class="rating" style="margin-top: 3px;font-size:14px;color:#7f00ff!important"> (0) Ratings</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="product-categories">

                                                        <h4 class="product-category">Category:<a href="#" style="text-decoration: none; color: deepskyblue"> {{ $product->category->title }}</a></h4>
                                                    </div>
                                                @endif
                                                <div class="product-sku">
                                                    <h4>CODE: <span style="color: #7f00ff">{{ $product->code }}</span></h4>
                                                </div>

                                            </div>
                                        </div>
                                        <p style="background-color: #a8b4bb;font-size: 1px;margin-top:-3%;">.</p>
                                        <div class="product-price" >
                                            {{-- @if($variation_product->type == 'single') --}}
                                                <ins class="new-price" style="color: #7f00ff">&#2547; {{ number_format($variation_product->price)}} </ins>
                                            {{-- @else
                                                @if(count($variation_product->variation) == 2)
                                                    <ins class="new-price" style="color: #7f00ff">&#2547; {{ number_format($product->variation_product->first()->price) }} </ins>
                                                @else
                                                    <ins class="new-price" style="color: #7f00ff">&#2547; {{ number_format($product->variation_product->where('price', $product->variation->min('price'))->first()->price) }}  - &#2547; {{ number_format($product->variation->where('price', $product->variation->max('price'))->first()->price) }} </ins>
                                                @endif
                                            @endif --}}
                                        </div>
                                        <div class="product-meta">
                                            <!-- ShareThis BEGIN -->
                                            <div class="sharethis-inline-share-buttons"></div>
                                            <!-- ShareThis END -->
                                            <div class="product-sku mt-4">
                                                <h4>Stock Quantity: <span style="color:deepskyblue">{{ $product->qty }}</span></h4>
                                            </div>
                                            <div class="product-sku mt-4">
                                                <h4>Product Weight: <span style="color:deepskyblue">{{ $product->weight }}</span><span style="color:deepskyblue">{{ $product->unit}}</span></h4>
                                            </div>
                                            <div class="product-sku mt-4">
                                                <h4>Product Type: <span style="color:deepskyblue">{{ $product->type }}</span></h4>
                                            </div>
                                        </div>
                                        <p style="background-color: #a8b4bb;font-size: 1px;margin-top:0%;">.</p>
                                        {{-- <hr class="product-divider"> --}}
                                        @if($product->type == 'variation')
                                            @foreach(json_decode($product->choice_options, true) as $option)
                                                <div class="product-form product-variation-form product-size-swatch">
                                                    <label class="mb-1">{{ !is_null(App\Models\Variation::find($option['variation_id'])) ? App\Models\Variation::findOrFail($option['variation_id'])->title : 'N/A' }}:</label>
                                                    <div class="flex-wrap d-flex align-items-center product-variations">
                                                        @foreach($option['values'] as $value)
                                                            <a href="#" class="size">{{ $value }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <form action="{{route('cart.add-form', ['id' => $product->id])}}" method="POST" enctype="multipart/form-data" id="add-to-cart-form">
                                            @csrf
                                            <div class="fix-bottom product-sticky-content">
                                                <div class="product-form container">
                                                    {{-- <div class="product-quantity-inner"> --}}
                                                        {{-- <div class="row"> --}}
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="product-thumbs-wrap">
                                                                        <label for="color"> <b>Color:</b></label>
                                                                        <div class="product-thumbs row cols-4 gutter-sm">
                                                                            @foreach($product->variation as $image)
                                                                                <div class="product-thumb active" style="margin-left:18px;">
                                                                                    <p class="text-left"><input type="radio" class="form-check-input" name="color_id" value="{{$image->color_id}}"> <span style="margin-left:6px;"> {{$image->color->name}}</span></p>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                        <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                                                                        <button class="thumb-down disabled"><i class="w-icon-angle-right"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="size"> <b> Size: </b></label>
                                                                    @foreach($product->variation as $size)
                                                                        <div class="form-check-inline">
                                                                            <a href="{{route('color.product',$size->id)}}"><label class="form-check-label"><input type="radio" class="form-check-input" name="size" value="{{$size->size_id}}">{{$size->size->name}}</label></a>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <p style="background-color: #1a3544;font-size: 1px;margin-top:0%;">.</p>
                                                        {{-- </div> --}}

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <h4 for="quantity" style="color: #7f00ff"> <b>Quantity:</b></h4>
                                                                            <button type="button" class="btn-sm my-button"  onclick="quickViewQunatityDec(event);" ><i class="fas fa-minus" style="color: #26252dcc;" ></i></button>
                                                                            <input id="qty" type="text" name="qty" value="1" min="1" style="width: 27%;font-size: 18px;border: none;height: 100%;text-align: center;" readonly>
                                                                            <button type="button" class="btn-sm my-button" onclick="quickViewQunatityIncr(event)"><i class="fas fa-plus" style="color: #26252dcc;" ></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <a type="submit" class="btn btn-sm btn-primary" style="color: #fff;" href="{{route('wishlist.add', ['id' => $product->id])}}"> Add to wishlist</a> --}}
                                                    {{-- </div> --}}
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-sm btn-primary w-md mb-3 ad_wi_fu" onclick="event.preventDefault(); document.getElementById('add-to-cart-form').submit();" style="color: #fff;"><i class="w-icon-cart"></i>  Add to Cart</button>
                                                <button type="button" onclick="addToWishlist({{$product->id}})" class= "btn btn-sm btn-success w-md mb-3 ad_wi_fu wish_list" style="color: #ffffff"
                                                   title="Add to wishlist"><i class="w-icon-heart"></i> Add to wishlist</button>
                                            </div>
                                        </div>
                                        {{-- <form action="{{route('wishlist.add', ['id' => $product->id])}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary" style="color: #fff;"><i class="w-icon-cart"></i> Add to Cart</button>
                                        </form> --}}
                                        <div class="social-links-wrapper">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <h3>Share:</h3>
                                        </div>
                                        <div class="col-md-10 faruk_shear">
                                            <div class="social-btn-sp">
                                                {!! $shareButtons = Share::page(url('/product/'.$product->id))->facebook()->twitter()->linkedin()->whatsapp(); !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-6 mb-md-8">
                                    <aside class="sidebar sidebar-fixed right-sidebar" style="height: 100%; border: none" >
                                        <div class="sidebar-content " style="background-color: #cecbd703">
                                            <div class="sticky-sidebar">
                                                <div class="widget widget-icon-box">
                                                    <div class="icon-box icon-box-side">
                                                        <span class="icon-box-icon text-dark">
                                                            <i class="w-icon-map-marker"></i>
                                                        </span>
                                                        <div class="icon-box-content">
                                                            <p class="icon-box-title" style="color:deepskyblue">Delivery</p>
                                                            <h4>{{$vendor_info->user->address}}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="icon-box icon-box-side">
                                                        <span class="icon-box-icon text-dark">
                                                            <i class="w-icon-truck"></i>
                                                        </span>
                                                        <div class="icon-box-content">
                                                            <p class="icon-box-title" style="color:deepskyblue">Free Shipping & Returns</p>
                                                            <h4>For all orders over $99</h4>
                                                        </div>
                                                    </div>
                                                    <div class="icon-box icon-box-side">
                                                        <span class="icon-box-icon text-dark">
                                                            <i class="w-icon-bag"></i>
                                                        </span>
                                                        <div class="icon-box-content">
                                                            <p class="icon-box-title" style="color:deepskyblue">Secure Payment</p>
                                                            <h4>We ensure secure payment</h4>
                                                        </div>
                                                    </div>
                                                    <div class="icon-box icon-box-side">
                                                        <span class="icon-box-icon text-dark">
                                                            <i class="w-icon-money"></i>
                                                        </span>
                                                        <div class="icon-box-content">
                                                            <p class="icon-box-title" style="color:deepskyblue">Money Back Guarantee</p>
                                                            <h4>Any back within 30 days</h4>
                                                        </div>
                                                    </div>
                                                    <div class="icon-box icon-box-side">
                                                        <span class="icon-box-icon text-dark">
                                                            <i class="w-icon-money"></i>
                                                        </span>
                                                        <div class="icon-box-content">
                                                            <h4>Cash on Delivery Available</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End of Widget Banner -->
                                            </div>
                                        </div>
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="card mb-3">
                            <div class="card-body" style="background-color: #cecbd754">
                                <div class="product product-single row mb-2">
                                    <div class="col-md-3 mb-4 mb-md-8">
                                        <div class="product-gallery">
                                            <div
                                                class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                                                @foreach($product->product_image as $image)
                                                    <figure class="product-image">
                                                        <img src="{{ asset($image->image) }}"
                                                             data-zoom-image="{{ asset($image->image) }}"
                                                             alt="{{ $product->title }}" style="height: 300px; width: 300px">
                                                    </figure>
                                                @endforeach
                                            </div>
                                            <div class="product-thumbs-wrap">
                                                <div class="product-thumbs row cols-4 gutter-sm">
                                                    @foreach($product->product_image as $image)
                                                        <div class="product-thumb active">
                                                            <img src="{{ asset($image->image) }}"
                                                                 alt="{{ $product->title }}" style="height: 80px; width: 80px">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                                                <button class="thumb-down disabled"><i class="w-icon-angle-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6 mb-md-8" >
                                        <div class="product-details" style="background-color: #cecbd703" >
                                            <h1 class="product-title">{{ $product->title }}</h1>
                                            <div class="product-bm-wrapper">
                                                <div class="product-meta">
                                                    @if(!is_null($product->category))
                                                        <div class="product-categories">
                                                            <div class="ratings-container" style="font-size: 10px">
                                                                @if($averageRating == 1)
                                                                    <div class="ratings-full">
                                                                        <span class="ratings" style="width: 20%;"></span>

                                                                    </div>
                                                                    <span style="margin-top: 3px;font-size:14px;color:#7f00ff!important">(1) Ratings | Answered Questions</span>

                                                                @elseif($averageRating == 2)
                                                                    <div class="ratings-full">
                                                                        <span class="ratings" style="width: 40%;"></span>

                                                                    </div>
                                                                    <span style="margin-top: 3px;font-size:14px;color:#7f00ff!important">(2) Ratings | Answered Questions</span>

                                                                @elseif($averageRating == 3)
                                                                    <div class="ratings-full">
                                                                        <span class="ratings" style="width: 60%;"></span>

                                                                    </div>
                                                                    <span style="margin-top: 3px;font-size:14px;color:#7f00ff!important">(3) Ratings | Answered Questions</span>

                                                                @elseif($averageRating == 4)
                                                                    <div class="ratings-full">
                                                                        <span class="ratings" style="width: 80%;"></span>

                                                                    </div>
                                                                    <span style="margin-top: 3px;font-size:14px;color:#7f00ff!important">(4) Ratings | Answered Questions</span>

                                                                @elseif($averageRating == 5)
                                                                    <div class="ratings-full">
                                                                        <span class="ratings" style="width: 100%;"></span>

                                                                    </div>
                                                                    <span style="margin-top: 3px;font-size:14px;color:#7f00ff!important">(5) Ratings | Answered Questions</span>
                                                                @else
                                                                    <div class="ratings-full">
                                                                        {{-- <span class="rating" style="width:0%;"></span> --}}
                                                                    </div>
                                                                    <span class="rating" style="margin-top: 3px;font-size:14px;color:#7f00ff!important"> (0) Ratings</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="product-categories">

                                                            <h4 class="product-category">Category:<a href="#" style="text-decoration: none; color: deepskyblue"> {{ $product->category->title }}</a></h4>
                                                        </div>
                                                    @endif
                                                    <div class="product-sku">
                                                        <h4>CODE: <span style="color: #7f00ff">{{ $product->code }}</span></h4>
                                                    </div>

                                                </div>
                                            </div>
                                            <p style="background-color: #a8b4bb;font-size: 1px;margin-top:-3%;">.</p>
                                            <div class="product-price" >
                                                @if($product->type == 'single')
                                                    <ins class="new-price" style="color: #7f00ff">&#2547; {{ number_format($product->price) }} </ins>
                                                @else
                                                    @if(count($product->variation) == 1)
                                                        <ins class="new-price" style="color: #7f00ff">&#2547; {{ number_format($product->variation->first()->price) }} </ins>
                                                    @else
                                                        <ins class="new-price" style="color: #7f00ff">&#2547; {{ number_format($product->variation->where('price', $product->variation->min('price'))->first()->price) }}  - &#2547; {{ number_format($product->variation->where('price', $product->variation->max('price'))->first()->price) }} </ins>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="product-meta">
                                                <!-- ShareThis BEGIN -->
                                                <div class="sharethis-inline-share-buttons"></div>
                                                <!-- ShareThis END -->
                                                <div class="product-sku mt-4">
                                                    <h4>Stock Quantity: <span style="color:deepskyblue">{{ $product->qty }}</span></h4>
                                                </div>
                                                <div class="product-sku mt-4">
                                                    <h4>Product Weight: <span style="color:deepskyblue">{{ $product->weight }}</span><span style="color:deepskyblue">{{ $product->unit}}</span></h4>
                                                </div>
                                                <div class="product-sku mt-4">
                                                    <h4>Product Type: <span style="color:deepskyblue">{{ $product->type }}</span></h4>
                                                </div>
                                            </div>
                                            <p style="background-color: #a8b4bb;font-size: 1px;margin-top:0%;">.</p>
                                            {{-- <hr class="product-divider"> --}}
                                            @if($product->type == 'variation')
                                                @foreach(json_decode($product->choice_options, true) as $option)
                                                    <div class="product-form product-variation-form product-size-swatch">
                                                        <label class="mb-1">{{ !is_null(App\Models\Variation::find($option['variation_id'])) ? App\Models\Variation::findOrFail($option['variation_id'])->title : 'N/A' }}:</label>
                                                        <div class="flex-wrap d-flex align-items-center product-variations">
                                                            @foreach($option['values'] as $value)
                                                                <a href="#" class="size">{{ $value }}</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <form action="{{route('cart.add-form', ['id' => $product->id])}}" method="POST" enctype="multipart/form-data" id="add-to-cart-form">
                                                @csrf
                                                <div class="fix-bottom product-sticky-content">
                                                    <div class="product-form container">
                                                        <div class="product-quantity-inner">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <h4 for="quantity" style="color: #7f00ff"> <b>Quantity:</b></h4>
                                                                                <button type="button" class="btn-sm my-button"  onclick="quickViewQunatityDec(event);" ><i class="fas fa-minus" style="color: #26252dcc;" ></i></button>
                                                                                <input id="qty" type="text" name="qty" value="1" min="1" style="width: 27%;font-size: 18px;border: none;height: 100%;text-align: center;" readonly>
                                                                                <button type="button" class="btn-sm my-button" onclick="quickViewQunatityIncr(event)"><i class="fas fa-plus" style="color: #26252dcc;" ></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <a type="submit" class="btn btn-sm btn-primary" style="color: #fff;" href="{{route('wishlist.add', ['id' => $product->id])}}"> Add to wishlist</a> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-sm btn-primary w-md mb-3 ad_wi_fu" onclick="event.preventDefault(); document.getElementById('add-to-cart-form').submit();" style="color: #fff;"><i class="w-icon-cart"></i>  Add to Cart</button>
                                                    <button type="button" onclick="addToWishlist({{$product->id}})" class= "btn btn-sm btn-success w-md mb-3 ad_wi_fu wish_list" style="color: #ffffff"
                                                       title="Add to wishlist"><i class="w-icon-heart"></i> Add to wishlist</button>
                                                </div>
                                            </div>
                                            {{-- <form action="{{route('wishlist.add', ['id' => $product->id])}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary" style="color: #fff;"><i class="w-icon-cart"></i> Add to Cart</button>
                                            </form> --}}
                                            <div class="social-links-wrapper">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <h3>Share:</h3>
                                            </div>
                                            <div class="col-md-10 ">
                                                <div class="social-btn-sp">
                                                    {!! $shareButtons = Share::page(url('/product/'.$product->id))->facebook()->twitter()->linkedin()->whatsapp(); !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-6 mb-md-8">
                                        <aside class="sidebar sidebar-fixed right-sidebar" style="height: 100%; border: none" >
                                            <div class="sidebar-content " style="background-color: #cecbd703">
                                                <div class="sticky-sidebar">
                                                    <div class="widget widget-icon-box">
                                                        <div class="icon-box icon-box-side">
                                                            <span class="icon-box-icon text-dark">
                                                                <i class="w-icon-map-marker"></i>
                                                            </span>
                                                            <div class="icon-box-content">
                                                                <p class="icon-box-title" style="color:deepskyblue">Delivery</p>
                                                                <h4>{{$vendor_info->user->address}}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="icon-box icon-box-side">
                                                            <span class="icon-box-icon text-dark">
                                                                <i class="w-icon-truck"></i>
                                                            </span>
                                                            <div class="icon-box-content">
                                                                <p class="icon-box-title" style="color:deepskyblue">Free Shipping & Returns</p>
                                                                <h4>For all orders over $99</h4>
                                                            </div>
                                                        </div>
                                                        <div class="icon-box icon-box-side">
                                                            <span class="icon-box-icon text-dark">
                                                                <i class="w-icon-bag"></i>
                                                            </span>
                                                            <div class="icon-box-content">
                                                                <p class="icon-box-title" style="color:deepskyblue">Secure Payment</p>
                                                                <h4>We ensure secure payment</h4>
                                                            </div>
                                                        </div>
                                                        <div class="icon-box icon-box-side">
                                                            <span class="icon-box-icon text-dark">
                                                                <i class="w-icon-money"></i>
                                                            </span>
                                                            <div class="icon-box-content">
                                                                <p class="icon-box-title" style="color:deepskyblue">Money Back Guarantee</p>
                                                                <h4>Any back within 30 days</h4>
                                                            </div>
                                                        </div>
                                                        <div class="icon-box icon-box-side">
                                                            <span class="icon-box-icon text-dark">
                                                                <i class="w-icon-money"></i>
                                                            </span>
                                                            <div class="icon-box-content">
                                                                <h4>Cash on Delivery Available</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Widget Banner -->
                                                </div>
                                            </div>
                                        </aside>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="card mb-3">
                        <div class="card-body" >
                            <section class="description-section">
                                <div class="title-link-wrapper no-link">
                                    <h2 class="title title-link">Description</h2>
                                </div>
                                <div class="pt-4 pb-1" id="product-tab-description">
                                    {!! $product->description !!}
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body" >
                            <section class="review-section">
                                <div class="title-link-wrapper no-link">
                                    <h2 class="title title-link">Customer Reviews</h2>
                                </div>
                                <div class="pt-4 pb-1" id="product-tab-reviews">
                                    <div class="row mb-4">
                                        <div class="col-xl-4 col-lg-5" >
                                            <div class="ratings-wrapper">
                                                <div class="avg-rating-container">
                                                    @if($averageRating==Null)
                                                        <h4 class="avg-mark font-weight-bolder" style="margin-bottom: 82px;">0.0/5</h4>
                                                        <div class="ratings-full"style="font-size: 25px; margin-left: -31%;margin-top: 11%;">
                                                            <span class="ratings" style="width:0%;"></span>
                                                        </div>
                                                        <h6 style="margin-top: 36%;margin-left: -19%;">({{$total}}) Ratings</h6>
                                                    @else
                                                        <h4 class="avg-mark font-weight-bolder" style="margin-bottom: 82px;">{{number_format($averageRating,1)}}/5</h4>
                                                        <div class="ratings-container" style="font-size: 25px; margin-left: -31%;margin-top: 11%;">
                                                            @if($averageRating == 1)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 20%;"></span>
                                                                </div>
                                                                

                                                            @elseif($averageRating == 2)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 40%;"></span>

                                                                </div>
                                                               

                                                            @elseif($averageRating == 3)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 60%;"></span>

                                                                </div>
                                                               

                                                            @elseif($averageRating == 4)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 80%;"></span>
                                                                </div>
                                                            @elseif($averageRating == 5)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 100%;"></span>

                                                                </div>
                                                    
                                                            @else
                                                                <div class="ratings-full">
                                                                    {{-- <span class="rating" style="width:0%;"></span> --}}
                                                                </div>
                                                               
                                                            @endif
                                                        </div>
                                                        <h6 style="margin-top: 36%;margin-left: -19%;">({{$total}}) Ratings</h6>
                                                    @endif
                                                    <div class="avg-rating" style="margin-left:4%;">
                                                        <p class="text-dark " style="font-size: 1.9rem;line-height: 2.4;">Average Rating</p>
                                                        <div class="ratings-list">
                                                            <div class="ratings-container" style="font-size: 1.7rem;">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 100%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                                <div class="progress-bar progress-bar-sm ">
                                                                    <span></span>
                                                                </div>
                                                                <div class="progress-value">
                                                                    @if($total >0)
                                                                        <mark style="font-size: 1.6rem;">{{round($Ratingfiveper)}}%</mark>
                                                                    @else
                                                                        <mark style="font-size: 1.6rem;">0 %</mark>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="ratings-container" style="font-size: 1.7rem;">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 80%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                                <div class="progress-bar progress-bar-sm ">
                                                                    <span></span>
                                                                </div>
                                                                <div class="progress-value">
                                                                    @if($total >0)
                                                                        <mark style="font-size: 1.6rem;">{{round($Ratingfourper)}}%</mark>
                                                                    @else
                                                                        <mark style="font-size: 1.6rem;">0 %</mark>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="ratings-container" style="font-size: 1.7rem;">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 60%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                                <div class="progress-bar progress-bar-sm ">
                                                                    <span></span>
                                                                </div>
                                                                <div class="progress-value">
                                                                    @if($total >0)
                                                                        <mark style="font-size: 1.6rem;">{{round($Ratingtreeper)}}%</mark>
                                                                    @else
                                                                        <mark style="font-size: 1.6rem;">0 %</mark>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="ratings-container" style="font-size: 1.7rem;">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 40%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                                <div class="progress-bar progress-bar-sm ">
                                                                    <span></span>
                                                                </div>
                                                                <div class="progress-value">
                                                                    @if($total >0)
                                                                        <mark style="font-size: 1.6rem;">{{round($Ratingtwoper)}}%</mark>
                                                                    @else
                                                                        <mark style="font-size: 1.6rem;">0 %</mark>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="ratings-container" style="font-size: 1.7rem;">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 20%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                                <div class="progress-bar progress-bar-sm ">
                                                                    <span></span>
                                                                </div>
                                                                <div class="progress-value">
                                                                    @if($total >0)
                                                                        <mark style="font-size: 1.6rem;">{{round($Ratingoneper)}}%</mark>
                                                                    @else
                                                                        <mark style="font-size: 1.6rem;">0 %</mark>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            {{-- @endif --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(Auth::user())
                                            <div class="col-xl-8 col-lg-8 mb-4">
                                                <div class="review-form-wrapper">
                                                    <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                        Review</h3>
                                                    <p class="mb-3">Only authentic buyer can submit a review. Required
                                                        fields are marked *</p>
                                                    <form action="{{route('submit.rating')}}" method="POST" class="review-form" enctype="multipart/form-data">
                                                        @csrf
                                                        {{--  @dd(Auth::user())--}}
                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                        <div class="rating-form" >
                                                            <label for="rating">Your Rating Of This Product :</label>
                                                            <span class="rating-stars">
                                                    <a class="star-1" href="#">1</a>
                                                    <a class="star-2" href="#">2</a>
                                                    <a class="star-3" href="#">3</a>
                                                    <a class="star-4" href="#">4</a>
                                                    <a class="star-5" href="#">5</a>
                                                </span>
                                                            <select name="rating" id="rating" required=""
                                                                    style="display: none;">
                                                                <option value="">Rate…</option>
                                                                <option value="5">Perfect</option>
                                                                <option value="4">Good</option>
                                                                <option value="3">Average</option>
                                                                <option value="2">Not that bad</option>
                                                                <option value="1">Very poor</option>
                                                            </select>
                                                        </div>

                                                        <textarea cols="30" rows="6" name="review" placeholder="Write Your Review Here..." class="form-control" id="review"></textarea>
                                                        <div class="row gutter-md">
                                                            <div class="col-md-12">
                                                                <input type="file" name="gallery[]" class="form-control" id="images" onchange="checkFiles()" multiple>
                                                                <div id="image-preview"></div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input type="text" value="{{Auth::user()->name}}" name="name" class="form-control" readonly placeholder="Your Name" id="author">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="email" value="{{Auth::user()->email}}" name="email" class="form-control" readonly placeholder="Your Email" id="email_1">
                                                            </div>
                                                        </div>
                                                        {{--                                            <div class="form-group">--}}
                                                        {{--                                                <input type="checkbox" class="custom-checkbox"--}}
                                                        {{--                                                    id="save-checkbox">--}}
                                                        {{--                                                <label for="save-checkbox">Save my name, email, and website in--}}
                                                        {{--                                                    this browser for the next time I comment.</label>--}}
                                                        {{--                                            </div>--}}
                                                        <button type="submit" class="btn btn-dark">Submit Review</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-xl-8 col-lg-7 mb-4">
                                                <div class="review-form-wrapper">
                                                    <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                        Review</h3>
                                                    <p class="mb-3">Only authentic buyer can submit a review. Required
                                                        fields are marked *</p>
                                                    <form action="{{route('submit.rating')}}" method="POST" class="review-form" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                        <div class="rating-form" style="font-size: 30px">
                                                            <label for="rating">Your Rating Of This Product :</label>
                                                            <span class="rating-stars">
                                                    <a class="star-1" href="#">1</a>
                                                    <a class="star-2" href="#">2</a>
                                                    <a class="star-3" href="#">3</a>
                                                    <a class="star-4" href="#">4</a>
                                                    <a class="star-5" href="#">5</a>
                                                </span>
                                                            <select name="rating" id="rating" required=""
                                                                    style="display: none;">
                                                                <option value="">Rate…</option>
                                                                <option value="5">Perfect</option>
                                                                <option value="4">Good</option>
                                                                <option value="3">Average</option>
                                                                <option value="2">Not that bad</option>
                                                                <option value="1">Very poor</option>
                                                            </select>
                                                        </div>

                                                        <textarea cols="30" rows="6" placeholder="Write Your Review Here..." name="review" class="form-control" id="review"></textarea>
                                                        <div class="row gutter-md">
                                                            <div class="col-md-12">
                                                                <input type="file" name="gallery[]" class="form-control" id="images" onchange="checkFiles()" multiple>
                                                                <div id="image-preview"></div>
                                                            </div>
                                                        </div>
                                                        {{--                                            <div class="form-group">--}}
                                                        {{--                                                <input type="checkbox" class="custom-checkbox"--}}
                                                        {{--                                                    id="save-checkbox">--}}
                                                        {{--                                                <label for="save-checkbox">Save my name, email, and website in--}}
                                                        {{--                                                    this browser for the next time I comment.</label>--}}
                                                        {{--                                            </div>--}}
                                                        <button type="submit" class="btn btn-dark">Submit Review</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <script>
                        document.getElementById("images").addEventListener("change", function() {
                            var files = event.target.files;
                            var preview = document.getElementById("image-preview");

                            preview.innerHTML = '';

                            for (var i = 0; i < files.length; i++) {
                                var reader = new FileReader();
                                reader.onload = function(event) {
                                    var img = document.createElement("img");
                                    img.onload = function() {
                                        URL.revokeObjectURL(this.src); // Free up memory
                                    };
                                    img.src = event.target.result;
                                    preview.appendChild(img);
                                }
                                reader.readAsDataURL(files[i]);
                            }
                        });
                    </script>
                    <script>
                        function checkFiles() {
                            const input = document.getElementById("images");
                            const files = input.files;
                            if (files.length > 5) {
                                toastr.error('You can only select up to 5 images');
                                input.value = ""; // clear the selected files
                            }
                        }
                    </script>


                    <div class="card mb-3">
                        <div class="card-body" >
                            <h3>Product Reviews</h3>
                            {{-- <hr style="border: solid grey 1px"> --}}
                            @foreach($rating_reviews as $rating_review)
                                <div class="row">
                                    <div class="ratings-container" >
                                        @if($rating_review->rating == 1)
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 20%;"></span>
                                            </div>
                                            <span style="margin-top: 3px;font-size:12px"></span>

                                        @elseif($rating_review->rating == 2)
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 40%;"></span>

                                            </div>
                                            <span style="margin-top: 3px;font-size:12px"></span>

                                        @elseif($rating_review->rating == 3)
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 60%;"></span>

                                            </div>
                                            <span style="margin-top: 3px;font-size:12px"></span>

                                        @elseif($rating_review->rating == 4)
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 80%;"></span>

                                            </div>
                                            <span style="margin-top: 3px;font-size:12px"></span>

                                        @elseif($rating_review->rating == 5)
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 100%;"></span>

                                            </div>
                                            <span style="margin-top: 3px;font-size:12px"></span>
                                        @else
                                            <div class="ratings-full">
                                                {{-- <span class="rating" style="width:0%;"></span> --}}
                                            </div>
                                            <span class="rating" style="margin-top: 3px;font-size:12px;"> (0) Ratings</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="title-link-wrapper no-link">
                                            <h2 class="title title-link">by {{$rating_review->name}} .<span style="color:rgb(32, 109, 83)"> <i class="fa-solid fa-circle-check"> </i> Verified Purchase</span> </h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="text-right">{{$rating_review->created_at->diffForHumans()}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="title-link-wrapper no-link">
                                            <p>{{$rating_review->review}}</p>
                                        </div>
                                        @foreach($rating_review->reviewImages as $rating_review_image)
                                            <img src="{{asset($rating_review_image->images)}}"  alt="Images" class="popup-image mb-5" style="height: 100px; width: 100px; margin-right: 10px; position: relative">
                                            <div class="expanded-image"></div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
{{--                    <div class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">--}}
{{--                        @foreach($similar_products as $product)--}}
{{--                            @include('partials.review_cart')--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
                        <h2 style="margin-top: 30px">Product on this vendor</h2>
                        <hr style="border: solid grey 1px">
                        <div class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                            @foreach($vendor_products as $product)
                                @include('partials.product')
                            @endforeach
                        </div>
                        <h2>Similiar Product</h2>
                        <hr style="border: solid grey 1px">
                        <div class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                            @foreach($similar_products as $product)
                                @include('partials.product')
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Page Content -->

<script>
    $(document).ready(function() {
        $('.popup-image').hover(function() {
            $.magnificPopup.open({
                items: {
                    src: $(this).data('mfp-src')
                },
                type: 'image'
            });
        }, function() {
            $.magnificPopup.close();
        });
    });
</script>

{{--<script>--}}
{{--    var thumbnail = document.querySelector('.popup-image');--}}
{{--    var expandedImage = document.querySelector('.expanded-image');--}}

{{--    thumbnail.addEventListener('click', function() {--}}
{{--        expandedImage.style.backgroundImage = 'url(' + thumbnail.src + ')';--}}
{{--        expandedImage.style.display = 'block';--}}
{{--        setTimeout(function() {--}}
{{--            expandedImage.style.bottom = 0;--}}
{{--        }, 10);--}}
{{--    });--}}

{{--    expandedImage.addEventListener('click', function() {--}}
{{--        expandedImage.style.bottom = '-100%';--}}
{{--        setTimeout(function() {--}}
{{--            expandedImage.style.display = 'none';--}}
{{--        }, 300);--}}
{{--    });--}}

{{--</script>--}}


@endsection

