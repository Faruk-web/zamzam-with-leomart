@extends('admin.layouts.master')
@section('content')
 <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Business Settings</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">business-settings</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
	<div class="container-fluid">
		<div class="card">
              <div class="card-header">

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
               <form action="{{ route('setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 <div class="row">
                   <div class="col-md-4">
                     <div class="form-group">
                       <label>Name*</label>
                       <input type="text" name="name" value="{{ $setting->name }}" class="form-control @error('name') is-invalid @enderror">
                       @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label>Logo*</label>
                       <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
                       @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <img src="{{ asset('images/website/'. $setting->logo) }}">
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label>Favicon*</label>
                       <input type="file" name="favicon" class="form-control @error('favicon') is-invalid @enderror">
                       @error('favicon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <img src="{{ asset('images/website/'. $setting->favicon) }}">
                     </div>
                   </div>

                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Phone*</label>
                       <input type="text" name="phone" value="{{ $setting->phone }}" class="form-control @error('phone') is-invalid @enderror">
                       @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Email*</label>
                       <input type="email" name="email" value="{{ $setting->email }}" class="form-control @error('email') is-invalid @enderror">
                       @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Address*</label>
                       <input type="text" name="address" value="{{ $setting->address }}" class="form-control @error('address') is-invalid @enderror">
                       @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Address*</label>
                       <input type="text" name="address" value="{{ $setting->address }}" class="form-control @error('address') is-invalid @enderror">
                       @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Facebook</label>
                       <input type="text" name="facebook" value="{{ $setting->facebook }}" class="form-control @error('facebook') is-invalid @enderror">
                       @error('facebook')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Instagram</label>
                       <input type="text" name="instagram" value="{{ $setting->instagram }}" class="form-control @error('instagram') is-invalid @enderror">
                       @error('instagram')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Twitter</label>
                       <input type="text" name="twitter" value="{{ $setting->twitter }}" class="form-control @error('twitter') is-invalid @enderror">
                       @error('twitter')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>YouTube</label>
                       <input type="text" name="youtube" value="{{ $setting->youtube }}" class="form-control @error('youtube') is-invalid @enderror">
                       @error('youtube')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Linkedin</label>
                       <input type="text" name="linkedin" value="{{ $setting->linkedin }}" class="form-control @error('linkedin') is-invalid @enderror">
                       @error('linkedin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                   </div>
                     <div class="col-md-6">
                         <div class="form-group">
                             <label>Offer Image*</label>
                             <input type="file" name="offer_img" class="form-control @error('offer_img') is-invalid @enderror">
                             @error('offer_img')
                             <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                             @enderror
                             <img src="{{ asset('images/website/'. $setting->offer_img) }}" style="height: 80px; width: 80px">
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="row">
                             <div class="col-md-12">
                                 <label>Offer Image Status</label>
                             </div>
                             <div class="col-md-12 mb-5">
                                 <input type="checkbox" name="offer_image_status" value="1" @if($setting->offer_image_status == 1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                             </div>
                         </div>
                         @error('linkedin')
                         <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                     </div>

                   <div class="col-md-12">
                     <div class="form-group">
                       <button class="btn btn-primary float-right">Save Changes</button>
                     </div>
                   </div>
                 </div>
               </form>
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

  });
</script>
    <script>
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    </script>
@endsection
