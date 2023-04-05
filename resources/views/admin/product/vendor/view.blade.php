@extends('admin.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Name: {{$product->title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Product Detail Info</h4>
                            <h4 class="card-title mb-4 float-right">Vendor Name: {{$product->user->name}}</h4>
                            <table class="table table-bordered table-hover" id="example1">
                                <tr>
                                    <th style="width: 20%">Product ID</th>
                                    <td>{{$product->id}}</td>
                                </tr>
                                <tr>
                                    <th>Product Name</th>
                                    <td>{{$product->title}}</td>
                                </tr>
                                <tr>
                                    <th>Product Code</th>
                                    <td>{{$product->code}}</td>
                                </tr>
                                <tr>
                                    <th>Product Category</th>
                                    <td>{{$product->category->title}}</td>
                                </tr>
{{--                                <tr>--}}
{{--                                    <th>Product Sub Category</th>--}}
{{--                                    <td>{{$product->subCategory->title}}</td>--}}
{{--                                </tr>--}}
                                <tr>
                                    <th>Product Brand</th>
                                    <td>{{$product->brand->title}}</td>
                                </tr>
                                <tr>
                                    <th>Product Unit</th>
                                    <td>{{$product->unit}}</td>
                                </tr>
                                @if($product->product_variation == 1)
                                <tr>
                                    <th>Product Color</th>
                                    <td>{{$colorsName}}</td>
                                </tr>
                                <tr>
                                    <th>Product Size</th>
                                    <td>{{$sizeName}}</td>
                                </tr>
                                <tr>
                                    <th>Product Stock Quantity</th>
                                    <td>{{$product->qty.'/'.$product->unit}}</td>
                                </tr>
                                <tr>
                                    <th>Product Original Price</th>
                                    <td>Tk. {{number_format($product->price)}}</td>
                                </tr>
                                <tr>
                                    <th>Product Discount Price</th>
                                    <td>Tk. {{number_format($product->discount_price)}}</td>
                                </tr>
                                <tr>
                                    <th>Product Offer Start</th>
                                    <td>{{$product->offer_start}}</td>
                                </tr>
                                <tr>
                                    <th>Product Offer End</th>
                                    <td>{{$product->offer_end}}</td>
                                </tr>
                                @endif
                                @if($product->product_variation == 2)
                                    <tr>
                                        <th>Product Color</th>
                                        <td>{{$product->color->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Size</th>
                                        <td>{{$product->size->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Stock Quantity</th>
                                        <td>{{$product->qty.'/'.$product->unit}}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Original Price</th>
                                        <td>Tk. {{number_format($product->price)}}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Discount Price</th>
                                        <td>Tk. {{number_format($product->discount_price)}}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Offer Start</th>
                                        <td>{{$product->offer_start}}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Offer End</th>
                                        <td>{{$product->offer_end}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Product Origin</th>
                                    <td>{{$product->origin}}</td>
                                </tr>

                                <tr>
                                    <th>Free Shipping</th>
                                    <td>{{$product->free_shipping == 1 ? 'Yes' : 'No'}}</td>
                                </tr>
                                <tr>
                                    <th>Product Warranty/Guarantee</th>
                                    <td>{{$product->wa_gu}}</td>
                                </tr>
                                <tr>
                                    <th>Product Warranty/Guarantee Type</th>
                                    <td>{{$product->w_g_type == 'seller_brand' ? 'Seller And Brand Warranty/Guarantee' : ''}}{{$product->w_g_type == 'seller' ? 'Seller Warranty/Guarantee' : ''}}{{$product->w_g_type == 'brand' ? 'Brand Warranty/Guarantee' : ''}}</td>
                                </tr>
                                <tr>
                                    <th>Product Warranty/Guarantee Date</th>
                                    <td>{{$product->duration_time.' '.$product->duration}}</td>
                                </tr>
                                <tr>
                                    <th>Product Short Description</th>
                                    <td>{!! $product->description !!}</td>
                                </tr>
                                <tr>
                                    <th>Product Long Description</th>
                                    <td>{!! $product->description2 !!}</td>
                                </tr>
                                <tr>
                                    <th>Product Specifications</th>
                                    <td>{!! $product->specification !!}</td>
                                </tr>
                                <tr>
                                    <th>Product Main Image</th>
                                    <td>
                                        <img src="{{asset($product->image)}}" alt="" height="150" width="200"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Product Gallery Image</th>
                                    <td>
                                        @foreach($product->product_image as $otherImage)
                                            <img src="{{asset($otherImage->image)}}" alt="" height="150" width="200"/>
                                        @endforeach
                                    </td>
                                </tr>
                                @if($product->wholesale == 1)
                                <tr>
                                    <th>Minimum Order Quantity</th>
                                    <td>{{$product->minimum_order_quantity}}</td>
                                </tr>
                                <tr>
                                    <th>Product Color</th>
                                    <td>{{$product->color->name}}</td>
                                </tr>
                                <tr>
                                    <th>Product Size</th>
                                    <td>{{$product->size->name}}</td>
                                </tr>
                                <tr>
                                    <th>Product Stock Quantity</th>
                                    <td>{{$product->qty.'/'.$product->unit}}</td>
                                </tr>
                                @foreach($packages as $package)
                                    <tr>
                                        <th>Wholesale Package</th>
                                        <td>Package {{$loop->iteration}}</td>
                                    </tr>
                                <tr>
                                    <th>Wholesale Package Name</th>
                                    <td>{{$package->pack_name}}</td>
                                </tr>
                                <tr>
                                    <th>Wholesale Quantity</th>
                                    <td>{{$package->quantity.'/'. $product->unit}}</td>
                                </tr>
                                <tr>
                                    <th>Wholesale Original Price</th>
                                    <td>Tk. {{number_format($package->price)}}</td>
                                </tr>
                                <tr>
                                    <th>Wholesale Offer Price</th>
                                    <td>Tk. {{number_format($package->discount_price)}}</td>
                                </tr>
                                <tr>
                                    <th>Wholesale Offer Start</th>
                                    <td>{{$package->offer_start}}</td>
                                </tr>
                                <tr>
                                    <th>Wholesale Offer End</th>
                                    <td>{{$package->offer_end}}</td>
                                </tr>
                                @endforeach
                                @endif

                                @if($product->cross_border == 1)
                                    <tr>
                                        <th>Which Country Delivered</th>
                                        <td>{{$product->country->name}}</td>
                                    </tr>
                                @endif

                                @if($product->pre_order == 1)
                                    <tr>
                                        <th>Maximum Delivery Date</th>
                                        <td>{{$product->maximum_delivery_date. ' ('.$numberOfDay. ' '. 'days'.')'}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Product Status</th>
                                    <td class="mt-1 badge badge-{{$product->is_active == 1 ? 'success' : 'warning'}}">{{$product->is_active == 1 ? 'Published' : 'Unpublished'}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{route('product.vendor.request')}}" class="btn btn-warning float-right"><i class="fa fa-reply"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
