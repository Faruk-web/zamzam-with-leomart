@extends('admin.layouts.master')
@section('content')
 <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Tutorial</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">edit-tutorial</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
	<div class="container-fluid">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('tutorial.update', ['id' => $tutorial->id]) }}" method="POST" enctype="multipart/form-data" id="formSubmit">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tutorial Type</label>
                                <select name="type" class="form-control @error('type') is-invalid @enderror">
                                    <option selected disabled >Please Select a tutorial type</option>
                                    <option value="product" {{$tutorial->type == 'product' ? 'selected' : ''}}>Product</option>
                                    <option value="coupon" {{$tutorial->type == 'coupon' ? 'selected' : ''}}>Coupon</option>
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tutorial Title *</label>
                                <input type="text" name="title" value="{{$tutorial->title}}" class="form-control @error('title') is-invalid @enderror" placeholder="Title" required>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Video *</label>
                                <input type="file" name="video" class="form-control @error('video') is-invalid @enderror" placeholder="Image" required>
                                <video width="320" height="240" controls>
                                    <source src="{{asset($tutorial->video)}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                @error('video')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tutorial Status</label>
                                <select name="status" class="form-control @error('type') is-invalid @enderror">
                                    <option >Please Select a tutorial status</option>
                                    <option value="1" {{$tutorial->status == 1 ? 'selected' : ''}}>Active</option>
                                    <option value="2" {{$tutorial->status == 2 ? 'selected' : ''}}>Inactive</option>
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description *</label>
                                <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description">{!! $tutorial->description !!}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary float-right" onclick="event.preventDefault(); document.getElementById('formSubmit').submit();">Save</button>
                        <a href="{{route('tutorial.index')}}" class="btn btn-warning float-right mr-3">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
            <!-- /.card -->
	</div>
</section>
@endsection

@section('scripts')
	<script>

</script>
@endsection
