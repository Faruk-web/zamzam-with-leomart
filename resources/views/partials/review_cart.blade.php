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

@endpush
@if(!empty($product))
@php
    $averageRating = $product->reviews->avg('rating');
    // dd($averageRating);
@endphp
    <div class="product-wrap text-center">
        <section class="category-section top-category appear-animate">
            <div class="card-deck" style=" display: flex;
            flex-direction: column;
            height:220px; /* set a fixed height for the product cart */
           ">
                {{-- <div class="card faruk product-cart" style="box-shadow: 10px 10px 5px lightblue;"> --}}
                    <div class="card category-classic category-absolute br-xs mb-8">
                    <figure class="product-media">
                            <a href="{{ route('single.product', [$product->id, Str::slug($product->title)]) }}">
                                <img class="card-img-top" src="{{asset($product->image)}}"  alt="" style="height: 200px; width: 200px"/>
                            </a>
                        <div class="product-action-vertical">
                            <a onclick="addToCart({{ $product->id }})" class="btn-product-icon w-icon-cart peoduct_cart"
                               title="Add to cart"></a>
                            <a onclick="addToWishlist({{ $product->id }})" class="btn-product-icon w-icon-heart peoduct_cart"
                               title="Add to wishlist"></a>
                        </div>
                    </figure>

                    {{-- <div class="card-body product-cart">
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
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
    </div>



@endif
