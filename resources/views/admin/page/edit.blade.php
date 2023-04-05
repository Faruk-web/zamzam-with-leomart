@extends('admin.layouts.master')
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Page Edit</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('index') }}" target="_blank">Home</a></li>
          <li class="breadcrumb-item active">Page</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
	<div class="container-fluid">
		<form action="{{ route('page.update', $page->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label><b>Name *</b></label>
				<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $page->name }}" readonly>
				@error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			</div>
			
			<!-- <div class="form-group">
				<label><b>Description *</b></label>
				<textarea class="summernote form-control @error('description') is-invalid @enderror" name="description">
					{{ $page->description }}
				</textarea>
				@error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			</div> -->
			@if($page->id == 1)
			<div class="form-group">
				<label><b>New Arrival Banner *</b></label>
				<input type="file" name="new_arrival" class="form-control @error('new_arrival') is-invalid @enderror">
				@error('new_arrival')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <img src="{{ asset('images/website/'.$page->new_arrival) }}" width="100">
			</div>
			<div class="form-group">
				<label><b>Product Banner *</b></label>
				<input type="file" name="product_banner" class="form-control @error('product_banner') is-invalid @enderror">
				@error('product_banner')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <img src="{{ asset('images/website/'.$page->product_banner) }}" width="100">
			</div>

			<div class="form-group">
				<label><b>Advertisement *</b></label>
				<input type="file" name="advertisement" class="form-control @error('advertisement') is-invalid @enderror">
				@error('advertisement')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <img src="{{ asset('images/website/'.$page->advertisement) }}" width="100">
			</div>
				
			@endif

			@if($page->id == 2 || $page->id == 3)
			<div class="form-group">
				<label><b>Banner *</b></label>
				<input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
				@error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <img src="{{ asset('images/website/'.$page->image) }}" width="100">
			</div>
			@endif

			@if($page->id == 4)
			<div class="form-group">
				<label><b>Image *</b></label>
				<input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
				@error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <img src="{{ asset('images/website/'.$page->image) }}" width="100">
			</div>
			<div class="form-group">
				<label><b>Banner *</b></label>
				<input type="file" name="product_banner" class="form-control @error('product_banner') is-invalid @enderror">
				@error('product_banner')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <img src="{{ asset('images/website/'.$page->product_banner) }}" width="100">
			</div>
			<div class="form-group">
				<label><b>Description *</b></label>
				<textarea class="summernote form-control @error('description') is-invalid @enderror" name="description">
					{{ $page->description }}
				</textarea>
				@error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			</div>
			<div class="form-group">
				<label><b>Our Vission *</b></label>
				<textarea class="summernote form-control @error('description1') is-invalid @enderror" name="description1">
					{{ $page->description1 }}
				</textarea>
				@error('description1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			</div>
			<div class="form-group">
				<label><b>Our Mission *</b></label>
				<textarea class="summernote form-control @error('description2') is-invalid @enderror" name="description2">
					{{ $page->description2 }}
				</textarea>
				@error('description2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			</div>
			@endif

			@if($page->id == 5 || $page->id == 6)
			<div class="form-group">
				<label><b>Description *</b></label>
				<textarea class="summernote form-control @error('description') is-invalid @enderror" name="description">
					{{ $page->description }}
				</textarea>
				@error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			</div>
			@endif


			<div class="form-group">
				<button type="submit" class="btn btn-primary">Update</button>
			</div>
		</form>
	</div>
</section>
@endsection
