@php
    $submission = \App\Models\Product::where('submission', 2)->first();
@endphp

@if($submission == true)
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('product.store-5')}}" id="variantForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="manufacturerbrand">Stock Quantity</label>
                                <input id="manufacturerbrand" name="qty" value="{{$submission->qty}}" type="number" min="1" class="form-control" placeholder="Stock Quantity">
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
                    </div>
                </form>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" value="{{$product->id}}" class="btn btn-success variantBtn float-right mb-3" data-toggle="modal">Add Variation</button>
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Image</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Stock Quantity</th>
                        <th>Original Price</th>
                        <th>Offer Price</th>
                        <th>Offer Start</th>
                        <th>Offer End</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product->variation as $variante)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><img class="text-danger" src="{{asset($variante->variation_image)}}" alt="Variation Image" style="height: 80px; width: 80px"></td>
                            <td>{{$variante->color->name}}</td>
                            <td>{{$variante->size->name}}</td>
                            <td>{{$variante->qty}}</td>
                            <td><del class="text-danger">Tk. {{number_format($variante->price)}}</del></td>
                            <td>Tk. {{number_format($variante->discount_price)}}</td>
                            <td>{{$variante->offer_start}}</td>
                            <td>{{$variante->offer_end}}</td>
                            <td><button type="button" class="btn btn-danger variantDeleteBtn" value="{{$variante->id}}" data-toggle="modal" ><span aria-hidden="true">&times;</span></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-12">
                <button type="submit" onclick="event.preventDefault();document.getElementById('variantForm').submit();" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </div>

@endif

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Variant</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('vendor.variant.store')}}" method="POST" enctype="multipart/form-data" id="variantStore">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="product_id" id="pro_id" class="form-control">
                        <div class="col-sm-6" >
                            <div class="mb-3">
                                <label for="price">Image</label>
                                <input type="file" name="variation_image" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6" >
                            <div class="mb-3">
                                <label for="price">Color</label>
                                <select class="select2 form-control" name="color_id" data-placeholder="Choose ...">
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
                                <select class="select2 form-control" name="size_id" data-placeholder="Choose ...">
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
                                <input id="manufacturerbrand" name="qty" type="number" min="1" class="form-control" placeholder="Stock Quantity">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="price">Original Price</label>
                                <input id="price" name="price" type="number" class="form-control" placeholder="Original Price">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="price">Offer Price</label>
                                <input id="price" name="discount_price" type="number" class="form-control" placeholder="Offer Price">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="price">Offer Start</label>
                                <input id="offer" name="offer_start" type="date" class="form-control" placeholder="Original Price">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="price">Offer End</label>
                                <input id="price" name="offer_end" type="date" class="form-control" placeholder="Offer Price">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="event.preventDefault(); document.getElementById('variantStore').submit();" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="variation-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Variant</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('vendor.variant.delete')}}" method="POST" enctype="multipart/form-data" id="variantDelete">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="variation_id" id="variation_id" class="form-control">
                        <div class="col-sm-12" >
                            <p class="text-danger text-center">Are you sure to delete this?</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="event.preventDefault(); document.getElementById('variantDelete').submit();" class="btn btn-primary">Confirm</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script>
    $(document).ready(function () {
        $(document).on('click', '.variantDeleteBtn', function () {
            var variation_id = $(this).val();
            // alert(variation_id);
            $('#variation-modal').modal('show');
            $('#variation_id').val(variation_id);

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
        $(document).on('click', '.variantBtn', function () {
            var pro_id = $(this).val();
            // alert(pro_id);
            $('#modal-lg').modal('show');
            $('#pro_id').val(pro_id);

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
