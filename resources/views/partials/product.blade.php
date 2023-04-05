@push('css')
    <style>
        /* .faruk:hover{
            box-shadow: 10px 10px 5px lightblue;
        } */
        .product-cart:hover {
        background-color: #7c2626!important;
        display: flex;
  flex-direction: column;
  height: 250px; /* set a fixed height for the product cart */
  border: 1px solid #ccc;
  padding: 10px;
      }

    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endpush
@if(!empty($product))
@php
    $averageRating = $product->reviews->max('rating');
    // dd($averageRating);

@endphp
    <div class="product-wrap text-center">
        <section class="category-section top-category appear-animate">
            <div class="card-deck" style=" display: flex;
            flex-direction: column;
            height:384px; /* set a fixed height for the product cart */
           ">
                {{-- <div class="card faruk product-cart" style="box-shadow: 10px 10px 5px lightblue;"> --}}
                    <div class="card category-classic category-absolute br-xs mb-8">
                        @if($product->discount_price)
                        @php
                            $subtract=(($product->price)-($product->discount_price));
                            $discount=$subtract/($product->discount_price);
                            $percentase=$discount*100;
                        @endphp
                        <span class="p-discount">-{{round($percentase)}}%</span>
                        @endif
                        @if($product->countPositiveRatings() >= 3)
                        <span class="p-rating" style="margin-top: 0px"><img src="{{asset('/')}}images/rank.png" alt="">Top rated</span>
                        @endif
                    <figure class="product-media">
                            <a href="{{ route('single.product', [$product->id, Str::slug($product->title)]) }}">
                                <img class="card-img-top" src="{{asset($product->image)}}"  alt="" style="height: 200px; width: 200px"/>
                            </a>
                        <div class="product-action-vertical">
                            <a onclick="addToCart({{ $product->id }})" class="btn-product-icon w-icon-cart peoduct_cart"
                               title="Add to cart"></a>
                            <a onclick="addToWishlist({{ $product->id }})" class="btn-product-icon w-icon-heart peoduct_cart"
                               title="Add to wishlist"></a>
                            <!-- <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a> -->
                            <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                title="Add to Compare"></a> -->
                        </div>
                    </figure>

                    <div class="card-body product-cart">
                        <div class="product-details">
                            <div class="row" style="height: 50px">
                                <div class="col-md-12 mb-2">
                                    <h5 style="; text-align:left;margin-bottom: 0.8rem!important;font-size: 1.5rem!important; font-weight: 500!important;display: -webkit-box;
                                    -webkit-box-orient: vertical!important;
                                    -webkit-line-clamp:2!important;
                                    overflow: hidden;width: 100%;
                                    text-overflow: ellipsis;">
                                        <a href="{{ route('single.product', [$product->id, Str::slug($product->title)]) }}" style="text-decoration: none;" class="text-dark">{{ $product->title }}</a>
                                    </h5>
                                </div>
                            </div>
                            <div class="card-text h-100">
                               <div class="row">
                                   <div class="col-md-12 mb-2">
                                       <div class="product-price">
                                           @if($product->discount_price)
                                               <ins class="new-price  float-left" style="color: #7f00ff;"> &#2547; {{ $product->discount_price }} </ins><del class="old-price text-danger float-right" > &#2547; {{ $product->price }} </del>
                                           @else
                                               <ins class="new-price float-left" style="color: #7f00ff;"> &#2547; {{$product->price}}</ins>
                                           @endif
                                       </div>
                                   </div>
                               </div>
                                <div class="row" style="margin-bottom: -12px;">
                                    <div class="@if($product->free_shipping == 1) col-md-6 @else col-md-12 @endif">
                                        <div class="ratings-container" style="font-size: 10px">
                                            @if($averageRating == 1)
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 20%;"></span>
                                            </div>
                                            <span style="margin-top: 3px">({{count($product->reviews)}})</span>
                                            @elseif($averageRating == 2)
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 40%;"></span>
                                            </div>
                                            <span style="margin-top: 3px">({{count($product->reviews)}})</span>
                                            @elseif($averageRating == 3)
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 60%;"></span>
                                            </div>
                                            <span style="margin-top: 3px">({{count($product->reviews)}})</span>
                                            @elseif($averageRating == 4)
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 80%;"></span>
                                            </div>
                                            <span style="margin-top: 3px">({{count($product->reviews)}})</span>
                                            @elseif($averageRating == 5)
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 100%;"></span>
                                            </div>
                                            <span style="margin-top: 3px">({{count($product->reviews)}})</span>
                                            @else
                                            <div class="ratings-full">
{{--                                                 <span class="rating" ></span>--}}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if($product->free_shipping == 1)
                                        <div class="col-md-6" style="margin-top: -4px">
                                            <img src="{{asset('/')}}images/free-shipping.png" alt="" class="float-right" style="height: 28px;width: 32px;margin-top: 0px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



@endif
