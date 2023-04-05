@extends('layouts.master')

@section('title')
{{ 'My Account' . ' | '. env('APP_NAME') }}
@endsection

@section('content')
	<!-- Start of Main -->
    <main class="main">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Vendor Account</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>Vendor account</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content container pt-2">
            <div class="row">
                <div class="col-md-3">
                    @include('pages.vendor.nav')
                </div>
                <div class="col-md-9">
                    <div>
                        <h3>Account Details</h3>
                        @if(Auth::user()->is_affiliate == 1)
                        <p>Referral Link - <a href="{{ route('index').'?referral='.Auth::id() }}">{{ route('index').'?referral='.Auth::id() }}</a></p>
                        @endif
                    </div>
                    <form class="form account-details-form" action="{{ route('customer.account.update', Auth::id()) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}"
                                        class="form-control form-control-md">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone *</label>
                                    <input type="text" id="phone" name="phone" value="{{ Auth::user()->phone }}"
                                        class="form-control form-control-md">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-6">
                            <label for="email_1">Email address *</label>
                            <input type="email" id="email_1" value="{{ Auth::user()->email }}" name="email" class="form-control form-control-md" readonly>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" id="image" name="image" class="form-control form-control-md">
                                    @if(Auth::user()->image != NULL)
                                    <img src="{{ asset('images/customer/'.Auth::user()->image) }}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nid">NID (Scan copy of your NID)</label>
                                    <input type="file" id="nid" name="nid" class="form-control form-control-md">
                                    @if(Auth::user()->nid != NULL)
                                    <img src="{{ asset('images/customer/nid/'.Auth::user()->nid) }}">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="display-name">Address *</label>
                            <input type="text" id="display-name" name="address" value="{{ Auth::user()->address }}" class="form-control form-control-md mb-0">
                        </div>
                        <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
                    </form>
                    <form class="pt-4 form account-details-form" action="{{ route('customer.password.change') }}" method="post">
                        @csrf
                        <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
                        <div class="form-group">
                            <label class="text-dark" for="cur-password">Current Password</label>
                            <input type="password" class="form-control form-control-md"
                                id="cur-password" name="c_password">
                        </div>
                        <div class="form-group">
                            <label class="text-dark" for="new-password">New Password</label>
                            <input type="password" class="form-control form-control-md"
                                id="new-password" name="n_password">
                        </div>
                        <div class="form-group mb-10">
                            <label class="text-dark" for="conf-password">Confirm Password</label>
                            <input type="password" class="form-control form-control-md"
                                id="conf-password" name="cf_password">
                        </div>
                        <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    <!-- End of Main -->
@endsection