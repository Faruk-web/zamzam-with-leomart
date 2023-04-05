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
        @if(Auth::user()->vendor_status == '1')
              <li class="nav-item">
                  <a href="{{ route('vendor.desboard') }}" class="nav-link {{ Route::currentRouteName() == 'vendor.desboard' ? 'active ' : '' }}">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                          Dashboard
                      </p>
                  </a>
              </li>
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
                          <a href="{{ route('vendor.product.show') }}" class="nav-link ">
                              <p>
                                  All Products
                              </p>
                          </a>
                      </li>
                      <li class="nav-item ">
                          <a href="{{ route('vendor.product') }}" class="nav-link ">
                              <p>
                                  Add Product
                              </p>
                          </a>
                      </li>
                      <li class="nav-item ">
                          <a href="{{ route('vendor.product.tutorial') }}" class="nav-link ">
                              <p>How To Add Product</p>
                          </a>
                      </li>

                  </ul>
              </li>

              <li class="nav-item ">
                  <a href="#" class="nav-link ">
                      <i class="nav-icon fas fa-gift "></i>
                      <p>
                          Coupon/Voucher
                          <i class="fas fa-angle-right right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">

                      <li class="nav-item">
                          <a href="{{ route('coupon.index') }}" class="nav-link ">
                              <p>
                                  Coupon/Voucher Manage
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('coupon.tutorial') }}" class="nav-link ">
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
              <li class="nav-item">
                  <a href="#" class="nav-link ">
                      <i class="nav-icon fas fa-shopping-cart "></i>
                      <p>
                          Orders
                          <i class="fas fa-angle-right right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      @foreach(App\Models\OrderStatus::all() as $status)
                      <li class="nav-item">
                        <a href="{{ route('order.ventor.status.filter', $status->id) }}" class="nav-link ">
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
                  <a href="{{ route('rating-review.show') }}" class="nav-link ">
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
              <li class="nav-item ">
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
              <li class="nav-item">
                <a href="{{ route('review.replay') }}" class="nav-link">
                    <i class="nav-icon fas fa-life-ring"></i>
                    <p>
                        Review Replay
                    </p>
                </a>
            </li>
        @endif
        <div class="p-2"></div>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
