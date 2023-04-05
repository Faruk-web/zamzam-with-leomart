@extends('admin.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" target="_blank">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <style>
        #myDiv {
            display: none;
        }

        #myDiv2 {
            display: none;
        }
        #variation {
            display: none;
        }
        #noVariation {
            display: none;
        }
        #crossBorder {
            display: none;
        }
        #preOrder {
            display: none;
        }
    </style>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('vendor.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="row">
                                                    <div class="form-group col-md-9">
                                                        <div class="form-check form-check-inline my-checkbox">
                                                            <input class="form-check-input group1" id="retail" type="checkbox" checked name="retail" value="1">
                                                            <label class="form-check-label" for="retail">Retail</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="row">
                                                    <div class="form-group col-md-9">
                                                        <div  class="form-check form-check-inline my-checkbox">
                                                            <input class="form-check-input group1" id="wholesale" type="checkbox" name="wholesale" value="1">
                                                            <label class="form-check-label" for="wholesale">Wholesale</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="row">
                                                    <div class="form-group col-md-9">
                                                        <div class="form-check form-check-inline my-checkbox">
                                                            <input class="form-check-input group1" id="noCrossCheck" type="checkbox" name="cross_border" value="1">
                                                            <label class="form-check-label" for="noCrossCheck">Cross Border</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="row">
                                                    <div class="form-group col-md-9">
                                                        <div class="form-check form-check-inline my-checkbox">
                                                            <input class="form-check-input group1" id="preOrderCheck" type="checkbox" name="pre_order" value="1">
                                                            <label class="form-check-label" for="preOrderCheck">Pre-order</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="productname">Product Name</label>
                                            <input id="productname" name="title" type="text" class="form-control" placeholder="Product Name" @error('title') is-invalid @enderror  />
                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
			                        <strong>{{ $message }}</strong>
                                  </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="control-label">Select Category</label>
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option selected disabled>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="control-label">Sub Category</label>
                                            <select id="sub_category" name="sub_category_id" class=" form-control @error('sub_category_id') is-invalid @enderror">
                                                <option value="">Please Select a Sub Category</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="manufacturername">Brand</label>
                                            <select name="brand_id" class="form-control select2-custom">
                                                <option selected disabled>Select Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="code">Product Code</label>
                                            <input id="code" name="code" type="text" class="form-control" placeholder="Product Code">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="datetime">Product Weight</label>
                                            <input type="number" min="1" name="weight" class="form-control" placeholder="Product Weight"/>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="unit" id="gm" value="gm">
                                                <label class="form-check-label" for="gm">gm</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="unit" id="kg" value="kg">
                                                <label class="form-check-label" for="kg">kg</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="unit" id="ml" value="ml">
                                                <label class="form-check-label" for="ml">ml</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="unit" id="litter" value="litter">
                                                <label class="form-check-label" for="litter">litter</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 variation">
                                        <div class="row">
                                            <div class="form-group col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="product_variation" id="variationCheck" value="1">
                                                    <label for="variationCheck" class="form-check-label">Product Variation</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 variation">
                                        <div class="row">
                                            <div class="form-group col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="product_variation" id="noVariationCheck" value="2">
                                                    <label for="noVariationCheck" class="form-check-label">Product No Variation</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" id="variation">
                                        <div class="row">
                                            <div class="col-sm-6" >
                                                <div class="mb-3">
                                                    <label for="price">Image</label>
                                                    <input type="file" name="variation_image[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6" >
                                                <div class="mb-3">
                                                    <label for="price">Color</label>
                                                    <select class="select2 form-control" name="color_id[]" data-placeholder="Choose ...">
                                                        <option value="">Select color</option>
                                                        @foreach($colors as $color)
                                                            <option value="{{$color->id}}">{{$color->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6" >
                                                <div class="mb-3">
                                                    <label for="price">Size</label>
                                                    <select class="select2 form-control" name="size_id[]" data-placeholder="Choose ...">
                                                        <option value="">Select Size</option>
                                                        @foreach($sizes as $size)
                                                            <option value="{{$size->id}}">{{$size->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="manufacturerbrand">Stock Quantity</label>
                                                    <input id="manufacturerbrand" name="qty[]" type="number" min="1" class="form-control" placeholder="Stock Quantity">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="price">Original Price</label>
                                                    <input id="price" name="price[]" type="number" class="form-control" placeholder="Original Price">
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="price">Offer Price</label>
                                                    <input id="price" name="discount_price[]" type="number" class="form-control" placeholder="Offer Price">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="price">Offer Start</label>
                                                    <input id="offer" name="offer_start[]" type="date" class="form-control" placeholder="Original Price">
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="price">Offer End</label>
                                                    <input id="price" name="offer_end[]" type="date" class="form-control" placeholder="Offer Price">
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-success add-more-btn float-right">Add More</button>
                                        </div>
                                    </div>

                                    <div class="col-sm-12" id="noVariation">
                                        <div class="row">
                                            <div class="col-sm-6" >
                                                <div class="mb-3">
                                                    <label for="price">Color</label>
                                                    <select class="select2 form-control" name="color_ids"  data-placeholder="Choose ...">
                                                        <option value="">Select Color</option>
                                                        @foreach($colors as $color)
                                                            <option value="{{$color->id}}">{{$color->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6" >
                                                <div class="mb-3">
                                                    <label for="price">Size</label>
                                                    <select class="select2 form-control" name="size_ids" data-placeholder="Choose ...">
                                                        <option value="">Select Size</option>
                                                        @foreach($sizes as $size)
                                                            <option value="{{$size->id}}">{{$size->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="manufacturerbrand">Stock Quantity</label>
                                                    <input id="manufacturerbrand" name="qtys" type="number" min="1" class="form-control" placeholder="Stock Quantity">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="price">Original Price</label>
                                                    <input id="price" name="prices" type="number" class="form-control" placeholder="Original Price">
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="price">Offer Price</label>
                                                    <input id="price" name="discount_prices" type="number" class="form-control" placeholder="Offer Price">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="price">Offer Start</label>
                                                    <input id="offer" name="offer_starts" type="date" class="form-control" placeholder="Original Price">
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="price">Offer End</label>
                                                    <input id="price" name="offer_ends" type="date" class="form-control" placeholder="Offer Price">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card myDiv2" id="myDiv2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="price">Minimum Order Quantity</label>
                                            <input id="price" name="minimum_order_quantity" type="number" min="1" class="form-control" placeholder="Minimum Order Quantity">
                                        </div>
                                    </div>
                                    <div class="col-sm-6" >
                                        <div class="mb-3">
                                            <label for="price">Color</label>
                                            <select class="select2 form-control" name="color_idw"  data-placeholder="Choose ...">
                                                <option value="">Select Color</option>
                                                @foreach($colors as $color)
                                                    <option value="{{$color->id}}">{{$color->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" >
                                        <div class="mb-3">
                                            <label for="price">Size</label>
                                            <select class="select2 form-control" name="size_idw" data-placeholder="Choose ...">
                                                <option value="">Select Size</option>
                                                @foreach($sizes as $size)
                                                    <option value="{{$size->id}}">{{$size->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="manufacturerbrand">Stock Quantity</label>
                                            <input id="manufacturerbrand" name="qtyw" type="number" min="1" class="form-control" placeholder="Stock Quantity">
                                        </div>
                                    </div>
                                    <div class="col-sm-12" id="form-container">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label >Package</label>
                                                    <input name="pack_name[]" type="text" min="1" class="form-control" placeholder="Package Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label >Quantity</label>
                                                    <input name="quantity[]" type="number" class="form-control" placeholder="Quantity">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label >Original Price</label>
                                                    <input name="price[]" type="number" class="form-control" placeholder="Original Price">
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label >Offer Price</label>
                                                    <input name="discount_price[]" type="number" class="form-control" placeholder="Offer Price">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label >Offer Start</label>
                                                    <input  name="offer_start[]" type="date" class="form-control" placeholder="Original Price">
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label>Offer End</label>
                                                    <input name="offer_end[]" type="date" class="form-control" placeholder="Offer Price">
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-success add-row-btn float-right">Add More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="price">Product Image</label>
                                            <input type="file" name="image" id="input-file-now-custom-1" class="dropify" data-default-file="" />
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="price">Product Gallery Image</label>
                                            <input type="file" name="gallery[]" id="input-file-now-custom-1" multiple class="dropify" data-default-file="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="metatitle">Short Description (Max 150 words)</label>
                                            <textarea id="metatitle" name="description" type="text" class="form-control" placeholder="Short Description (Max 150 words)" maxlength="150"></textarea>
                                        </div>
                                    </div>

{{--                                    <div class="col-sm-6">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label for="metadescription">Specifications</label>--}}
{{--                                            <textarea class="form-control" name="specification" id="specification" rows="5" placeholder="Specifications"></textarea>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="productdesc">Descriptions</label>
                                            <textarea class="form-control" name="description2" id="product_description" rows="5" placeholder="Descriptions"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <div class="row">
                                                <label for="metadescription" class="col-md-12">Product Origin</label>
                                                <div class="form-group col-md-9">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="origin" value="fragile">
                                                        <label class="form-check-label" for="inlineCheckbox1">Fragile</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="origin" value="liquid">
                                                        <label class="form-check-label" for="inlineCheckbox2">Liquid</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label for="metadescription" class="col-md-12">Free Shipping</label>
                                            <div class="form-group col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="free_shipping" id="inlineCheck1" value="1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr style="border: solid grey 0.5px">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label for="metadescription" class="col-md-12">Warranty/Guarantee</label>
                                            <div class="form-group col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="wa_gu" id="inlineRadio4" value="warranty">
                                                    <label class="form-check-label" for="inlineRadio4">Warranty</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="wa_gu" id="inlineRadio5" value="guarantee">
                                                    <label class="form-check-label" for="inlineRadio5">Guarantee</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="wa_gu" id="inlineRadio6" value="no_w_g">
                                                    <label class="form-check-label" for="inlineRadio6">No Warranty/Guarantee</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="price">Select Warranty/Guarantee Type</label>
                                            <select name="w_g_type" id="" class="form-control">
                                                <option value="" selected disabled>Select Warranty/Guarantee</option>
                                                <option value="seller">Seller Warranty/Guarantee</option>
                                                <option value="brand">Brand Warranty/Guarantee</option>
                                                <option value="seller_brand">Seller & Brand Warranty/Guarantee</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="datetime">Warranty/Guarantee time</label>
                                            <input type="number" min="1" id="datetime" name="duration_time" class="form-control"/>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="duration" id="day" value="days">
                                                <label class="form-check-label" for="day">Days</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="duration" id="month" value="months">
                                                <label class="form-check-label" for="month">Months</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="duration" id="year" value="years">
                                                <label class="form-check-label" for="year">Years</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6" id="crossBorder">
                                        <div class="mb-3">
                                            <label for="datetime">Which Country Delivered</label>
                                            <select name="country_id" id="" class="form-control">
                                                <option value="">Select Country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6" id="preOrder">
                                        <div class="mb-3">
                                            <label for="datetime">Maximum Delivery Date</label>
                                            <input type="date" class="form-control" name="maximum_delivery_date" placeholder="Maximum Delivery Date">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <a href="" class="btn btn-warning" >Back</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('.add-row-btn').click(function(e) {
                        e.preventDefault();
                        var newRow = '' +
                            '<div class="row">' +
                            '<div class="col-sm-6">' +
                            '<div class="mb-3">' +
                            '<label >Package</label>' +
                            '<input name="pack_id[]" type="hidden" min="1" class="form-control" placeholder="Package Name">' +
                        '<input name="pack_name[]" type="text" class="form-control" placeholder="Package Name">' +

                            '</div>' +
                            '</div>' +
                            '<div class="col-sm-6">' +
                            '<div class="mb-3">' +
                            '<label >Quantity</label>' +
                            '<input name="quantity[]" type="number" min="1" class="form-control" placeholder="Quantity">' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-sm-6">' +
                            '<div class="mb-3">' +
                            '<label >Original Price</label>' +
                        '<input name="price[]" type="number" min="1" class="form-control" placeholder="Original Price">' +
                            '</div>' +
                            '</div>' +


                            '<div class="col-sm-6">' +
                            '<div class="mb-3">'+
                            '<label >Offer Price</label>'+
                        '<input name="discount_price[]" type="number" min="1" class="form-control" placeholder="Offer Price">'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-sm-6">'+
                            '<div class="mb-3">'+
                            '<label >Offer Start</label>'+
                        '<input name="offer_start[]" type="date" class="form-control" placeholder="Original Price">'+
                            '</div>'+
                            '</div>'+


                            '<div class="col-sm-6">'+
                            '<div class="mb-3">'+
                            '<label >Offer End</label>'+
                        '<input  name="offer_end[]" type="date" class="form-control" placeholder="Offer Price">'+
                            '</div>'+
                            '</div>'+
                            '<button type="button" class="btn btn-sm btn-danger rem-row-btn float-right">Remove</button>'+
                        '</div>';
                        $('#form-container').append(newRow);
                    });
                    $(document).on('click', '.rem-row-btn', function (e) {
                        e.preventDefault();
                        var row_item = $(this).parent();
                        $(row_item).remove();
                    });
                });
            </script>

            <script>
                $(document).ready(function() {
                    $('.add-more-btn').click(function(e) {
                        e.preventDefault();
                        var newMoreRow = '' +
                            '<div class="row">'+
                            '<div class="col-sm-12">'+
                        '<hr style="border: solid grey 0.5px">'+
                            '</div>'+
                            '<div class="col-sm-6" >'+
                            '<div class="mb-3">'+
                            '<label for="price">Image</label>'+
                            '<input type="file" name="variation_image[]" class="form-control">'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-sm-6" >'+
                            '<div class="mb-3">'+
                            '<label for="price">Color</label>'+
                            '<select class="select2 form-control" name="color_id[]" data-placeholder="Choose ...">'+
                            '<option>Select Color</option>'+
                            '@foreach($colors as $color)'+
                            '<option value="{{$color->id}}">{{$color->name}}</option>'+
                            '@endforeach'+
                            '</select>'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-sm-6" >'+
                            '<div class="mb-3">'+
                            '<label for="price">Size</label>'+
                            '<select class="select2 form-control" name="size_id[]" data-placeholder="Choose ...">'+
                            '<option>Select size</option>'+
                            '@foreach($sizes as $size)'+
                            '<option value="{{$size->id}}">{{$size->name}}</option>'+
                            '@endforeach'+
                            '</select>'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-sm-6">'+
                            '<div class="mb-3">'+
                            '<label for="manufacturerbrand">Stock Quantity</label>'+
                        '<input id="manufacturerbrand" name="qty[]" type="number" min="1" class="form-control" placeholder="Stock Quantity">'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-sm-6">'+
                            '<div class="mb-3">'+
                            '<label for="price">Original Price</label>'+
                        '<input id="price" name="price[]" type="number" class="form-control" placeholder="Original Price">'+
                            '</div>'+
                            '</div>'+


                            '<div class="col-sm-6">'+
                            '<div class="mb-3">'+
                            '<label for="price">Offer Price</label>'+
                        '<input id="price" name="discount_price[]" type="number" class="form-control" placeholder="Offer Price">'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-sm-6">'+
                            '<div class="mb-3">'+
                            '<label for="price">Offer Start</label>'+
                        '<input id="offer" name="offer_start[]" type="date" class="form-control" placeholder="Original Price">'+
                            '</div>'+
                            '</div>'+


                            '<div class="col-sm-6">'+
                            '<div class="mb-3">'+
                            '<label for="price">Offer End</label>'+
                        '<input id="price" name="offer_end[]" type="date" class="form-control" placeholder="Offer Price">'+
                            '</div>'+
                            '</div>'+
                            '<button type="button" class="btn btn-sm btn-danger rem-more-btn float-right">Remove</button>'
                            '</div>';
                        $('#variation').append(newMoreRow);
                    });
                    $(document).on('click', '.rem-more-btn', function (e) {
                        e.preventDefault();
                        var more_item = $(this).parent();
                        $(more_item).remove();
                    });
                });
            </script>

            <script>
                const checkboxes = document.getElementsByName("product_variation");

                checkboxes.forEach((checkbox) => {
                    checkbox.addEventListener("click", () => {
                        checkboxes.forEach((c) => {
                            if (c !== checkbox) {
                                c.checked = false;
                            }
                        });
                    });
                });
            </script>

            <script>
                const checking = document.querySelectorAll(".group1");

                checking.forEach((checkboxs) => {
                    checkboxs.addEventListener("click", () => {
                        checking.forEach((c) => {
                            if (c !== checkboxs) {
                                c.checked = false;
                            }
                        });
                    });
                });


            </script>

            <script>
                // Wait for the document to load
                $(document).ready(function() {
                    // Attach a click event handler to the checkbox
                    $('#preOrderCheck').click(function() {
                        // If the checkbox is checked, show the div; otherwise, hide it
                        if ($(this).is(':checked')) {
                            $('#preOrder').show();
                        } else {
                            $('#preOrder').hide();
                        }
                    });
                });
            </script>

            <script>
                // Wait for the document to load
                $(document).ready(function() {
                    // Attach a click event handler to the checkbox
                    $('#noCrossCheck').click(function() {
                        // If the checkbox is checked, show the div; otherwise, hide it
                        if ($(this).is(':checked')) {
                            $('#crossBorder').show();
                        } else {
                            $('#crossBorder').hide();
                        }
                    });
                });
            </script>

            <script>
                // Wait for the document to load
                $(document).ready(function() {
                    // Attach a click event handler to the checkbox
                    $('#noVariationCheck').click(function() {
                        // If the checkbox is checked, show the div; otherwise, hide it
                        if ($(this).is(':checked')) {
                            $('#noVariation').show();
                        } else {
                            $('#noVariation').hide();
                        }
                    });
                });
            </script>

            <script>
                // Wait for the document to load
                $(document).ready(function() {
                    // Attach a click event handler to the checkbox
                    $('#variationCheck').click(function() {
                        // If the checkbox is checked, show the div; otherwise, hide it
                        if ($(this).is(':checked')) {
                            $('#variation').show();
                        }else {
                            $('#variation').hide();
                        }
                    });
                });
            </script>

            <script>
                // Wait for the document to load
                $(document).ready(function() {
                    // Attach a click event handler to the checkbox
                    $('#myCheckbox').click(function() {
                        // If the checkbox is checked, show the div; otherwise, hide it
                        if ($(this).is(':checked')) {
                            $('#myDiv').show();
                        } else {
                            $('#myDiv').hide();
                        }
                    });
                });
            </script>

            <script>

                // const checkbox = document.getElementById('wholesale');
                // const div = document.getElementById('myDiv2');
                //
                // if (checkbox.checked) {
                //     div.style.display = 'block';
                // } else {
                //     div.style.display = 'none';
                // }
                //
                // function toggleDiv() {
                //     if (checkbox.checked) {
                //         div.style.display = 'block';
                //     } else {
                //         div.style.display = 'none';
                //     }
                // }
                //
                // checkbox.addEventListener('change', toggleDiv);
                //
                // window.addEventListener('click', function(event) {
                //     if (event.target !== checkbox) {
                //         checkbox.checked = false;
                //         toggleDiv();
                //     }
                // });

                // const checkbox = document.getElementById('wholesale');
                // const div = document.getElementById('myDiv2');
                //
                // if (checkbox.checked) {
                //     div.style.display = 'block';
                // } else {
                //     div.style.display = 'none';
                // }
                //
                // checkbox.addEventListener('change', function() {
                //     if (this.checked) {
                //         div.style.display = 'block';
                //     } else {
                //         div.style.display = 'none';
                //     }
                // });

                // Wait for the document to load
                $(document).ready(function() {
                    // Attach a click event handler to the checkbox
                    $('#wholesale').click(function() {
                        // If the checkbox is checked, show the div; otherwise, hide it
                        if ($(this).is(':checked')) {
                            $('.myDiv2').show();
                            $('.variation').hide();
                        } else {
                            $('.myDiv2').hide();
                            $('.variation').show();
                        }
                    });
                });
            </script>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('.select2-custom').select2({
                tags: true,
                tokenSeparators: [',', ' '],
                placeholder: "Select or type an option",
            });
        });
    </script>
@endsection

@section('scripts')
    <script>
        $('#category_id').change(function(){
            var category_id = $(this).val();
            if (category_id == ''){
                category_id = -1;
            }
            var option = "";
            var url = "{{ url('/') }}";

            $.get( url + "/get-sub-category/"+category_id, function( data ) {
                data = JSON.parse(data);
                option += "<option value='' selected disabled>Select Sub Category</option>";
                data.forEach(function (element) {
                    option += "<option value='"+ element.id +"'>"+ element.title + "</option>";
                });
                //console.log(option);
                $('#sub_category').html(option);
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $("input[type='radio']").change(function() {
                if ($(this).val() == "variation") {
                    $("#variation").show();
                }
                else {
                    $("#variation").hide();
                }

                if ($(this).val() == "single") {
                    $("#single").show();
                }
                else {
                    $("#single").hide();
                }
            });
        });
    </script>
@endsection

