@extends('admin.layouts.master')
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Refund Edit</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('index') }}" target="_blank">Home</a></li>
          <li class="breadcrumb-item active">Refund</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
	<div class="container-fluid">
		<form action="{{ route('refund.update', $refund->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label><b>Name *</b></label>
				<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $refund->name }}" readonly>
				@error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			</div>

			<div class="form-group">
				<label><b>Description *</b></label>
				<textarea class="summernote form-control @error('description') is-invalid @enderror" name="description">
					{{ $refund->description }}
				</textarea>
				@error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			</div>


			<div class="form-group">
				<button type="submit" class="btn btn-primary">Update</button>
			</div>
		</form>
	</div>
</section>
@endsection
