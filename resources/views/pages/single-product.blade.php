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
  margin: 15px 0;
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
        width: 112px;
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

    /*.main-container {*/
    /*    position: relative;*/
    /*}*/
    .widget-icon-box .icon-box-side {
        justify-content: left;
        padding: 1rem 0;
    }
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
            height: 0px;
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
            .mobile_faruk{
                color: #5417fd;
                background-color: #b9cfdd;
                margin-left: 28px;
                margin-top: 50px;
            }
            .top_btn_fu{
                margin-top: -7%;position: fixed;
            }
            @media only screen and (max-width:600px) {
                .mobile_faruk{
                    margin-left: 46px;
                    color: #5417fd;
                    background-color: #b9cfdd;
                    margin-top: -11px;
                }
                .top_btn_fu{
                    margin-top:-70px;
                }
            }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Start of Breadcrumb -->
    <style>
        .my-button {
            font-size: 14px!important;
            }
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
    .mob_ver{
        margin-bottom: 0%;
    }
    @media only screen and (max-width: 600px) {
        .mob_ver{
            margin-bottom: -4%;
        }
    }
    @media only screen and (min-width: 610px) {
        .show-card{
            display: none;
        }
    }
    .mob_image{
        height: 100px;
        width: 100px;
        margin-right: 10px;
        position: relative
    }
    @media only screen and (max-width: 620px) {
        .mob_image{
            height: 27%;
            width: 27%;
            margin-right: 10px;
            position: relative
        }
    }
    #image-preview img {
        width: 80px; /* Set desired width */
        height: 80px; /* Set desired height */
        margin: 5px; /* Add some margin for spacing */
    }
    @media only screen and (max-width: 770px) {
        .ad_wi_fu {
            display: none;
        }
    }
    @media only screen and (min-width: 600px) {
                .ad_wi_fu {
                    width: 30%!important;
            }
                    .wish_list{
                margin-left: 2%;
            }
        }
            .faruk_shear{
                margin-top: -8%;margin-left: 7%;
            }
            .faruk_rating{
                    font-size: 25px; margin-left: -34%;margin-top: 11%;
                }
            .mobile_faruk_avg{
                margin-left:4%;
            }
            #product-tab-reviews .avg-rating {
            margin-left: 10.8rem;
            }
            .count_reting{
                margin-top: 36%;
                margin-left: -36%;
                font-size: 1.1rem;
            }
            .hr_line{
                display:none;
            }
            .authentic_buyer{
                    color: gray !important;
                }
                .rating-stars{
                    font-size: 2.2rem;
                    margin-top: -4%;
                }
                .rating-stars a{
                    width: 2.5rem;
                }
        @media only screen and (max-width: 600px) {
                #social-links ul li a {
                    padding: 6px;
                    margin: 1px;
                    font-size: 25px;
                    margin-left: 47%;
                }
                .social-btn-sp #social-links ul li a {
                    padding: 6px;
                    margin: 1px;
                    font-size: 25px;
                    margin-left: 47%;
                }
                .faruk_shear{
                    margin-top: -17%;
                  margin-left: 11%;
                }
                .faruk_rating{
                    font-size: 17px;
                    margin-left: -31%;
                }
                .faruk_avg{
                    font-size: 4em!important;
                }
                /* .mobile_faruk{
                margin-left: 5.8rem;
               } */
                    #product-tab-reviews .avg-rating {
                    margin-left: 4rem;
                    }
               .count_reting{
                    margin-top: 36%;
                   margin-left: -109px;
                   font-size: 1.1rem;
                }
                .hr_line{
                    display:block;
                }
                .font-weight-bold{
                    margin-left: 50px;
                }
                .authentic_buyer{
                    font-size: 15px !important;
                    color: gray !important;
                }
                .rating-stars{
                    font-size: 2.2rem;
                }
                .rating-stars a{
                    width: 2.5rem;
                }
            }
</style>
{{--<style>--}}
{{--    /* -- quantity box -- */--}}

{{--    .quantity {--}}
{{--        display: inline-block; }--}}

{{--    .quantity .input-text.qty {--}}
{{--        width: 35px;--}}
{{--        height: 39px;--}}
{{--        padding: 0 5px;--}}
{{--        text-align: center;--}}
{{--        background-color: transparent;--}}
{{--        border: 1px solid #efefef;--}}
{{--    }--}}

{{--    .quantity.buttons_added {--}}
{{--        text-align: left;--}}
{{--        position: relative;--}}
{{--        white-space: nowrap;--}}
{{--        vertical-align: top; }--}}

{{--    .quantity.buttons_added input {--}}
{{--        display: inline-block;--}}
{{--        margin: 0;--}}
{{--        vertical-align: top;--}}
{{--        box-shadow: none;--}}
{{--    }--}}

{{--    .quantity.buttons_added .minus,--}}
{{--    .quantity.buttons_added .plus {--}}
{{--        padding: 7px 10px 8px;--}}
{{--        height: 41px;--}}
{{--        background-color: #ffffff;--}}
{{--        border: 1px solid #efefef;--}}
{{--        cursor:pointer;}--}}

{{--    .quantity.buttons_added .minus {--}}
{{--        border-right: 0; }--}}

{{--    .quantity.buttons_added .plus {--}}
{{--        border-left: 0; }--}}

{{--    .quantity.buttons_added .minus:hover,--}}
{{--    .quantity.buttons_added .plus:hover {--}}
{{--        background: #eeeeee; }--}}

{{--    .quantity input::-webkit-outer-spin-button,--}}
{{--    .quantity input::-webkit-inner-spin-button {--}}
{{--        -webkit-appearance: none;--}}
{{--        -moz-appearance: none;--}}
{{--        margin: 0; }--}}

{{--    .quantity.buttons_added .minus:focus,--}}
{{--    .quantity.buttons_added .plus:focus {--}}
{{--        outline: none; }--}}


{{--</style>--}}
{{--<script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>--}}

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
                        <div class="card-body">
                            <div class="product product-single row mb-2">
                                <div class="col-md-3 mb-4 mb-md-8">
                                    <div class="product-gallery">
                                        <div
                                            class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                                            @foreach($product->variation as $image)
                                                <figure class="product-image">
                                                    <img src="{{ asset($image->variation_image) }}"
                                                         data-zoom-image="{{ asset($image->variation_image) }}"
                                                         alt="{{ $product->title }}" style="height: 300px; width: 300px">
                                                </figure>
                                            @endforeach
                                        </div>
                                        <div class="product-thumbs-wrap">
                                            <div class="product-thumbs row cols-4 gutter-sm">
                                                @foreach($product->variation as $image)
                                                    <div class="product-thumb active">
                                                        <img src="{{ asset($image->variation_image) }}"
                                                             alt="{{ $product->title }}" style="height: 20%">
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
                                            <div class="product-meta" style="margin-bottom: -2%">
                                                @if(!is_null($product->category))
                                                    <div class="product-categories">
                                                        <div class="ratings-container" style="font-size: 10px">
                                                            @if($averageRating == 1)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 20%;"></span>

                                                                </div>
                                                                <span style="margin-top: 3px;margin-left: -7%;font-size:14px;color:#7f00ff!important">({{count($product->reviews)}}) Ratings </span>

                                                            @elseif($averageRating == 2)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 40%;"></span>

                                                                </div>
                                                                <span style="margin-top: 3px;margin-left: -7%;font-size:14px;color:#7f00ff!important">({{count($product->reviews)}}) Ratings </span>

                                                            @elseif($averageRating == 3)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 60%;"></span>

                                                                </div>
                                                                <span style="margin-top: 3px;margin-left: -7%;font-size:14px;color:#7f00ff!important">({{count($product->reviews)}}) Ratings </span>

                                                            @elseif($averageRating == 4)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 80%;"></span>

                                                                </div>
                                                                <span style="margin-top: 3px;margin-left: -7%;font-size:14px;color:#7f00ff!important">({{count($product->reviews)}}) Ratings </span>

                                                            @elseif($averageRating == 5)
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 100%;"></span>

                                                                </div>
                                                                <span style="margin-top: 3px;margin-left: -7%;font-size:14px;color:#7f00ff!important">({{count($product->reviews)}}) Ratings </span>
                                                            @else
                                                                <div class="ratings-full">
                                                                    {{-- <span class="rating" style="width:0%;"></span> --}}
                                                                </div>
                                                                <span class="rating" style="margin-top: 3px;margin-left: -7%;font-size:14px;color:#7f00ff!important"> (0) Ratings </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="product-categories">

                                                        <h4 class="product-category">Category:<a href="{{route('category.products', ['id' => $product->category->id, 'slug' => \Illuminate\Support\Str::slug($product->category->title)])}}" style="text-decoration: none; color: #117a8b"> {{ $product->category->title }}</a></h4>
                                                    </div>
                                                @endif
                                                <div class="product-sku">
                                                    <h4>SKU: <span style="color: #7f00ff">{{ $product->code }}</span></h4>
                                                </div>


                                            </div>
                                        </div>
                                        <hr style="border: solid grey 1px">
                                        <div class="product-price" >
                                            @if($product->discount_price)
                                                <ins class="new-price  float-left" style="color: #7f00ff;"> &#2547; {{ $product->discount_price }} </ins><del class="old-price text-danger" > &#2547; {{ $product->price }} </del>
                                            @else
                                                <ins class="new-price float-left" style="color: #7f00ff;"> &#2547; {{$product->price}}</ins>
                                            @endif
                                        </div>
                                        <div class="product-meta">
                                            <!-- ShareThis BEGIN -->
                                            <div class="sharethis-inline-share-buttons"></div>
                                            <!-- ShareThis END -->
                                            <div class="product-sku mt-4">
                                                <h4>Stock Quantity: <span style="color: #117a8b">{{ $product->qty }}</span></h4>
                                            </div>
                                            <div class="product-sku mt-4">
                                                <h4>Product Weight: <span style="color:#117a8b">{{ $product->weight }}</span><span style="color:#117a8b">{{ $product->unit}}</span></h4>
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
                                                <div class="product-form">
                                                     <div class="product-quantity-inner">
                                                        {{-- <div class="row"> --}}
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="size"> <b> Size: </b></label>
                                                                    @foreach($product->variation as $size)
                                                                        <div class="form-check-inline">
                                                                            <a href="{{route('color.product',$size->id)}}" style="text-decoration: none">
                                                                                <input type="radio" class="form-check-input" name="size" value="{{$size->size_id}}" style="visibility: hidden">
                                                                                <div style="margin-left:6px; width: 42px;height: 31px;box-sizing: border-box; border: solid grey 0.5px;">
                                                                                    <p style="text-align: center;margin-top: 3px;">{{$size->size->name}}</p>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="product-thumbs-wrap">
                                                                        <label for="color"> <b>Color:</b></label>
                                                                        <div class="product-thumbs">
                                                                            @foreach($product->variation as $image)
                                                                                <div class="product-thumb" style="height: 100%;width: 47px;  " >
                                                                                    <input type="radio" class="form-check-input" name="color_id" value="{{$image->color_id}}" style="display:none;">
                                                                                    <div style="margin-left:6px; width: 77%;height: 34px;box-sizing: border-box; border-radius: 25%; background: {{$image->color->code}}"></div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                        <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                                                                        <button class="thumb-down disabled"><i class="w-icon-angle-right"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        {{-- </div> --}}
                                                         <hr >

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="input-group">
                                                                            <input type="button" value="-" onclick="quickViewQunatityIncr(event)" class="button-minus faruk_qty" data-field="quantity">
                                                                            <input type="text" step="1" readonly max="" value="1" name="qty" class="quantity-field">
                                                                            <input type="button" value="+" onclick="quickViewQunatityIncr(event)" class="button-plus faruk_qty" data-field="quantity">
                                                                        </div>
                                                                       {{-- <div class="form-group">
                                                                                <h4 for="quantity quantity buttons_added" style="color: #7f00ff"> <b>Quantity:</b></h4>
                                                                                    <button type="button" class="btn-sm my-button"  onclick="quickViewQunatityDec(event);" ><i class="fas fa-minus" style="color: #26252dcc;" ></i></button>
                                                                                    <input id="qty" type="text" name="qty" value="1" min="1" style="padding: 3%;margin:-3%;text-align: center;width:52%;font-size: 11px;" readonly>
                                                                                    <button type="button" class="btn-sm my-button" onclick="quickViewQunatityIncr(event)"><i class="fas fa-plus" style="color: #26252dcc;" ></i></button>
                                                                            </div> --}}
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
                                                <button type="submit" class="btn btn-sm btn-primary w-md mb-3 ad_wi_fu " onclick="event.preventDefault(); document.getElementById('add-to-cart-form').submit();" style="color: #fff; width: 58%;"><i class="w-icon-cart"></i>  Add to Cart</button>
                                                <button type="button" onclick="addToWishlist({{$product->id}})" class= "btn btn-sm  w-md mb-3 ad_wi_fu wish_list" style="color: #ffffff; width: 58%; background-color: orange"
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
                                    <div class="row mt-2" style="margin-bottom: -26%;">
                                        <div class="col-md-2">
                                            <h4>Share:</h4>
                                        </div>
                                        <div class="col-md-10 faruk_shear">
                                            <div class="social-btn-sp">
                                                {!! $shareButtons = Share::page(url('/product/'.$product->id))->facebook()->twitter()->linkedin()->whatsapp()->pinterest(); !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-6 mb-md-8">
                                    <aside class="sidebar-fixed right-sidebar" style="height: 100%; border: none" >
                                        <div class="sidebar-content " style="background-color: #cecbd703">
                                            <div class="sticky-sidebar">
                                                <div class="card mb-3">
                                                    <div class="card-header" style="height: 35px;">
                                                        <p>Delivery</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-2 mb-5">
                                                                <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/location.png" alt="">
                                                            </div>
                                                            <div class="col-md-10 mb-5">
                                                                <span style="font-size: 1.5em; ">69/J, Panthapath, Dhaka 1205</span>
                                                            </div>
                                                            <div class="col-md-2 mb-5">
                                                                <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/package.png" alt="">
                                                            </div>
                                                            <div class="col-md-7 mb-5">
                                                                <span style="font-size: 1.5em;">Standard Delivery</span><br>
                                                                <span style="font-size: 1.3rem;">2 - 4 day(s)</span>
                                                            </div>
                                                            <div class="col-md-3 mt-3">
                                                                @if($product->free_shipping == 1)
                                                                <del style="font-size: 1.3em; color: red"><b>&#2547; 55</b></del>
                                                                <span style="font-size: 1.3em; "><b>Free</b></span>
                                                                @else
                                                                <span style="font-size: 1.3em; "><b>&#2547; 55</b></span>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-2 mb-5">
                                                                <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/delivery.png" alt="">
                                                            </div>
                                                            <div class="col-md-7 mb-5">
                                                                <span style="font-size: 1.5em;">Out Side Of Dhaka</span>
                                                            </div>
                                                            <div class="col-md-3 mb-5">
                                                                @if($product->free_shipping == 1)
                                                                    <del style="font-size: 1.3em; color: red "><b>&#2547; 130</b></del>
                                                                    <span style="font-size: 1.3em; "><b>Free</b></span>
                                                                @else
                                                                    <span style="font-size: 1.3em; "><b>&#2547; 130</b></span>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-2 mb-5">
                                                                <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/cash-on-delivery.png" alt="">
                                                            </div>
                                                            <div class="col-md-10 mb-5">
                                                                <span style="font-size: 1.5em; ">Cash on Delivery Available</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- End of Widget Banner -->
                                                <div class="card mb-3">
                                                    <div class="card-header" style="height: 35px;">
                                                        <p>Service</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-2 mb-5">
                                                                <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/check.png" alt="">
                                                            </div>
                                                            <div class="col-md-10 mb-5">
                                                                <span style="font-size: 1.5em;">100% Authentic</span>
                                                            </div>
                                                            <div class="col-md-2 mb-5">
                                                                <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/check.png" alt="">
                                                            </div>
                                                            <div class="col-md-10 mb-5">
                                                                <span style="font-size: 1.5em;">7 days easy return</span><br>
                                                            </div>
                                                            @if($product->wa_gu == 'guarantee' || $product->wa_gu == 'warranty')
                                                                <div class="col-md-2 mb-5">
                                                                    <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/security.png" alt="">
                                                                </div>
                                                                <div class="col-md-10 mb-5">
                                                                        <span style="font-size: 1.5em;">
                                                                            {{$product->duration_time}}
                                                                            {{$product->duration == 'days' ? 'Days' : ''}}
                                                                            {{$product->duration == 'months' ? 'Months' : ''}}
                                                                            {{$product->duration == 'years' ? 'Years' : ''}}
                                                                            {{$product->w_g_type == 'seller'? 'Seller' : ''}}
                                                                            {{$product->w_g_type == 'brand'? 'Brand' : ''}}
                                                                            {{$product->w_g_type == 'seller_brand'? 'Seller & Brand' : ''}}
                                                                            {{$product->wa_gu == 'guarantee' ? 'Guarantee' : ''}}
                                                                            {{$product->wa_gu == 'warranty' ? 'Warranty' : ''}}
                                                                        </span>
                                                                </div>
                                                            @else
                                                                <div class="col-md-2 mb-5">
                                                                    <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/warranty.png" alt="">
                                                                </div>
                                                                <div class="col-md-10 mb-5">
                                                                    <span style="font-size: 1.5em;">No Warranty/Guarantee Available</span><br>
                                                                </div>
                                                            @endif
                                                            <div class="col-md-2 mb-3">
                                                                <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/refund.png" alt="">
                                                            </div>
                                                            <div class="col-md-10 mb-3">
                                                                <a href="{{route('refund-and-return.page')}}" target="_blank" style="font-size: 1.5em; text-decoration: none">Return and Refund policy</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <span style="font-size: 13px; ">Sold by</span> <br>
                                                                <span>{{ $product->user->name }}</span>
                                                            </div>
                                                            <div class="col-md-4  float-left">
                                                                <a class="" id="chat-btn"><i class="w-icon-chat"></i>&nbsp;Chat</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4" style="border: solid #e7e7e7 0.3px">
                                                                <div style="margin-bottom: 20px;font-size: 12px;line-height: 14px;height: 28px;color: #757575;">Positive Seller Ratings</div>
                                                                <div ><h3>{{number_format($positiveRatingsPercent)}}%</h3></div>
                                                            </div>
                                                            <div class="col-md-4" style="border: solid #e7e7e7 0.3px">
                                                                <div style="margin-bottom: 20px;font-size: 12px;line-height: 14px;height: 28px;color: #757575;">Ship on Time</div>
                                                                <div ><h3>85%</h3></div>
                                                            </div>
                                                            <div class="col-md-4" style="border: solid #e7e7e7 0.3px">
                                                                <div style="margin-bottom: 20px;font-size: 12px;line-height: 14px;height: 28px;color: #757575;">Chat Response Rate</div>
                                                                <div><h3>85%</h3></div>
                                                            </div>
                                                            <div class="col-md-12 text-center" style="box-sizing: border-box; border: solid #e7e7e7 0.3px">
                                                                <div class="mb-3 mt-3">
                                                                    <a href="{{route('vendor.visit.stor',['id' => $product->user_id, 'shop' => \Illuminate\Support\Str::slug($product->user->name)])}}" style="text-decoration: none; font-size: 160%;" >Visit Store</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div id="chat-window" style="margin-top: -20px;">
                            <div id="chat-header">
                                <h3>Chat with {{$product->user->name}}</h3>
                                <button id="chat-close-btn">X</button>
                            </div>
                            <div id="chat-messages">
                                <div class="message received">
                                    <p>Hi, how can I help you?</p>
                                    <span class="timestamp">10:00 AM</span>
                                </div>
{{--                                <div class="message sent">--}}
{{--                                    <p>Hi, how can I help you?</p>--}}
{{--                                    <span class="timestamp">10:01 AM</span>--}}
{{--                                </div>--}}
                                <input type="hidden" value="{{url('/product/'.$product->id.'/'.\Illuminate\Support\Str::slug($product->title).'')}}">
                            </div>
                            <form action="">
                                <div class="py-3" style="margin-top: -7%;position: fixed;">
                                    <img src="{{asset($product->image)}}" alt="" style="height: 10%;width: 10%;">
                                    <span class="d-inline-block text-truncate" style="max-width: 150px;">{{$product->title}}</span>
                                    <span><button style="border-radius: 28%;margin-left: 4%;color: #1e2608;background-color: #fded00;"><i class="fad fa-paper-plane"></i></button></span>
                                </div>
                                <div id="chat-input">
                                    <textarea placeholder="Type your message"></textarea>
                                    <button id="chat-send-btn">Send</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="card mb-3">
                            <div class="card-body">
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
                                                                 alt="{{ $product->title }}" style="height: 20%;">
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
                                                <div class="product-meta" style="margin-bottom: -2%">
                                                    @if(!is_null($product->category))
                                                        <div class="product-categories">
                                                            <div class="ratings-container" style="font-size: 10px">
                                                                @if($averageRating == 1)
                                                                    <div class="ratings-full">
                                                                        <span class="ratings" style="width: 20%;"></span>

                                                                    </div>
                                                                    <span style="margin-top: 3px;margin-left: -7%;font-size:14px;color:#7f00ff!important">({{count($product->reviews)}}) Ratings </span>

                                                                @elseif($averageRating == 2)
                                                                    <div class="ratings-full">
                                                                        <span class="ratings" style="width: 40%;"></span>

                                                                    </div>
                                                                    <span style="margin-top: 3px;margin-left: -7%;font-size:14px;color:#7f00ff!important">({{count($product->reviews)}}) Ratings </span>

                                                                @elseif($averageRating == 3)
                                                                    <div class="ratings-full">
                                                                        <span class="ratings" style="width: 60%;"></span>

                                                                    </div>
                                                                    <span style="margin-top: 3px;margin-left: -7%;font-size:14px;color:#7f00ff!important">({{count($product->reviews)}}) Ratings </span>

                                                                @elseif($averageRating == 4)
                                                                    <div class="ratings-full">
                                                                        <span class="ratings" style="width: 80%;"></span>

                                                                    </div>
                                                                    <span style="margin-top: 3px;margin-left: -7%;font-size:14px;color:#7f00ff!important">({{count($product->reviews)}}) Ratings </span>

                                                                @elseif($averageRating == 5)
                                                                    <div class="ratings-full">
                                                                        <span class="ratings" style="width: 100%;"></span>

                                                                    </div>
                                                                    <span style="margin-top: 3px;margin-left: -7%;font-size:14px;color:#7f00ff!important">({{count($product->reviews)}}) Ratings </span>
                                                                @else
                                                                    <div class="ratings-full">
                                                                        {{-- <span class="rating" style="width:0%;"></span> --}}
                                                                    </div>
                                                                    <span class="rating" style="margin-top: 3px;margin-left: -7%;font-size:14px;color:#7f00ff!important"> (0) Ratings </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="product-categories">
                                                            <h4 class="product-category">Category:<a href="{{route('category.products', ['id' => $product->category->id, 'slug' => \Illuminate\Support\Str::slug($product->category->title)])}}" style="text-decoration: none; color: #117a8b"> {{ $product->category->title }}</a></h4>
                                                        </div>
                                                    @endif
                                                    <div class="product-sku">
                                                        <h4>SKU: <span style="color: #7f00ff">{{ $product->code }}</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="border: solid grey 1px">
{{--                                            <p style="background-color: #a8b4bb;font-size: 1px;margin-top:-3%;">.</p>--}}
                                            <div class="product-price" >
                                                @if($product->discount_price)
                                                    <ins class="new-price  float-left" style="color: #7f00ff;"> &#2547; {{ $product->discount_price }} </ins><del class="old-price text-danger" > &#2547; {{ $product->price }} </del>
                                                @else
                                                    <ins class="new-price float-left" style="color: #7f00ff;"> &#2547; {{$product->price}}</ins>
                                                @endif
                                            </div>
                                            <div class="product-meta">
                                                <!-- ShareThis BEGIN -->
                                                <div class="sharethis-inline-share-buttons"></div>
                                                <!-- ShareThis END -->
                                                <div class="product-sku mt-4">
                                                    <h4>Stock Quantity: <span style="color:#117a8b">{{ $product->qty }}</span></h4>
                                                </div>
                                                <div class="product-sku mt-4">
                                                    <h4>Product Weight: <span style="color:#117a8b">{{ $product->weight }}</span><span style="color:#117a8b">{{ $product->unit}}</span></h4>
                                                </div>
                                            </div>
{{--                                            <p style="background-color: #a8b4bb;font-size: 1px;margin-top:0%;">.</p>--}}
                                            <hr style="border: solid grey 1px">
{{--                                             <hr class="product-divider">--}}
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
                                                                            <div class="input-group">
                                                                                <input type="button" value="-" onclick="quickViewQunatityDec(event);" class="button-minus faruk_qty" data-field="quantity">
                                                                                <input type="text" step="1" readonly max="" value="1" name="qty" class="quantity-field">
                                                                                <input type="button" value="+" onclick="quickViewQunatityIncr(event)" class="button-plus faruk_qty" data-field="quantity">
                                                                              </div>
                                                                            {{-- <div class="form-group">
                                                                                <h4 for="quantity quantity buttons_added" style="color: #7f00ff"> <b>Quantity:</b></h4>
                                                                                    <button type="button" class="btn-sm my-button"  onclick="quickViewQunatityDec(event);" ><i class="fas fa-minus" style="color: #26252dcc;" ></i></button>
                                                                                    <input id="qty" type="text" name="qty" value="1" min="1" style="padding: 3%;margin:-3%;text-align: center;width:52%;font-size: 11px;" readonly>
                                                                                    <button type="button" class="btn-sm my-button" onclick="quickViewQunatityIncr(event)"><i class="fas fa-plus" style="color: #26252dcc;" ></i></button>
                                                                            </div> --}}
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
                                                    <button type="submit" class="btn btn-sm btn-primary w-md mb-3 ad_wi_fu " onclick="event.preventDefault(); document.getElementById('add-to-cart-form').submit();" style="color: #fff;width: 58%;"><i class="w-icon-cart"></i>  Add to Cart</button>
                                                    <button type="button" onclick="addToWishlist({{$product->id}})" class= "btn btn-sm w-md mb-3 ad_wi_fu wish_list" style="color: #ffffff;width: 58%; background-color: orange; border-color: orange"
                                                       title="Add to wishlist"><i class="w-icon-heart"></i> Add to wishlist</button>
                                                </div>
                                            </div>
                                            {{-- <form action="{{route('wishlist.add', ['id' => $product->id])}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary" style="color: #fff;"><i class="w-icon-cart"></i> Add to Cart</button>
                                            </form> --}}
                                        </div>
                                        <div class="row mt-2" style="margin-bottom: -26%;">
                                            <div class="col-md-2">
                                                <h4>Share:</h4>
                                            </div>
                                            <div class="col-md-10 faruk_shear">
                                                <div class="social-btn-sp">
                                                    {!! $shareButtons = Share::page(url('/product/'.$product->id))->facebook()->twitter()->linkedin()->whatsapp()->pinterest(); !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-6 mb-md-8">
                                        <aside class="sidebar-fixed right-sidebar" style="height: 100%; border: none" >
                                            <div class="sidebar-content " style="background-color: #cecbd703">
                                                <div class="sticky-sidebar">
                                                    <div class="card mb-3">
                                                        <div class="card-header" style="height: 35px;">
                                                            <p>Delivery</p>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-2 mb-5">
                                                                    <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/location.png" alt="">
                                                                </div>
                                                                <div class="col-md-10 mb-5">
                                                                    <span style="font-size: 1.5em; ">69/J, Panthapath, Dhaka 1205</span>
                                                                </div>
                                                                <div class="col-md-2 mb-5">
                                                                    <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/package.png" alt="">
                                                                </div>
                                                                <div class="col-md-7 mb-5">
                                                                    <span style="font-size: 1.5em;">Standard Delivery</span><br>
                                                                    <span style="font-size: 1.3rem;">2 - 4 day(s)</span>
                                                                </div>
                                                                <div class="col-md-3 mt-3">
                                                                    @if($product->free_shipping == 1)
                                                                        <del style="font-size: 1.3em; color: red "><b>&#2547; 55</b></del>
                                                                        <span style="font-size: 1.3em; "><b>Free</b></span>
                                                                    @else
                                                                        <span style="font-size: 1.3em; "><b>&#2547; 55</b></span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-2 mb-5">
                                                                    <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/delivery.png" alt="">
                                                                </div>
                                                                <div class="col-md-7 mb-5">
                                                                    <span style="font-size: 1.5em;">Out Side Of Dhaka</span>
                                                                </div>
                                                                <div class="col-md-3 mb-5">
                                                                    @if($product->free_shipping == 1)
                                                                        <del style="font-size: 1.3em; color: red "><b>&#2547; 130</b></del>
                                                                        <span style="font-size: 1.3em; "><b>Free</b></span>
                                                                    @else
                                                                        <span style="font-size: 1.3em; "><b>&#2547; 130</b></span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-2 mb-5">
                                                                    <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/cash-on-delivery.png" alt="">
                                                                </div>
                                                                <div class="col-md-10 mb-5">
                                                                    <span style="font-size: 1.5em; ">Cash on Delivery Available</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!-- End of Widget Banner -->
                                                    <div class="card mb-3">
                                                        <div class="card-header" style="height: 35px;">
                                                            <p>Service</p>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-2 mb-5">
                                                                    <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/check.png" alt="">
                                                                </div>
                                                                <div class="col-md-10 mb-5">
                                                                    <span style="font-size: 1.5em;">100% Authentic</span>
                                                                </div>
                                                                <div class="col-md-2 mb-5">
                                                                    <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/check.png" alt="">
                                                                </div>
                                                                <div class="col-md-10 mb-5">
                                                                    <span style="font-size: 1.5em;">7 days easy return</span><br>
                                                                </div>
                                                                @if($product->wa_gu == 'guarantee' || $product->wa_gu == 'warranty')
                                                                    <div class="col-md-2 mb-5">
                                                                        <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/security.png" alt="">
                                                                    </div>
                                                                    <div class="col-md-10 mb-5">
                                                                        <span style="font-size: 1.5em;">
                                                                            {{$product->duration_time}}
                                                                            {{$product->duration == 'days' ? 'Days' : ''}}
                                                                            {{$product->duration == 'months' ? 'Months' : ''}}
                                                                            {{$product->duration == 'years' ? 'Years' : ''}}
                                                                            {{$product->w_g_type == 'seller'? 'Seller' : ''}}
                                                                            {{$product->w_g_type == 'brand'? 'Brand' : ''}}
                                                                            {{$product->w_g_type == 'seller_brand'? 'Seller & Brand' : ''}}
                                                                            {{$product->wa_gu == 'guarantee' ? 'Guarantee' : ''}}
                                                                            {{$product->wa_gu == 'warranty' ? 'Warranty' : ''}}
                                                                        </span>
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-2 mb-5">
                                                                        <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/warranty.png" alt="">
                                                                    </div>
                                                                    <div class="col-md-10 mb-5">
                                                                        <span style="font-size: 1.5em;">No Warranty/Guarantee Available</span><br>
                                                                    </div>
                                                                @endif
                                                                <div class="col-md-2 mb-3">
                                                                    <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/refund.png" alt="">
                                                                </div>
                                                                <div class="col-md-10 mb-3">
                                                                    <a href="{{route('refund-and-return.page')}}" target="_blank" style="font-size: 1.5em; text-decoration: none">Return and Refund policy</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <span style="font-size: 13px; ">Sold by</span> <br>
                                                                    <span>{{ $product->user->name }}</span>
                                                                </div>
                                                                <div class="col-md-4  float-left">
                                                                    <a class="" id="chat-btn"><i class="w-icon-chat"></i>&nbsp;Chat</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-4" style="border: solid #e7e7e7 0.3px">
                                                                    <div style="margin-bottom: 20px;font-size: 12px;line-height: 14px;height: 28px;color: #757575;">Positive Seller Ratings</div>
                                                                    <div ><h3>{{number_format($positiveRatingsPercent)}}%</h3></div>
                                                                </div>
                                                                <div class="col-md-4" style="border: solid #e7e7e7 0.3px">
                                                                    <div style="margin-bottom: 20px;font-size: 12px;line-height: 14px;height: 28px;color: #757575;">Ship on Time</div>
                                                                    <div ><h3>85%</h3></div>
                                                                </div>
                                                                <div class="col-md-4" style="border: solid #e7e7e7 0.3px">
                                                                    <div style="margin-bottom: 20px;font-size: 12px;line-height: 14px;height: 28px;color: #757575;">Chat Response Rate</div>
                                                                    <div><h3>85%</h3></div>
                                                                </div>
                                                                <div class="col-md-12 text-center" style="box-sizing: border-box; border: solid #e7e7e7 0.3px">
                                                                    <div class="mb-3 mt-3">
                                                                        <a href="{{route('vendor.visit.stor',['id' => $product->user_id, 'shop' => \Illuminate\Support\Str::slug($product->user->name)])}}" style="text-decoration: none; font-size: 160%;" >Visit Store</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </aside>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="chat-window">
                            <div id="chat-header">
                                <h3>Chat with {{$product->user->name}}</h3>
                                <button id="chat-close-btn">X</button>
                            </div>
                            <div id="chat-messages">
                                <div class="message received">
                                    <p>Hi, how can I help you?</p>
                                    <span class="timestamp">{{now('Asia/Dhaka')->format('h:i A')}}</span>
                                </div>
                                <form action="{{route('vendor.conversation.stor')}}" method="POST" id="message-form" style="margin-top: -5%;">
                                    @csrf
                                <input type="hidden" name="product_url" value="{{url('/product/'.$product->id.'/'.\Illuminate\Support\Str::slug($product->title).'')}}">
                                </form>
                            </div>
                            <div class="top_btn_fu">
                                <img src="{{asset($product->image)}}" alt="" style="margin-left: 2%; height: 10%;width: 10%;">
                                <span class="d-inline-block text-truncate" style="max-width: 150px;">{{$product->title}}</span>
                                <span><button onclick="event.preventDefault();document.getElementById('message-form').submit();" class="mobile_faruk"><i class="fa-solid fa-paper-plane"></i></button></span>
                            </div>
                            <form action="{{route('vendor.conversation.stor')}}" method="POST" style="margin-top: -5%;">
                                @csrf
                                <div id="chat-input">
                                    <textarea placeholder="Type your message" name="conversation"></textarea>
                                    <button type="submit" style="color: #5417fd;background-color: #b9cfdd;" id="chat-send-btn"><i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                    @endif
                    <div class="card mb-3 show-card">
                        <div class="card-header" style="height: 35px;">
                            <p>Delivery</p>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-2 mb-3">
                                        <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/location.png" alt="">
                                    </div>
                                    <div class="col-10 mb-3">
                                        <span >69/J, Panthapath, Dhaka 1205</span>
                                    </div>
                                    <div class="col-2 mb-3">
                                        <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/package.png" alt="">
                                    </div>
                                    <div class="col-7 mb-3">
                                        <span >Standard Delivery</span><br>
                                        <span style="font-size: 90%;" >2 - 4 day(s)</span>
                                    </div>
                                    <div class="col-3 mb-3">
                                        @if($product->free_shipping == 1)
                                            <del style="color: red "><b>&#2547; 55</b></del>
                                            <span ><b>Free</b></span>
                                        @else
                                            <span ><b>&#2547; 55</b></span>
                                        @endif
                                    </div>
                                    <div class="col-2 mb-3">
                                        <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/delivery.png" alt="">
                                    </div>
                                    <div class="col-7 mb-3">
                                        <span >Out Side Of Dhaka</span>
                                    </div>
                                    <div class="col-3 mb-3">
                                        @if($product->free_shipping == 1)
                                            <del style="color: red "><b>&#2547; 130</b></del>
                                            <span ><b>Free</b></span>
                                        @else
                                            <span><b>&#2547; 130</b></span>
                                        @endif
                                    </div>
                                    <div class="col-2 mb-3">
                                        <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/cash-on-delivery.png" alt="">
                                    </div>
                                    <div class="col-10">
                                        <span>Cash on Delivery Available</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Widget Banner -->
                    <div class="card mb-3 show-card">
                        <div class="card-header" style="height: 35px;">
                            <p>Service</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2 mb-3">
                                    <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/check.png" alt="">
                                </div>
                                <div class="col-10 mb-3">
                                    <span>100% Authentic</span>
                                </div>
                                <div class="col-2 mb-3">
                                    <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/check.png" alt="">
                                </div>
                                <div class="col-10 mb-3">
                                    <span >7 days easy return</span><br>
                                </div>
                                @if($product->wa_gu == 'guarantee' || $product->wa_gu == 'warranty')
                                    <div class="col-2 mb-3">
                                        <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/security.png" alt="">
                                    </div>
                                    <div class="col-10 ">
                                    <span>
                                        {{$product->duration_time}}
                                        {{$product->duration == 'days' ? 'Days' : ''}}
                                        {{$product->duration == 'months' ? 'Months' : ''}}
                                        {{$product->duration == 'years' ? 'Years' : ''}}
                                        {{$product->w_g_type == 'seller'? 'Seller' : ''}}
                                        {{$product->w_g_type == 'brand'? 'Brand' : ''}}
                                        {{$product->w_g_type == 'seller_brand'? 'Seller & Brand' : ''}}
                                        {{$product->wa_gu == 'guarantee' ? 'Guarantee' : ''}}
                                        {{$product->wa_gu == 'warranty' ? 'Warranty' : ''}}
                                    </span>
                                    </div>
                                @else
                                    <div class="col-2 mb-3">
                                        <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/warranty.png" alt="">
                                    </div>
                                    <div class="col-10 ">
                                        <span >No Warranty/Guarantee Available</span><br>
                                    </div>
                                @endif
                                <div class="col-2 mb-3">
                                    <img style="margin-right: 4%; width: 100%" src="{{asset('/')}}images/detail/refund.png" alt="">
                                </div>
                                <div class="col-10 mb-3">
                                    <a href="{{route('refund-and-return.page')}}" target="_blank" style="text-decoration: none">Return and Refund policy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 show-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-8">
                                    <span style="font-size: 13px; ">Sold by</span> <br>
                                    <span>{{ $product->user->name }}</span>
                                </div>
                                <div class="col-4 ">
                                    <a class="" id="chat-btn"><i class="w-icon-chat"></i>&nbsp;Chat</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4" style="border: solid #e7e7e7 0.3px">
                                    <div style="margin-bottom: 20px;font-size: 12px;line-height: 14px;height: 28px;color: #757575;">Positive Seller Ratings</div>
                                    <div ><h3>{{number_format($positiveRatingsPercent)}}%</h3></div>
                                </div>
                                <div class="col-4" style="border: solid #e7e7e7 0.3px">
                                    <div style="margin-bottom: 20px;font-size: 12px;line-height: 14px;height: 28px;color: #757575;">Ship on Time</div>
                                    <div ><h3>85%</h3></div>
                                </div>
                                <div class="col-4" style="border: solid #e7e7e7 0.3px">
                                    <div style="margin-bottom: 20px;font-size: 12px;line-height: 14px;height: 28px;color: #757575;">Chat Response Rate</div>
                                    <div><h3>85%</h3></div>
                                </div>
                                <div class="col-12 text-center" style="box-sizing: border-box; border: solid #e7e7e7 0.3px">
                                    <div class="mb-3 mt-3">
                                        <a href="{{route('vendor.visit.stor',['id' => $product->user_id, 'shop' => \Illuminate\Support\Str::slug($product->user->name)])}}" style="text-decoration: none; font-size: 110%;" >Visit Store</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header" style="height: 48px;">
                            <h3>Description</h3>
                        </div>
                        <div class="card-body" >
                            <section class="description-section">
                                {!! $product->description !!}
                            </section>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header" style="height: 48px;">
                            <h3>Specifications</h3>
                        </div>
                        <div class="card-body" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="product-meta">
                                        <div class="product-sku mt-4">
                                            <h5 style="color: grey">Brand</h5>
                                            <p style="margin-top: -2%;font-size: inherit;">{{$product->brand->title}}</p>
                                        </div>
                                    </div>
                                </div>
                                @if($product->product_quality)
                                    <div class="col-md-6">
                                        <div class="product-meta">
                                            <div class="product-sku mt-4">
                                                <h5 style="color: grey">Product Quality</h5>
                                                <p style="margin-top: -2%;font-size: inherit;">{{$product->product_quality == 'fragile' ? 'Fragile' : ''}}{{$product->product_quality == 'liquid' ? 'Liquid' : ''}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($product->free_shipping)
                                    <div class="col-md-6">
                                        <div class="product-meta">
                                            <div class="product-sku mt-4">
                                                <h5 style="color: grey">Free Shipping</h5>
                                                <p style="margin-top: -2%;font-size: inherit;">{{$product->free_shipping == 1 ? 'Yes' : 'No'}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($product->origin_country_id)
                                    <div class="col-md-6">
                                        <div class="product-meta">
                                            <div class="product-sku mt-4">
                                                <h5 style="color: grey">Product Origin</h5>
                                                <p style="margin-top: -2%;font-size: inherit;">{{$product->origin_country->name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($product->cross_border == 1)
                                    <div class="col-md-6">
                                        <div class="product-meta">
                                            <div class="product-sku mt-4">
                                                <h5 style="color: grey">Product Cross Border</h5>
                                                <p style="margin-top: -2%;font-size: inherit;">{{$product->country->name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body" >
                            <section class="review-section">
                                <div class="title-link-wrapper no-link">
                                    <h3 class="title title-link">Customer Reviews</h3>
                                </div>
                                <div class="pt-4 pb-1" id="product-tab-reviews">
                                    <div class="row mob_ver">
                                        <div class="col-xl-4 col-lg-5" >
                                            <div class="ratings-wrapper">
                                                <div class="avg-rating-container">
                                                    @if($averageRating==Null)
                                                        <h4 class="avg-mark font-weight-bolder faruk_avg" style="margin-bottom: 24%;margin-left: 0%;">0.0/5</h4>
                                                        <div class="ratings-full faruk_rating">
                                                            <span class="ratings" style="width:0%;"></span>
                                                        </div>
                                                        <h6 class="count_reting">({{$total}})&nbsp;Ratings</h6>
                                                    @else
                                                        <h4 class="avg-mark font-weight-bolder faruk_avg" style="margin-bottom: 82px;">{{number_format($averageRating,1)}}/5</h4>
                                                        <div class="ratings-container faruk_rating">
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
                                                        <h6 class="count_reting">({{$total}})&nbsp;Ratings</h6>
                                                    @endif
                                                    <div class="avg-rating mobile_faruk_avg">
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
                                                    <hr class="hr_line">
                                                    <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your Review</h3>
                                                    <p class="mb-3 authentic_buyer">Only authentic buyer can submit a review. Required
                                                        fields are marked *</p>
                                                    <form action="{{route('submit.rating')}}" method="POST" class="review-form" enctype="multipart/form-data">
                                                        @csrf
                                                        {{--  @dd(Auth::user())--}}
                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                        <div class="rating-form">
                                                            <label for="rating">Rate This Product :</label>
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
                                                                <input type="file" name="gallery[]" class="form-control" id="images" onchange="checkFiles()"  multiple>
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
                                                        <button type="submit" class="btn-primary" style="height: 47px; border: none">Submit Review</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-xl-8 col-lg-7 mb-4">
                                                <div class="review-form-wrapper">
                                                    <hr class="hr_line">
                                                    <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                        Review</h3>
                                                    <p class="mb-3 authentic_buyer">Only authentic buyer can submit a review. Required
                                                        fields are marked *</p>
                                                    <form action="{{route('submit.rating')}}" method="POST" class="review-form" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                        <div class="rating-form" >
                                                            <label for="rating">Rate This Product :</label>
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
                                                        <button type="submit" class="btn-primary" style="height: 47px;border: none">Submit Review</button>
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

                    @if(count($rating_reviews) > 0)
                    <div class="card mb-3">
                        <div class="card-header" style="height: 48px;" >
                            <h3>Product Reviews</h3>
                        </div>
                        <div class="card-body" >
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
                                    <div class="col-lg-12">
                                        <span class="text-truncate" style="max-width: 64px;">by {{$rating_review->name}} </span><span style="color:rgb(32, 109, 83)"> <i class="fa-solid fa-circle-check"> </i> Verified</span>
                                        <p class="text-left">{{$rating_review->created_at->diffForHumans()}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="title-link-wrapper no-link">
                                            <p>{{$rating_review->review}}</p>
                                        </div>
                                        @foreach($rating_review->reviewImages as $rating_review_image)
                                            <img src="{{asset($rating_review_image->images)}}" alt="Images" class="mb-5 mob_image">
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            {{ $rating_reviews->links('pagination::bootstrap-4', ['prev_text' => 'Previous', 'next_text' => 'Next']) }}
{{--                            <div class="float-right">--}}
{{--                                {{ $rating_reviews->links('pagination::bootstrap-4', ['prev_text' => 'Previous', 'next_text' => 'Next']) }}--}}
{{--                            </div>--}}
{{--                            {{ $rating_reviews->links('pagination::bootstrap-4') }}--}}
                        </div>
                    </div>
                    @endif
{{--                    <div class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">--}}
{{--                        @foreach($similar_products as $product)--}}
{{--                            @include('partials.review_cart')--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
                        <h3 style="margin-top: 30px">Product on this vendor</h3>
                        <hr style="border: solid grey 1px">
                        <div class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                            @foreach($vendor_products as $product)
                                @include('partials.product')
                            @endforeach
                        </div>
                        <h3>Similiar Product</h3>
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





<style>
    #chat-window {
        position: fixed;
        bottom: 0;
        right: 11%;
        width: 300px;
        height: 400px;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        display: none;
        z-index: 9999;
    }

    #chat-header {
        background-color: #f2f2f2;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #chat-header h3 {
        margin: 0;
        font-size: 16px;
    }

    #chat-close-btn {
        border: none;
        background-color: transparent;
        font-size: 18px;
        cursor: pointer;
    }

    #chat-messages {
        height: 300px;
        padding: 10px;
        overflow-y: scroll;
    }

    .message {
        margin-bottom: 10px;
        max-width: 80%;
    }

    .received {
        background-color: #f2f2f2;
        padding: 10px;
        border-radius: 10px 10px 0 10px;
        align-self: flex-start;
    }

    .sent {
        background-color: #0099ff;
        color: white;
        padding: 10px;
        border-radius: 10px 10px 10px 0;
        align-self: flex-end;
    }

    .timestamp {
        display: block;
        font-size: 12px;
        margin-top: 5px;
        text-align: right;
    }

    #chat-input {
        display: flex;
        align-items: center;
        padding: 10px;
    }

    #chat-input textarea {
        flex: 1;
        height: 40px;
        border: none;
        border-radius: 5px;
        resize: none;
        padding: 5px;
        font-size: 14px;
    }

    #chat-input button {
        border: none;
        background-color: #0099ff;
        color: white;
        padding: 10px;
        border-radius: 5px;
        margin-left: -45px;
        cursor: pointer;
    }

    #chat-input button:hover {
        background-color: #0077cc;
    }


</style>

<script>
    // Get the button and chat window elements
    const chatBtn = document.getElementById('chat-btn');
    const chatWindow = document.getElementById('chat-window');
    const chatCloseBtn = document.getElementById('chat-close-btn');

    // Add a click event listener to the button
    chatBtn.addEventListener('click', () => {
        // Toggle the chat window display
        if (chatWindow.style.display === 'none') {
            chatWindow.style.display = 'block';
        } else {
            chatWindow.style.display = 'none';
        }
    });
    chatCloseBtn.addEventListener('click', () => {
        // Hide the chat window
        chatWindow.style.display = 'none';
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

