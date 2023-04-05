@extends('admin.layouts.master')
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Group Permission</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('index') }}" target="_blank">Home</a></li>
          <li class="breadcrumb-item active">Admin</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
	<div class="container-fluid">
		<form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label><b>Name *</b></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $admin->name }}" required>
            @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label><b>Email *</b></label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $admin->email }}" required>
            @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label><b>Phone *</b></label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $admin->phone }}" required>
            @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
          </div>
        </div>  
    </div>

          <table id="example2" class="table table-bordered table-hover">
                  <thead>
	                  <tr>
	                    <th>Main Sidebar</th>
                        <th>Sub Sidebar</th>
                     
	                  </tr>
                  </thead>
                  <tbody>
	                  @foreach($sidebars as $admin)
	                  	<tr>
		                    <td>
                            <input type="radio" id="html" name="fav_language" value="HTML">
                             <label for="html">{{$admin->main_sidebar}}</label><br>    
                            </td>
                            <td>
                            <input type="radio" id="html" name="fav_language" value="HTML">
                             <label for="html">{{$admin->childe_sidebar}}</label><br>    
                            </td>
		                </tr>
                        @endforeach
                     </tbody>
                </table>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
  </form>
	</div>

</section>
@endsection
