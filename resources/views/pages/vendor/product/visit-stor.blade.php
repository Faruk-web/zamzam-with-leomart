@extends('layouts.vendor-master')

@section('title')
	{{ ('All Products') . ' | '. env('APP_NAME') }}
@endsection
@section('content')

<style>
     @media only screen and (max-width:600px) {
        .float-right{
                    float:left!important;
                }
            }
</style>

	<!-- Start of Main -->
        <main class="main">
            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container">
                    <!-- Start of Shop Banner -->
                       <div class="row">
                          <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img style="margin-right: 4%; width: 100%" src="http://127.0.0.1:8000/images/website/1677068421.png" alt="">
                                        </div>
                                        <div class="col-md-6 ">
                                            <h3>{{$user_info->name}}</h3>
                                        </div>
                                        <div class="col-md-2 ">
                                            <div class="product-sku">
                                                <a href="#" class="float-right" style="text-decoration: none; font-size: 20px" id="chat-btn">
                                                    <span><i class="w-icon-chat"></i></span>
                                                    <h5>
                                                        Chat
                                                    </h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-2 ">
                                            <div class="product-sku">
                                            <a href="#" class="float-right" style="text-decoration: none; font-size: 20px" id="chat-btn">
                                                <span><i class="w-icon-chat"></i></span>
                                                <h5>
                                                    Follow
                                                </h5>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            <h5>Followers | 13325 Followers</h5>
                                            <h5>92% Positive Seller Ratings</h5>
                                        </div>
                                        <div class="col-md-6 float-right text-center">
                                            <br>
                                            <h5>Total Product Of This Store:&nbsp;{{count($v_products)}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center mb-6"
                                style="background-image: url(http://leomart.leotechbd.com/images/website/1643714118.jpg); background-color: #FFC74E;">
                                <div class="container banner-content" style="height:22px;">

                                </div>
                            </div>
                          </div>
                     </div>
                      <!-- Start of Breadcrumb -->
                        <nav class="breadcrumb-nav">
                            <div class="container">
                                <ul class="menu active-underline">
                                    <li class="{{ Route::currentRouteName() == 'index' ? 'active' : '' }}">
                                        <a href="{{ url('vendor/visit/stor') }}" style="text-decoration: none;">Home Page</a>
                                    </li>
                                    <li class="{{ Route::currentRouteName() == 'products' ? 'active' : '' }}">
                                        <a href="{{ route('products') }}" style="text-decoration: none;">All Products</a>
                                    </li>
                                    <li class="{{ Route::currentRouteName() == 'offer.products' ? 'active' : '' }}">
                                        <a href="{{url('home/profile') }}" style="text-decoration: none;">Profile</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="header-left mr-md-4 ">
                                <form method="get" action="{{ route('search.result') }}" class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper" style="border-left: 2px solid #336699; margin-left: -188px !important;" autocomplete="off">
                                    @csrf

                                    <input type="text" class="form-control" name="search" id="search" placeholder="Search in..." required />
                                    <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                                    </button>
                                </form>
                            </div>
                        </nav>
                    <!-- End of Breadcrumb -->
                    <!-- End of Shop Banner -->



                    <!-- Start of Shop Content -->
                    <div class="shop-content row gutter-lg mb-5 mt-5">

                        <div class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                            @foreach($products as $product)
                                @include('partials.product')
                            @endforeach
                        </div>
                        {{ $products->links('pagination::bootstrap-4', ['prev_text' => 'Previous', 'next_text' => 'Next']) }}

                        <div class="toolbox toolbox-pagination justify-content-between">
                            <!-- <p class="showing-info mb-2 mb-sm-0">
                                Showing<span>1-12 of 60</span>Products
                            </p> -->
                            <ul class="pagination">

                            </ul>
                        </div>
                    </div>
                    <!-- End of Shop Content -->
                    {{-- <div id="chat-window">
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
                    </div> --}}
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->

@endsection

@section('scripts')
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
<script>
    $(document).ready(function() {
        $("input[type='radio']").change(function() {

            var category_id = $("input[name='category']:checked").val();
            var brand_id = $("input[name='brand']:checked").val();
            var min_price = $('#lower').val();
            var max_price = $('#upper').val();
            url = "{{ route('product.filter') }}";
            $.ajax({
                url: url,
                type: "POST",
                data:{
                    category_id:category_id,brand_id:brand_id,min_price: min_price,max_price: max_price,_token: '{{csrf_token()}}',
                },
                success:function(response){
                    console.log(response.product_filtered);
                    $('#product_filtered').html(response.product_filtered);
                }
            });

        });
    });
</script>
<script>
    var lowerSlider = document.querySelector('#lower');
    var  upperSlider = document.querySelector('#upper');

    document.querySelector('#two').value=upperSlider.value;
    document.querySelector('#one').value=lowerSlider.value;

    var  lowerVal = parseInt(lowerSlider.value);
    var upperVal = parseInt(upperSlider.value);

    upperSlider.oninput = function () {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);

        if (upperVal < lowerVal + 4) {
            lowerSlider.value = upperVal - 4;
            if (lowerVal == lowerSlider.min) {
            upperSlider.value = 4;
            }
        }
        document.querySelector('#two').value=this.value
    };

    lowerSlider.oninput = function () {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);
        if (lowerVal > upperVal - 4) {
            upperSlider.value = lowerVal + 4;
            if (upperVal == upperSlider.max) {
                lowerSlider.value = parseInt(upperSlider.max) - 4;
            }
        }
        document.querySelector('#one').value=this.value
    };

    function product_price_filter() {
        var category_id = $("input[name='category']:checked").val();
        var brand_id = $("input[name='brand']:checked").val();
        var min_price = $('#lower').val();
        var max_price = $('#upper').val();
        url = "{{ route('product.filter') }}";
        $.ajax({
            url: url,
            type: "POST",
            data:{
                category_id:category_id,brand_id:brand_id,min_price: min_price,max_price: max_price,_token: '{{csrf_token()}}',
            },
            success:function(response){
                console.log(response.product_filtered);
                $('#product_filtered').html(response.product_filtered);
            }
        });
    }
</script>
@endsection

