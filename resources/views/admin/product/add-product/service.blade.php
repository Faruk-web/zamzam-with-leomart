@php
    $submission = \App\Models\Product::where('submission', 2)->first();
@endphp

@if($submission == true)
<div class="container-fluid">
    <form action="{{ route('product.store-4') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <div class="row">
                                <label for="metadescription" class="col-md-12">Product Origin</label>
                                <select name="origin_country_id" id="" class="form-control">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" {{$country->id == $product->origin_country_id ? 'selected' : ''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-4" style="margin-right: -30px">
                        <div class="mb-3">
                            <div class="row" style="margin-left: 20px; margin-top: 9px">
                                <label for="metadescription" class="col-md-12"></label>
                                <div class="form-group col-md-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="product_quality" value="fragile" style="height: 30px; width: 20px" @if($product->product_quality == 'fragile') checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox1">Fragile</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="product_quality" value="liquid" style="height: 30px; width: 20px" @if($product->product_quality == 'liquid') checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox2">Liquid</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <label for="metadescription" class="col-md-12">Product Size</label>
                            <div class="form-group col-md-9">
                                <div class="form-check form-check-inline">
                                    <input type="text" name="lenth" value="{{$product->lenth}}" placeholder="Lenth(cm)" class="form-control"/>
                                    <input type="text" name="width" value="{{$product->width}}" placeholder="Width(cm)" class="form-control"/>
                                    <input type="text" name="height" value="{{$product->height}}" placeholder="Height(cm)" class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row" style="margin-left: 10px">
                            <label for="metadescription" class="col-md-12" style="margin-left: 10px">Free Shipping</label>
                            <div class="form-group col-md-9" style="margin-left: 10px">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="free_shipping" id="inlineCheck1" value="1" style="height: 30px; width: 20px" @if($product->free_shipping == 1) checked @endif">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <label for="metadescription" class="col-md-12">Warranty/Guarantee</label>
                            <div class="form-group col-md-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="wa_gu" id="inlineRadio4" value="warranty" {{$product->wa_gu == 'warranty' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="inlineRadio4">Warranty</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="wa_gu" id="inlineRadio5" value="guarantee" {{$product->wa_gu == 'guarantee' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="inlineRadio5">Guarantee</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="wa_gu" id="inlineRadio6" value="no_w_g" {{$product->wa_gu == 'no_w_g' ? 'checked' : ''}}>
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
                                <option value="seller"{{$product->w_g_type == 'seller'? 'selected' : ''}}>Seller Warranty/Guarantee</option>
                                <option value="brand"{{$product->w_g_type == 'brand'? 'selected' : ''}}>Brand Warranty/Guarantee</option>
                                <option value="seller_brand"{{$product->w_g_type == 'seller_brand'? 'selected' : ''}}>Seller & Brand Warranty/Guarantee</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="datetime">Warranty/Guarantee time</label>
                            <input type="number" min="1" id="datetime" value="{{$product->duration_time}}" name="duration_time" class="form-control"/>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="duration" id="day" value="days" {{$product->duration == 'days' ? 'checked' : ''}}>
                                <label class="form-check-label" for="day">Days</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="duration" id="month" value="months" {{$product->duration == 'months' ? 'checked' : ''}}>
                                <label class="form-check-label" for="month">Months</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="duration" id="year" value="years" {{$product->duration == 'years' ? 'checked' : ''}}>
                                <label class="form-check-label" for="year">Years</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="card mt-5">
                <div class="card-body">
                    <div class="row">
                        @php
                            $cross_border = \App\Models\Product::where('submission', 1)->where('cross_border', 1)->first();
                        @endphp
                        @if($cross_border == true)
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label>Which Country Delivered</label>
                                    <select name="country_id" id="" class="form-control">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}" {{$country->id == $product->country_id ? 'selected' : ''}}>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        @php
                            $pre_order = \App\Models\Product::where('submission', 1)->where('pre_order', 1)->first();
                        @endphp
                        @if($pre_order == true)
                            <div class="col-sm-6" id="preOrder">
                                <div class="mb-3">
                                    <label for="datetime">Maximum Delivery Date</label>
                                    <input type="text" value="{{$product->maximum_delivery_date}}" class="form-control" name="maximum_delivery_date" placeholder="Maximum Delivery Date">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary float-right">Save and Publish</button>
            </div>
        </div>
    </form>
</div>
@endif
