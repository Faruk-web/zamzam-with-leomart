<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <!-- <a href="" class="brand-link" target="_blank" style="background-color: #fff">
    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light" style="color: #000;">{{ env('APP_NAME') }}</span>
  </a> -->

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('images/user-avatar-icon.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2" id="sidebar">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        @if(Auth::user()->type == 1)
              <li class="nav-item ">
                  <a href="{{ route('home') }}" class="nav-link {{ $routeName === 'home' ? 'active' : '' }}">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                          Dashboard
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.crm') }}" class="nav-link {{ $routeName === 'admin.crm' ? 'active' : '' }}">
                      <i class="nav-icon fas fa-user-friends"></i>
                      <p>
                          CRM
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.role') }}" class="nav-link {{ $routeName === 'admin.role' ? 'active' : '' }}">
                      <i class="nav-icon fab fa-r-project"></i>
                      <p>
                          Roles
                      </p>
                  </a>
              </li>
        <li class="nav-item {{ Route::currentRouteName() == 'admin.index' ? 'active menu-open ' : '' }}">
          <a href="#" class="nav-link {{ Route::currentRouteName() == 'admin.index' ? 'active ' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              User Management
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview ">
            <li class="nav-item">
              <a href="{{ route('admin.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.index' ? 'active ' : '' }}">
                <p>Adminstrators</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="{{ route('customer.index') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Customers</p>
              </a>
            </li> -->
          </ul>
        </li>
        <li class="nav-item {{ $routeName === 'admin.sidebar.create' ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ $routeName === 'admin.sidebar.create' ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Sidebar Management
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.sidebar.create') }}" class="nav-link {{ $routeName === 'admin.sidebar.create' ? 'active' : '' }}">
                <p>Create Sidebar</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="{{ route('customer.index') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Customers</p>
              </a>
            </li> -->
          </ul>
        </li>
        <li class="nav-item {{ in_array($routeName, ['product.index', 'product.create', 'category.index', 'brand.index', 'variation.index', 'attributes', 'tutorial.index']) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ in_array($routeName, ['product.index', 'product.create', 'category.index', 'brand.index', 'variation.index', 'attributes', 'tutorial.index']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Product
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('product.index') }}" class="nav-link {{ $routeName === 'product.index' ? 'active' : '' }}">
                <p>Products List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('product.create') }}" class="nav-link {{ $routeName === 'product.create' ? 'active' : '' }}">
                <p>Add Product</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('category.index') }}" class="nav-link {{ $routeName === 'category.index' ? 'active' : '' }}">
                <p>Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('brand.index') }}" class="nav-link {{ $routeName === 'brand.index' ? 'active' : '' }}">
                <p>Brand</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('variation.index') }}" class="nav-link {{ $routeName === 'variation.index' ? 'active' : '' }}">
                <p>Variation</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('attributes') }}" class="nav-link {{ $routeName === 'attributes' ? 'active' : '' }}">
                <p>Attributes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('tutorial.index') }}" class="nav-link {{ $routeName === 'tutorial.index' ? 'active' : '' }}">
                <p>How to add product tutorial</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item {{ in_array($routeName, ['product.vendor.request', 'product.vendor.approved', 'product.vendor.list']) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ in_array($routeName, ['product.vendor.request', 'product.vendor.approved', 'product.vendor.list']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-vector-square"></i>
            <p>
              Vendor
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('product.vendor.request') }}" class="nav-link {{ $routeName === 'product.vendor.request' ? 'active' : '' }}">
                <p>Products Request List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('product.vendor.approved') }}" class="nav-link {{ $routeName === 'product.vendor.approved' ? 'active' : '' }}">
                <p>Products Approved List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('product.vendor.list') }}" class="nav-link {{ $routeName === 'product.vendor.list' ? 'active' : '' }}">
                <p>Vendor List</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item {{ in_array($routeName, ['order.index', 'order.status.filter']) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ in_array($routeName, ['order.index', 'order.status.filter']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-plus-square"></i>
            <p>
              Orders
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('order.index') }}" class="nav-link {{ $routeName === 'order.index' ? 'active' : '' }}">
                <p>All Orders</p>
              </a>
            </li>
            @foreach(App\Models\OrderStatus::all() as $status)
            <li class="nav-item">
              <a href="{{ route('order.status.filter', $status->id) }}" class="nav-link {{ $routeName === 'order.status.filter', $status->id ? 'active' : '' }}">
                <p>{{ $status->title }}</p>
              </a>
            </li>
            @endforeach
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-ad"></i>
            <p>
              Campaign
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{ route('coupon.index') }}" class="nav-link">
                <p>Coupon</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('registration.point.index') }}" class="nav-link">
                <p>Registration Point</p>
              </a>
            </li>
{{--            <li class="nav-item">--}}
{{--              <a href="{{ route('offer.index') }}" class="nav-link">--}}
{{--                <p>Offer</p>--}}
{{--              </a>--}}
{{--            </li>--}}

          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-certificate"></i>
            <p>
              Affiliate
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{ route('affiliate.request') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Seller Requests</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('affiliate.payment.request') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Payment Requests</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('affiliate.config') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Configuration</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.subscribers') }}" class="nav-link">
            <i class="nav-icon fas fa-bell-slash"></i>
            <p>
              Subscribers
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-map-marker-alt"></i>
            <p>
              Location
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{ route('district.index') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>District List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('area.index') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Area List</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Settings
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{ route('setting.index') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Business Settings</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('refund.index') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Refund Policy</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setting.reward.point') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Reward Point Settings</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('slider.index') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Slider Option</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('page.index') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Pages</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('gallery.index') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Gallery</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('referral.link.index') }}" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Referral Link</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="" class="nav-link">
                <i class="fas fa-angle-right"></i>
                <p>Sponsors</p>
              </a>
            </li> -->

          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('user.profile') }}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Profile
            </p>
          </a>
        </li>
        @endif
        @if(Auth::user()->type == 2)
              <li class="nav-item">
                  <a href="{{ route('vendor.desboard') }}" class="nav-link {{ Route::currentRouteName() == 'vendor.desboard' ? 'active ' : '' }}">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                          Dashboard
                      </p>
                  </a>
              </li>
{{--              <li class="{{ $parentMenuItemId === 'settings' ? 'active' : '' }} {{ strpos($routeName, 'settings') !== false ? 'menu-open' : '' }}">--}}
{{--                  <a href="#">Settings</a>--}}
{{--                  <ul class="nav nav-treeview">--}}
{{--                      <li class="{{ $routeName === 'settings.general' ? 'active' : '' }}"><a href="{{ route('settings.general') }}">General</a></li>--}}
{{--                      <li class="{{ $routeName === 'vendor.product.show' ? 'active' : '' }}"><a href="{{ route('vendor.product.show') }}">Security</a></li>--}}
{{--                  </ul>--}}
{{--              </li>--}}
              <li class="nav-item {{ Route::currentRouteName() == 'vendor.product.tutorial' ? 'menu-open' : '' }} {{ Route::currentRouteName() == 'vendor.product.show' ? 'menu-open' : '' }}{{ Route::currentRouteName() == 'vendor.pp' ? 'menu-open' : '' }}{{ Route::currentRouteName() == 'vendor.product' ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ Route::currentRouteName() == 'vendor.product.show' ? 'active ' : '' }} {{ Route::currentRouteName() == 'vendor.product.tutorial' ? 'active ' : '' }}{{ Route::currentRouteName() == 'vendor.pp' ? 'active ' : '' }}{{ Route::currentRouteName() == 'vendor.product' ? 'active ' : '' }}">
                      <i class="nav-icon fab fa-product-hunt"></i>
                      <p>
                          Products
                          <i class="fas fa-angle-right right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview ">

                      <li class="nav-item ">
                          <a href="{{ route('vendor.product.show') }}" class="nav-link {{ $routeName === 'vendor.product.show' ? 'active' : '' }}">
                              <p>
                                  All Products
                              </p>
                          </a>
                      </li>
                      <li class="nav-item ">
                          <a href="{{ route('vendor.product') }}" class="nav-link {{ $routeName === 'vendor.product' ? 'active' : '' }}">
                              <p>
                                  Add Product
                              </p>
                          </a>
                      </li>
{{--                      <li class="nav-item ">--}}
{{--                          <a href="{{ route('vendor.pp') }}" class="nav-link {{ $routeName === 'vendor.pp' ? 'active' : '' }}">--}}
{{--                              <p>--}}
{{--                                  All Products vendor--}}
{{--                              </p>--}}
{{--                          </a>--}}
{{--                      </li>--}}
                      <li class="nav-item ">
                          <a href="{{ route('vendor.product.tutorial') }}" class="nav-link {{ $routeName === 'vendor.product.tutorial' ? 'active' : '' }}">
                              <p>How To Add Product</p>
                          </a>
                      </li>

                  </ul>
              </li>

              <li class="nav-item {{ $routeName === 'coupon.index' ? 'menu-open' : '' }} {{ $routeName === 'coupon.tutorial' ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ $routeName === 'coupon.index' ? 'active' : '' }} {{ $routeName === 'coupon.tutorial' ? 'active' : '' }}">
                      <i class="nav-icon fas fa-gift "></i>
                      <p>
                          Coupon/Voucher
                          <i class="fas fa-angle-right right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">

                      <li class="nav-item">
                          <a href="{{ route('coupon.index') }}" class="nav-link {{ $routeName === 'coupon.index' ? 'active' : '' }}">
                              <p>
                                  Coupon/Voucher Manage
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('coupon.tutorial') }}" class="nav-link {{ $routeName === 'coupon.tutorial' ? 'active' : '' }}">
                              <p>How To Add Coupon/voucher</p>
                          </a>
                      </li>

                  </ul>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-bullhorn "></i>
                      <p>
                          Promotion
                          <i class="fas fa-angle-right right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">

                      <li class="nav-item">
                          <a href="{{ route('coupon.index') }}" class="nav-link">
                              <p>
                                  Champaign
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('coupon.index') }}" class="nav-link">
                              <p>
                                  Bundle
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('coupon.index') }}" class="nav-link">
                              <p>
                                  Seller Voucher
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('coupon.index') }}" class="nav-link">
                              <p>
                                  Free Shipping
                              </p>
                          </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-item {{ $routeName === 'order.status.filter' ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link {{ $routeName === 'order.status.filter' ? 'active' : '' }}">
                      <i class="nav-icon fas fa-shopping-cart "></i>
                      <p>
                          Orders
                          <i class="fas fa-angle-right right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">

                      {{-- <li class="nav-item">
                          <a href="{{ route('coupon.index') }}" class="nav-link">
                              <p>
                                  Pending Order
                              </p>
                          </a>
                      </li> --}}
                      @foreach(App\Models\OrderStatus::all() as $status)
                      <li class="nav-item">
                        <a href="{{ route('order.ventor.status.filter', $status->id) }}" class="nav-link {{ $routeName === 'order.status.filter' ? 'active' : '' }}">
                          <p>{{ $status->title }}</p>
                        </a>
                      </li>
                      @endforeach
                      <li class="nav-item">
                          <a href="{{ route('order.today.order') }}" class="nav-link">
                              <p>
                                  Today Order
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('order.shipped') }}" class="nav-link">
                              <p>
                                  Shipped Order
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('coupon.index') }}" class="nav-link">
                              <p>
                                  Return and refund product
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('order.this-week') }}" class="nav-link">
                              <p>
                                  This Week Order
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('order.most-ordered') }}" class="nav-link">
                              <p>
                                  Most Ordered Product
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('order.order-view') }}" class="nav-link">
                              <p>
                                  Order Overview
                              </p>
                          </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-item">
                  <a href="{{ route('rating-review.show') }}" class="nav-link {{ $routeName === 'rating-review.show' ? 'active' : '' }}">
                      <i class="nav-icon fas fa-star"></i>
                      <p>
                          Ratings and Reviews
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('vendor.orders') }}" class="nav-link">
                      <i class="nav-icon fas fa-money-bill-alt"></i>
                      <p>
                          Finance
                      </p>
                  </a>
              </li>
              <li class="nav-item {{ $routeName === 'user.profile' ? 'menu-open' : '' }}">
                  <a href="{{ route('user.profile') }}" class="nav-link">
                      <i class="nav-icon fas fa-user"></i>
                      <p>
                          Profile
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('vendor.wishlist') }}" class="nav-link">
                      <i class="nav-icon fas fa-database"></i>
                      <p>
                          Data Particles
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('vendor.wallet') }}" class="nav-link">
                      <i class="nav-icon fas fa-headset"></i>
                      <p>
                          Sponsor Support
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('vendor.wallet') }}" class="nav-link">
                      <i class="nav-icon fab fa-opencart"></i>
                      <p>
                          E-commerce Social
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('vendor.wallet') }}" class="nav-link">
                      <i class="nav-icon fas fa-life-ring"></i>
                      <p>
                          Support Center
                      </p>
                  </a>
              </li>
{{--              <li class="nav-item">--}}
{{--                  <a href="{{ route('vendor.account') }}" class="nav-link">--}}
{{--                      <i class="nav-icon fas fa-user-alt"></i>--}}
{{--                      <p>--}}
{{--                          Account details--}}
{{--                      </p>--}}
{{--                  </a>--}}
{{--              </li>--}}
{{--              @if(Auth::user()->is_affiliate == 0)--}}
{{--                  <li class="nav-item">--}}
{{--                      <a href="#affiliateModal" data-toggle="modal" class="nav-link">--}}
{{--                          <i class="nav-icon fab fa-affiliatetheme"></i>--}}
{{--                          <p>--}}
{{--                              Become an Affiliate--}}
{{--                          </p>--}}
{{--                      </a>--}}
{{--                  </li>--}}
{{--              @endif--}}
{{--              @if(Auth::user()->is_affiliate == 1)--}}
{{--                  <li class="nav-item">--}}
{{--                      <a href="{{ route('customer.affiliate.dashboard') }}" class="nav-link">--}}
{{--                          <i class="nav-icon fab fa-affiliatetheme"></i>--}}
{{--                          <p>--}}
{{--                              Affiliate Dashboard--}}
{{--                          </p>--}}
{{--                      </a>--}}
{{--                  </li>--}}
{{--              @endif--}}

{{--              <ul class="list-group list-group-flush">--}}
{{--                  <li class="list-group-item"><a href="{{ route('vendor.product') }}">Products</a></li>--}}
{{--                  <li class="list-group-item"><a href="{{ route('vendor.orders') }}">Orders</a></li>--}}
{{--                  <li class="list-group-item"><a href="{{ route('vendor.orders') }}">Comissions</a></li>--}}
{{--                  <li class="list-group-item"><a href="{{ route('vendor.wishlist') }}">Wishlist</a></li>--}}
{{--                  <li class="list-group-item"><a href="{{ route('vendor.wallet') }}">My Wallet</a></li>--}}
{{--                  <li class="list-group-item"><a href="{{ route('vendor.account') }}">Account details</a></li>--}}
{{--                  <li class="list-group-item"><a href="{{ route('vendor.profile') }}">Profile</a></li>--}}
{{--                  @if(Auth::user()->is_affiliate == 0)--}}
{{--                      <li class="list-group-item"><a href="#affiliateModal" data-toggle="modal">Become an Affiliate</a></li>--}}
{{--                  @endif--}}
{{--                  @if(Auth::user()->is_affiliate == 1)--}}
{{--                      <li class="list-group-item"><a href="{{ route('customer.affiliate.dashboard') }}">Affiliate Dashboard</a></li>--}}
{{--                  @endif--}}
{{--              </ul>--}}
{{--        <li class="nav-item">--}}
{{--          <a href="{{ route('customer.dashboard.wallet') }}" class="nav-link">--}}
{{--            <i class="nav-icon fas fa-money-bill-alt"></i>--}}
{{--            <p>--}}
{{--              My Wallet--}}
{{--            </p>--}}
{{--          </a>--}}
{{--        </li>--}}

        @endif
        <div class="p-2"></div>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
