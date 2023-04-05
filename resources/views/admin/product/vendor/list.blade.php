@extends('admin.layouts.master')
@section('content')
 <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Vendor List</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Vendor List</li>
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
                <a href="#addModal" class="btn btn-primary" data-toggle="modal"><i class="fas fa-plus"></i> Create Sidebar</a>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
	                  <tr>
	                    <th>S.N</th>
	                    <th>Name</th>
                        <th>User Type</th>
                        <th>Email</th>
                        <th>Phone</th>
	                    <th>Action</th>
	                  </tr>
                  </thead>
                  <tbody>
	                  @foreach($users as $sidebar)
	                  	<tr>
		                    <td>{{ $loop->index + 1 }}</td>
		                    <td>{{ $sidebar->name }}</td>
                            <td>{{ $sidebar->customer_type }}</td>
                            <td>{{ $sidebar->email }}</td>
                            <td>{{ $sidebar->phone }}</td>
                            <td>
                              {{-- @dd($sidebar->vendor_status); --}}
                              @if($sidebar->vendor_status == '1')
                              <a  href="{{ route('product.vendor.deactive',$sidebar->id) }}"
                                  class="btn btn-success" title="Product Active Now">Approved</a>
                              @else
                  
                              <a href="{{ route('product.vendor.active',$sidebar->id) }}"
                                  class="btn btn-danger" title="Product Active Now">panding </a>
                              @endif 
                  
                              </td>
                              {{-- <td>
                                
                                <a href="#deleteModal{{ $sidebar }}" class="btn btn-danger" data-toggle="modal" title="Delete">Invoice</a>
                              </td> --}}
		                </tr>

                    <!-- Edit brand Modal -->
            <div class="modal fade" id="editModal{{ $sidebar->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                              Edit - {{ $sidebar->title }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('brand.update', $sidebar->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Main Sidebar *</label>
                                  <input type="text" name="main_sidebar" class="form-control @error('title') is-invalid @enderror" Value="{{ $sidebar->title }}" required>
                                  @error('title')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>
                              </div> 
                              <div class="col-md-12">
                              <div class="form-group">
                                  <label>Childe Sidebar *</label>
                                  <input type="text" name="childe_sidebar" class="form-control @error('title') is-invalid @enderror" Value="{{ $sidebar->title }}" required>
                                  @error('title')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>
                              </div>
                                <div class="form-group">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <button class="btn btn-primary">Save Changes</button>
                                </div>
                              </div>
                            </div>
                          </form>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        <!-- Delete brand Modal -->
            <div class="modal fade" id="deleteModal{{ $sidebar->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are tou sure you want to delete ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" align="right">
                            <form action="{{ route('brand.destroy', $sidebar->id) }}" method="POST">
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

	                  @endforeach
                  </tbody>
                  <tfoot>
                  	<tr>
                      <th>S.N</th>
	                    <th>Name</th>
                        <th>User Type</th>
                        <th>Email</th>
                        <th>Phone</th>
	                    <th>Action</th>
	                </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- Add Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Sidebar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="{{ route('admin.sidebar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="modal-body">
                  
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Main Sidebar *</label>
                          <input type="text" name="main_sidebar" class="form-control @error('title') is-invalid @enderror" placeholder="Main Sidebar" required>
                          @error('title')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label>Childe Sidebar *</label>
                            <input type="text" name="childe_sidebar" class="form-control @error('title') is-invalid @enderror" placeholder="Childe Sidebar" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                  </div>
                  </form>
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