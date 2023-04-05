@extends('admin.layouts.master')
@section('content')
 <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Product Request</h1>
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
		<div class="card">
              <!-- <div class="card-header">
                <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Product</a>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
	                  <tr>
	                    <th>S.N</th>
	                    <th>Vendor Name</th>
	                    <th>Title</th>
                      <th>Image</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Type</th>
                      <th>Status</th>
	                    <th>Action</th>
	                  </tr>
                  </thead>
                  <tbody>
	                  @foreach($products as $product)
	                  	<tr>
		                    <td>{{ $loop->index + 1 }}</td>
		                    <td>{{ $product->user->name }}</td>
		                    <td>{{ $product->title }}</td>
                        <td><img src="{{ asset($product->image) }}" width="100"></td>
                        <td>{{ !is_null($product->category) ? $product->category->title : '' }}</td>
                        <td>{{ !is_null($product->brand) ? $product->brand->title : '' }}</td>
                        <td>{{ $product->type }}</td>
{{--                        <td>--}}
{{--                            @if($product->vendor_status == 1)--}}
{{--                            <a  href="{{ route('product.vendoractive',$product->id) }}"--}}
{{--                                class="btn btn-success" title="Product Active Now">Accepted </a>--}}
{{--                            @else--}}
{{--                            <a href="{{ route('product.vendorDeactive',$product->id) }}"--}}
{{--                                class="btn btn-danger" title="Product Active Now">Pending </a>--}}
{{--                            @endif--}}
{{--                       </td>--}}
                            <td><span class="badge badge-{{ $product->is_active == 1 ? 'success' : 'warning' }}">{{ $product->is_active == 1 ? 'Accepted' : 'Pending' }}</span></td>
		                    <td>
                                <a href="{{ route('product.vendor.show', ['id' => $product->id, 'slug' => \Illuminate\Support\Str::slug($product->title)]) }}" class="btn btn-primary" title="View"><i class="fas fa-eye"></i></a>
                                <a href="#approvedModal{{ $product->id }}" class="btn btn-success"  data-toggle="modal" title="Approved"><i class="fas fa-check"></i></a>
		                    	<a href="#deleteModal{{ $product->id }}" class="btn btn-danger" data-toggle="modal" title="Delete"><i class="fas fa-trash"></i></a>
		                    </td>
		                </tr>
        <!-- Delete product Modal -->
            <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                @csrf
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Permanent Delete</button>
                            </form>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
                          <!--Approved Modal-->
                        <div class="modal fade" id="approvedModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure want to approved ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('product.vendor.update', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" name="is_active" value="1" class="btn btn-success float-right">Yes</button>
                                            <button type="button" class="btn btn-secondary float-right mr-3" data-dismiss="modal">No</button>
                                        </form>

                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>

	                  @endforeach
                  </tbody>
                  <tfoot>
                  	<tr>
	                    <th>S.N</th>
                      <th>Vendor Name</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Type</th>
                      <th>Status</th>
                      <th>Action</th>
	                </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


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
