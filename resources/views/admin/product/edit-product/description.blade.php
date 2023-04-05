@php
    $submission = \App\Models\Product::where('id', $product->id)->first();
@endphp

@if($submission == true)
    <div class="container-fluid">
        <form action="{{ route('product.update-2') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3">
                        <input id="productname" name="product_id" value="{{$product->id}}" type="hidden"/>
                        <label for="metatitle">Short Description (Max 150 words)</label>
                        <textarea id="metatitle" name="description" type="text" class="form-control" placeholder="Short Description (Max 150 words)" maxlength="150">{{$product->description}}</textarea>
                    </div>
                </div>

                {{--                                    <div class="col-sm-6">--}}
                {{--                                        <div class="mb-3">--}}
                {{--                                            <label for="metadescription">Specifications</label>--}}
                {{--                                            <textarea class="form-control" name="specification" id="specification" rows="5" placeholder="Specifications"></textarea>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}

                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="productdesc">Descriptions</label>
                        <textarea class="form-control" name="description2" id="product_description" rows="5" placeholder="Descriptions">{{$product->description2}}</textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right">Save</button>
        </form>
    </div>
@endif
