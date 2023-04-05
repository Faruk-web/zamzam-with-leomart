@extends('layouts.home-master')

@section('content')

           @include('partials.slider')

            <div class="shipping container">
                <div class="owl-carousel owl-theme row cols-md-4 cols-sm-3 cols-1icon-box-wrapper appear-animate br-sm mt-6 mb-6"
                    data-owl-options="{
                    'nav': false,
                    'dots': false,
                    'loop': false,
                    'responsive': {
                        '0': {
                            'items': 1
                        },
                        '576': {
                            'items': 2
                        },
                        '768': {
                            'items': 3
                        },
                        '992': {
                            'items': 3
                        },
                        '1200': {
                            'items': 4
                        }
                    }
                }">
                    <div class="icon-box icon-box-side icon-box-primary">
                        <span class="icon-box-icon icon-shipping">
                            <i class="w-icon-truck"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">Free Shipping & Returns</h4>
                            <p class="text-default">For all orders over $99</p>
                        </div>
                    </div>
                    <div class="icon-box icon-box-side icon-box-primary">
                        <span class="icon-box-icon icon-payment">
                            <i class="w-icon-bag"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">Secure Payment</h4>
                            <p class="text-default">We ensure secure payment</p>
                        </div>
                    </div>
                    <div class="icon-box icon-box-side icon-box-primary icon-box-money">
                        <span class="icon-box-icon icon-money">
                            <i class="w-icon-money"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">Money Back Guarantee</h4>
                            <p class="text-default">Any back within 30 days</p>
                        </div>
                    </div>
                    <div class="icon-box icon-box-side icon-box-primary icon-box-chat">
                        <span class="icon-box-icon icon-chat">
                            <i class="w-icon-chat"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">Customer Support</h4>
                            <p class="text-default">Call or email us 24/7</p>
                        </div>
                    </div>
                </div>



            </div>


            <section class="category-section top-category bg-grey pt-5 pb-10 appear-animate">
                <div class="container pb-2">
                    <h2 class="title justify-content-center pt-1 ls-normal mb-5">Category</h2>
                    <div class=" row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                        @foreach($categories as $category)
                            <div class="category category-classic category-absolute br-xs mb-2">
                                <a href="{{ route('category.products', [$category->id, Str::slug($category->title)]) }}" class="category-media" style="text-decoration: none;">
                                    <img src="{{ asset('images/category/'. $category->image) }}" alt="Category" width="130" height="130">
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name">{{ $category->title }}</h4>
                                    <a href="{{ route('category.products', [$category->id, Str::slug($category->title)]) }}" class="btn btn-primary btn-link btn-underline" style="text-decoration: none;">{{ $category->title }}</a>
                                </div>
                            </div>
                            @endforeach
                    </div>
                </div>
            </section>
            <!-- End of .category-section top-category -->

            <div class="container">
                @foreach($featured_categories as $category)
                    <div class="page-content">

                        <div class="container-fluid">

                            <!-- Start of Shop Content -->
                            <div class="shop-content" style="margin-bottom: -5%">
                                <div class="title-link-wrapper">
                                    <h2 class="title ls-normal ">{{$category->title}}</h2>
                                    <a href="{{ route('category.products', ['id' => $category->id, 'slug' => \Illuminate\Support\Str::slug($category->title)]) }}" class="font-weight-bold ls-25 " style="text-decoration: none;font-size: 18px" >More Category
                                        Products<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                                <div class="main-content">

                                    <div class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">

                                        @foreach($category->product->take(12) as $product)
                                            @include('partials.product')
                                        @endforeach
                                    </div>

                                    <div class="toolbox toolbox-pagination justify-content-between">
                                        <!-- <p class="showing-info mb-2 mb-sm-0">
                                            Showing<span>1-12 of 60</span>Products
                                        </p> -->
                                        <ul class="pagination">

                                        </ul>
                                    </div>
                                </div>
                                <!-- End of Shop Main Content -->


                            </div>
                            <!-- End of Shop Content -->
                        </div>
                    </div>
                @endforeach
            @php
            $business=App\Models\Setting::find(1);
            @endphp
            @if($business->offer_image_status == 1)
            <div class="modal fade" id="bppshops_promo" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content" style="width: auto">
                        <div class="modal-body p-0">
                            <button class="top-0 end-0 m-3 float-right" data-dismiss="modal"
                                aria-label="Close">&times;</button>
                            <img class="img-fluid" src="{{ asset('images/website/'.$business->offer_img) }}" alt="bppshops"
                                srcset="">
                        </div>
                    </div>
                </div>
            </div>
            @endif

         <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                var myModal = new bootstrap.Modal(document.getElementById('bppshops_promo'));
                myModal.show();
            });
        </script>

                    <div class="page-content">

                        <div class="container-fluid">

                            <!-- Start of Shop Content -->
                            <div class="shop-content" style="margin-bottom: -5%">
                                <div class="title-link-wrapper">
                                    <h2 class="title ls-normal ">{{('Our Products')}}</h2>
                                    <a href="{{ route('products') }}" class="font-weight-bold ls-25 " style="text-decoration: none;font-size: 18px" >More
                                        Products<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                                <div class="main-content">

                                    <div class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">

                                        @foreach($random_products as $product)
                                            @include('partials.product')
                                        @endforeach
                                    </div>

                                    <div class="toolbox toolbox-pagination justify-content-between">
                                        <!-- <p class="showing-info mb-2 mb-sm-0">
                                            Showing<span>1-12 of 60</span>Products
                                        </p> -->
                                        <ul class="pagination">

                                        </ul>
                                    </div>
                                </div>
                                <!-- End of Shop Main Content -->


                            </div>
                            <!-- End of Shop Content -->
                        </div>
                    </div>

                <!-- End of Product Wrapper 1 -->

                    <div class="page-content">

                        <div class="container-fluid">
                            @php
                                foreach($vendor_products as $product){

}
                            @endphp

                            <!-- Start of Shop Content -->
                            <div class="shop-content" style="margin-bottom: -5%">
                                <div class="title-link-wrapper">
                                    <h2 class="title ls-normal ">{{('Vendor Products')}}</h2>
                                    <a href="{{route('vendor.visit.stor',['id' => $product->user_id, 'shop' => \Illuminate\Support\Str::slug($product->user->name)])}}" class="font-weight-bold ls-25 "style="text-decoration: none;font-size: 18px" >More
                                        Products<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                                <div class="main-content">

                                    <div class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">

                                        @foreach($vendor_products as $product)
                                            @include('partials.product')
                                        @endforeach
                                    </div>

                                    <div class="toolbox toolbox-pagination justify-content-between">
                                        <!-- <p class="showing-info mb-2 mb-sm-0">
                                            Showing<span>1-12 of 60</span>Products
                                        </p> -->
                                        <ul class="pagination">

                                        </ul>
                                    </div>
                                </div>
                                <!-- End of Shop Main Content -->


                            </div>
                            <!-- End of Shop Content -->
                        </div>
                    </div>
                <!-- End of Product Wrapper 1 -->
            </div>
            <!--End of Catainer -->

@endsection
