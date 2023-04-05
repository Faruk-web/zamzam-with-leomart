<div class="card">
    <div class="card-header bg-primary">
        <p style="color: #fff;font-size: 20px;margin: 0px;">Hello, {{ Auth::user()->name . ' ' . Auth::user()->last_name }}</p>
    </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><a href="{{route('vendor.desboard')}}">Dashboard</a></li>
    <li class="list-group-item"><a href="{{ route('vendor.product') }}">Products</a></li>
    <li class="list-group-item"><a href="{{ route('vendor.orders') }}">Orders</a></li>
    <li class="list-group-item"><a href="{{ route('vendor.orders') }}">Comissions</a></li>
    <li class="list-group-item"><a href="{{ route('vendor.wishlist') }}">Wishlist</a></li>
    <li class="list-group-item"><a href="{{ route('vendor.wallet') }}">My Wallet</a></li>
    <li class="list-group-item"><a href="{{ route('vendor.account') }}">Account details</a></li>
    <li class="list-group-item"><a href="{{ route('vendor.profile') }}">Profile</a></li>
    @if(Auth::user()->is_affiliate == 0)
    <li class="list-group-item"><a href="#affiliateModal" data-toggle="modal">Become an Affiliate</a></li>
    @endif
    @if(Auth::user()->is_affiliate == 1)
    <li class="list-group-item"><a href="{{ route('customer.affiliate.dashboard') }}">Affiliate Dashboard</a></li>
    @endif
  </ul>
</div>
