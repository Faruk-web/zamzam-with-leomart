@php
    $submission = \App\Models\Product::where('id', $product->id)->first();
@endphp

@if($submission == true)
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('edit.update-3') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="price">Minimum Order Quantity</label>
                        <input id="price" name="minimum_order_quantity" value="{{$product->minimum_order_quantity}}" type="number" min="1" class="form-control" placeholder="Minimum Order Quantity">
                    </div>
                </div>
                <input id="productname" name="product_id" value="{{$product->id}}" type="hidden"/>
                <div class="col-sm-6" >
                    <div class="mb-3">
                        <label for="price">Color</label>
                        <select class="select2 form-control" name="color_id"  data-placeholder="Choose ...">
                            <option value="">Select Color</option>
                            @foreach($colors as $color)
                                <option value="{{$color->id}}" {{$color->id == $product->color_id ? 'selected' : ''}}>{{$color->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6" >
                    <div class="mb-3">
                        <label for="price">Size</label>
                        <select class="select2 form-control" name="size_id" data-placeholder="Choose ...">
                            <option value="">Select Size</option>
                            @foreach($sizes as $size)
                                <option value="{{$size->id}}" {{$size->id == $product->size_id ? 'selected' : ''}}>{{$size->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="manufacturerbrand">Stock Quantity</label>
                        <input id="manufacturerbrand" name="qty" value="{{$product->qty}}" type="number" min="1" class="form-control" placeholder="Stock Quantity">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="price">Original Price</label>
                        <input id="price" name="price" value="{{$submission->price}}" type="number" class="form-control" placeholder="Original Price">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="price">Offer Price</label>
                        <input id="price" name="discount_price" value="{{$submission->discount_price}}" type="number" class="form-control" placeholder="Offer Price">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="price">Offer Start</label>
                        <input id="offer" name="offer_start" value="{{$submission->offer_start}}" type="date" class="form-control" placeholder="Original Price">
                    </div>
                </div>


                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="price">Offer End</label>
                        <input id="price" name="offer_end" value="{{$submission->offer_end}}" type="date" class="form-control" placeholder="Offer Price">
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="button" value="{{$product->id}}" class="btn btn-success wholesaleBtnAdd float-right mb-3" data-toggle="modal">Add Package</button>
                </div>
                <div class="col-sm-12" id="form-container">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Package Name</th>
                            <th>Quantity</th>
                            <th>Original Price</th>
                            <th>Offer Price</th>
                            <th>Offer Start</th>
                            <th>Offer End</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product->package as $pack)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$pack->pack_name}}</td>
                            <td>{{number_format($pack->quantity)}}</td>
                            <td><del class="text-danger">Tk. {{number_format($pack->price)}}</del></td>
                            <td>Tk. {{number_format($pack->discount_price)}}</td>
                            <td>{{$pack->offer_start}}</td>
                            <td>{{$pack->offer_end}}</td>
                            <td><button type="button" value="{{$pack->id}}" class="btn btn-danger wholesaleBtnDelete" data-toggle="modal" ><span aria-hidden="true">&times;</span></button></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

@endif

<div class="modal fade" id="modal-wholesale">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Package</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('vendor.package.store')}}" method="POST" enctype="multipart/form-data" id="packageStore">
                    @csrf
                    <div class="row">
                        <input name="product_id" id="product_id" type="hidden" class="form-control" placeholder="Package Name">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label >Package</label>
                                <input name="pack_name" type="text" min="1" class="form-control" placeholder="Package Name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label >Quantity</label>
                                <input name="quantity" type="number" class="form-control" placeholder="Quantity">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label >Original Price</label>
                                <input name="price" type="number" class="form-control" placeholder="Original Price">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label >Offer Price</label>
                                <input name="discount_price" type="number" class="form-control" placeholder="Offer Price">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label >Offer Start</label>
                                <input  name="offer_start" type="date" class="form-control" placeholder="Original Price">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Offer End</label>
                                <input name="offer_end" type="date" class="form-control" placeholder="Offer Price">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="event.preventDefault(); document.getElementById('packageStore').submit();" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-wholesale-delete">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Package</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('vendor.package.delete')}}" method="POST" enctype="multipart/form-data" id="packageDelete">
                    @csrf
                    <div class="row">
                        <input name="pack_id" id="pack_id" type="hidden" class="form-control" placeholder="Package Name">
                        <div class="col-sm-6">
                            <p class="text-center text-danger">Are you sure to delete this?</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="event.preventDefault(); document.getElementById('packageDelete').submit();" class="btn btn-primary">Confirm</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function () {
        $(document).on('click', '.wholesaleBtnAdd', function () {
            var product_id = $(this).val();
            // alert(product_id);
            $('#modal-wholesale').modal('show');

            $('#product_id').val(product_id);


            // $.ajax({
            //     type: 'GET',
            //     url: "/home/color/edit/" + color_id,
            //     success: function (response) {
            //         // console.log(response);
            //
            //         $('#name').val(response.color.name);
            //         $('#status').val(response.color.status);
            //         $('#color_id').val(color_id);
            //     }
            // });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.wholesaleBtnDelete', function () {
            var pack_id = $(this).val();
            // alert(product_id);
            $('#modal-wholesale-delete').modal('show');

            $('#pack_id').val(pack_id);


            // $.ajax({
            //     type: 'GET',
            //     url: "/home/color/edit/" + color_id,
            //     success: function (response) {
            //         // console.log(response);
            //
            //         $('#name').val(response.color.name);
            //         $('#status').val(response.color.status);
            //         $('#color_id').val(color_id);
            //     }
            // });
        });
    });
</script>
