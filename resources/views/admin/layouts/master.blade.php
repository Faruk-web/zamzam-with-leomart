
  @include('admin.partials.header')
  @if(Auth::user()->type == 2)
  @include('admin.partials.vendor_sidebar')
  @else
  @include('admin.partials.sidebar')
  @endif
  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
  	
  	 @include('admin.partials.messages')
    @yield('content')
  </div>
  @include('admin.partials.footer')
