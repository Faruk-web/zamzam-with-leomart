{{-- @extends('layouts.app') --}}
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Register | Skote - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico')}}">
        <!-- Bootstrap Css -->
        <link href="{{ asset('backend/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('backend/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('backend/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <style>
            .required {
                color: red;
            }
        </style>

    </head>
@php
     $countries = WisdomDiala\Countrypkg\Models\Country::all();
     $divisions = App\Division::all();
     $thanas = App\Thana::all();
     $unions = App\Union::all();
     $districts = App\District::all();
@endphp
@extends('layouts.app')
@section('content')
    <body>
        <div class="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="card overflow-hidden">
                            <div class="">
                                <img src="{{asset('backend/images/vendor-reg.png')}}" alt="" style="height: 200px; width: 100%">
                            </div>
                            <div class="card-body pt-0" style="background-color: #eb941147;">
                                <div class="p-2 ">
                                    <h1 class="text-center" style="color: #8f059b;">Registration Form</h1>
                                    <hr class="background: linear-gradient(red, blue)">
                                    <div style="background-color: rgb(33, 5, 99);">
                                        <h2 class="mt-3 text-left" style="color:#fff;margin-left: 10px;">Personal Information</h2>
                                    </div>
                                    <form method="POST" action="{{ route('vendor.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mt-3">

                                        <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">First Name<span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="name" placeholder="First Name" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Name
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Last Name<span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Name
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email<span class="required">*</span></label>
                                                    <input type="email" id="email" class="form-control" name="email" placeholder="Enter Valid Email Address" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Email
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Password<span class="required">*</span></label>
                                                    <input type="email" id="email" class="form-control" name="password" placeholder="Enter Valid Email Address" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Password
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Mobile No 1<span class="required">*</span></label>
                                                    <input type="text" class="form-control"  name="phone" placeholder="Enter Mobile No" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Mobile No
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Mobile No 2<span class="required">*</span></label>
                                                    <input type="text" class="form-control"  name="last_phone" placeholder="Enter Mobile No" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Mobile No
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Shop/Office Name<span class="required">*</span></label>
                                                    <input type="text" class="form-control"  name="shop_office_name" placeholder="Enter Shop/Office Name" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Shop/Office Name
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Personal NID No<span class="required">*</span></label>
                                                    <input type="text" class="form-control"  name="p_nid" placeholder="Enter Personal NID No" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Mobile No
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">NID Image (Front Side)<span class="required">*</span></label>
                                                    <input type="file" class="form-control"  name="nid_image_front_side" placeholder="Enter NID Image (Front Side)" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter NID Image (Front Side)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">NID Image (Back Side)<span class="required">*</span></label>
                                                    <input type="file" class="form-control"  name="nid_image_back_side" placeholder="Enter NID Image (Back Side)" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter NID Image (Back Side)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Business Trade License No<span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="trade_license_no" placeholder="Enter Business Trade License No" required>
                                                    <div class="invalid-feedback">
                                                        Please EnterBusiness Trade License No
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Trade License Image<span class="required">*</span></label>
                                                    <input type="file" class="form-control"  name="trade_license_image" placeholder="Enter Trade License Image" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter Trade License Image
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="background-color: rgb(33, 5, 99);">
                                                <h2 class="mt-1 text-left" style="font-size:20px;color:#fff;margin-left: 10px;">Shop/Office Address</h2>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <div class="mb-3">
                                                    <label>Country <span style="color: red">*</span></label>
                                                    <select name="country_id" onchange="getDivision(this.value)" class="form-control present-address @error('country') is-invalid @enderror" required>
                                                        <option value="" selected disabled style="background-color: #5fa4cc; color: #0c525d">Please Chose country</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{$country->id}}" style="background-color: #5fa4cc;color: #0c525d">{{$country->name}}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('country_id')
                                                    <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <div class="mb-3">
                                                    <label>Division<span style="color: red">*</span></label>
                                                    <select name="division_id" id="getDivisionId" onchange="getDistrict(this.value)" class="form-control present-address @error('division_id') is-invalid @enderror" required>
                                                        <option value="" selected disabled style="background-color: #5fa4cc; color: #0c525d">Please Chose a Division</option>
                                                        @foreach($divisions as $item)
                                                            <option value="{{ $item->id }}" style="background-color: #5fa4cc; color: #0c525d">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('district_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label>State/District<span style="color: red">*</span></label>
                                                    <select name="district_id" id="getDistrictId" onchange="getThana(this.value)" class="form-control present-address @error('district_id') is-invalid @enderror" required >
                                                        <option value="" selected disabled >Please Chose a State/District</option>
                                                    </select>
                                                    @error('district_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label>City/Thana <span style="color: red">*</span></label>
                                                    <select name="thana_id" id="getThanaId" class="form-control present-address @error('thana_id') is-invalid @enderror" required>
                                                        <option value="" selected disabled>Please Chose a City/Thana</option>

                                                    </select>
                                                    @error('thana_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">House No & Name<span class="required">*</span></label>
                                                    <input type="text" class="form-control present-address" name="first_house_no" required>
                                                    <div class="invalid-feedback">
                                                        Please insart Image
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="background-color: rgb(33, 5, 99);">
                                                <h2 class="mt-1 text-left" style="font-size:20px;color:#fff;margin-left: 10px;">Pickup Point
                                                        <input type="checkbox" name="same_as" id="same_as_checkbox">
                                                        Same As Shop/Office Address</h2>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <div class="mb-3">
                                                    <label>Country <span style="color: red">*</span></label>
                                                    <select name="second_country_id" onchange="getDivisionSecond(this.value)" class="form-control permanent-address @error('country') is-invalid @enderror" required>
                                                        <option value="" selected disabled style="background-color: #5fa4cc; color: #0c525d">Please Chose country</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{$country->id}}" style="background-color: #5fa4cc;color: #0c525d">{{$country->name}}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('second_country_id')
                                                    <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <div class="mb-3">
                                                    <label>Division<span style="color: red">*</span></label>
                                                    <select name="second_division_id" id="getDivisionSecondId" onchange="getDistrictSecond(this.value)" class="form-control permanent-address @error('division_id') is-invalid @enderror" required>
                                                        <option value="" selected disabled style="background-color: #5fa4cc; color: #0c525d">Please Chose a Division</option>
                                                        @foreach($divisions as $item)
                                                            <option value="{{ $item->id }}" style="background-color: #5fa4cc; color: #0c525d">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('second_division_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label>State/District<span style="color: red">*</span></label>
                                                    <select name="second_district_id" id="getDistrictSecondId" onchange="getThanaSecond(this.value)" class="form-control permanent-address @error('district_id') is-invalid @enderror" required >
                                                        <option value="" selected disabled >Please Chose a State/District</option>
                                                    </select>
                                                    @error('second_district_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label>City/Thana <span style="color: red">*</span></label>
                                                    <select name="second_thana_id" id="getThanaSecondId" class="form-control permanent-address @error('thana_id') is-invalid @enderror" required>
                                                        <option value="" selected disabled>Please Chose a City/Thana</option>

                                                    </select>
                                                    @error('second_thana_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">House No & Name<span class="required">*</span></label>
                                                    <input type="text" class="form-control permanent-address" name="house_no" required>
                                                    <div class="invalid-feedback">
                                                        Please House No & Name
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="background-color: rgb(33, 5, 99);">
                                                <h2 class="mt-1 text-left" style="font-size:20px;color:#fff;margin-left: 10px;">Pickup Point (Same As Shop/Office Address)</h2>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Cross Border Product<span class="required">*</span></label>
                                                    <select name="thrd_country_id"  class="form-control  @error('country') is-invalid @enderror" required>
                                                        <option value="" selected disabled style="background-color: #5fa4cc; color: #0c525d">Please Chose country</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{$country->id}}" style="background-color: #5fa4cc;color: #0c525d">{{$country->name}}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('thrd_country_id')
                                                    <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Business Type<span class="required">*</span></label>
                                                    <select type="text" class="form-control" name="business_type">
                                                        <option selected>Select Business Type</option>
                                                        <option value="Retailer">Retailer</option>
                                                        <option value="Manufacturer">Manufacturer</option>
                                                        <option value="Wholeseller">Wholeseller</option>
                                                        <option value="Manufacturer & Retailer">Manufacturer & Retailer</option>
                                                        <option value="Manufacturer & Wholeseller">Manufacturer & Wholeseller</option>
                                                        <option value="Wholeseller & Retailer">Wholeseller & Retailer</option>
                                                        <option value="Manufacturer & Wholeseller & Retailer">Manufacturer & Wholeseller & Retailer</option>
                                                      </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary text-center" style="margin-left: 24%;">
                                                    {{ __('Register') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-4 text-center">
                                    <h5 class="font-size-14 mb-3">Sign up using</h5>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">
                                                <i class="mdi mdi-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                                                <i class="mdi mdi-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                                                <i class="mdi mdi-google"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center mb-5">

                            <div>
                                <p>Already have an account ? <a href="{{route('vendor.login')}}" class="fw-medium text-primary"> Login</a> </p>
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Leomart. Design And Develop <i class="mdi mdi-heart text-danger"></i> by
                                    <a href="https://www.leotechbd.com/" target="_blank"><img src="{{asset('backend/images/leotech-logo.png')}}" alt="Leotech" height="50" class="auth-logo-light"></a></p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('backend/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('backend/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{ asset('backend/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ asset('backend/libs/node-waves/waves.min.js')}}"></script>

        <!-- validation init -->
        <script src="{{ asset('backend/js/pages/validation.init.js')}}"></script>

        <!-- App js -->
        <script src="{{ asset('backend/js/app.js')}}"></script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const sameAsCheckbox = document.querySelector('#same_as_checkbox');
                    const presentAddressSelects = document.querySelectorAll('.present-address');
                    const permanentAddressSelects = document.querySelectorAll('.permanent-address');

                    sameAsCheckbox.addEventListener('click', function () {
                        // console.log(permanentAddressSelects);
                        if (sameAsCheckbox.checked) {
                            for (let i = 0; i < presentAddressSelects.length; i++) {
                                permanentAddressSelects[i].selectedIndex = presentAddressSelects[i].selectedIndex;
                                permanentAddressSelects[i].disabled = true;
                            }
                        } else {
                            for (let i = 0; i < permanentAddressSelects.length; i++) {
                                permanentAddressSelects[i].selectedIndex = 0;
                                permanentAddressSelects[i].disabled = false;
                            }
                        }
                    });
                    const presentAddressInputs = document.querySelectorAll('.present-address');
                    const permanentAddressInputs = document.querySelectorAll('.permanent-address');

                    sameAsCheckbox.addEventListener('click', function () {
                        if (sameAsCheckbox.checked) {
                            permanentAddressInputs[0].value = presentAddressInputs[0].value;
                            permanentAddressInputs[0].disabled = true;
                            for (let i = 1; i < presentAddressInputs.length; i++) {
                                permanentAddressInputs[i].value = presentAddressInputs[i].value;
                                permanentAddressInputs[i].disabled = true;
                            }
                        } else {
                            for (let i = 0; i < presentAddressInputs.length; i++) {
                                permanentAddressInputs[i].value = '';
                                permanentAddressInputs[i].disabled = false;
                            }
                        }
                    });

                });
            </script>


            @endsection
    <script>

        function getDivision(id)
        {
            $.ajax({
                method: "GET",
                url: "{{url('/get-division-by-country-id')}}",
                data: {id: id},
                dataType: "JSON",
                success: function (response) {
                    console.log(response);

                    var getDivisionId = $('#getDivisionId');
                    getDivisionId.empty();

                    var option = '';
                    option += '<option value="" style="background-color: #5fa4cc; color: #0c525d"> Please Chose a Division </option>';
                    $.each(response, function (key, value) {
                        option += '<option value=" '+ value.id +' " style="background-color: #5fa4cc; color: #0c525d"> ' + value.name+ ' </option>';
                    });

                    getDivisionId.append(option);
                }
            });
        }
        function getDivisionSecond(id)
        {
            $.ajax({
                method: "GET",
                url: "{{url('/get-division-by-country-id')}}",
                data: {id: id},
                dataType: "JSON",
                success: function (response) {
                    console.log(response);

                    var getDivisionSecondId = $('#getDivisionSecondId');
                    getDivisionSecondId.empty();

                    var option = '';
                    option += '<option value="" style="background-color: #5fa4cc; color: #0c525d"> Please Chose a Division </option>';
                    $.each(response, function (key, value) {
                        option += '<option value=" '+ value.id +' " style="background-color: #5fa4cc; color: #0c525d"> ' + value.name+ ' </option>';
                    });

                    getDivisionSecondId.append(option);
                }
            });
        }


    </script>

    <script>

        function getDistrict(id)
        {
            $.ajax({
                method: "GET",
                url: "{{url('/get-district-by-division-id')}}",
                data: {id: id},
                dataType: "JSON",
                success: function (response) {
                    console.log(response);

                    var getDistrictId = $('#getDistrictId');
                    getDistrictId.empty();

                    var option = '';
                    option += '<option value="" style="background-color: #5fa4cc; color: #0c525d"> Please Chose a State/District </option>';
                    $.each(response, function (key, value) {
                        option += '<option value=" '+ value.id +' " style="background-color: #5fa4cc; color: #0c525d"> ' + value.name+ ' </option>';
                    });

                    getDistrictId.append(option);
                }
            });
        }
        function getDistrictSecond(id)
        {
            $.ajax({
                method: "GET",
                url: "{{url('/get-district-by-division-id')}}",
                data: {id: id},
                dataType: "JSON",
                success: function (response) {
                    console.log(response);

                    var getDistrictSecondId = $('#getDistrictSecondId');
                    getDistrictSecondId.empty();

                    var option = '';
                    option += '<option value="" style="background-color: #5fa4cc; color: #0c525d"> Please Chose a State/District </option>';
                    $.each(response, function (key, value) {
                        option += '<option value=" '+ value.id +' " style="background-color: #5fa4cc; color: #0c525d"> ' + value.name+ ' </option>';
                    });

                    getDistrictSecondId.append(option);
                }
            });
        }

    </script>


    <script>

        function getThana(id)
        {
            $.ajax({
                method: "GET",
                url: "{{url('/get-thana-by-district-id')}}",
                data: {id: id},
                dataType: "JSON",
                success: function (response) {
                    console.log(response);

                    var getThanaId = $('#getThanaId');
                    getThanaId.empty();

                    var option = '';
                    option += '<option value="" style="background-color: #5fa4cc; color: #0c525d"> Please Chose a City/Thana </option>';
                    $.each(response, function (key, value) {
                        option += '<option value=" '+ value.id +' " style="background-color: #5fa4cc; color: #0c525d"> ' + value.name+ ' </option>';
                    });

                    getThanaId.append(option);
                }
            });
        }
        function getThana(id)
        {
            $.ajax({
                method: "GET",
                url: "{{url('/get-thana-by-district-id')}}",
                data: {id: id},
                dataType: "JSON",
                success: function (response) {
                    console.log(response);

                    var getThanaId = $('#getThanaId');
                    getThanaId.empty();

                    var option = '';
                    option += '<option value="" style="background-color: #5fa4cc; color: #0c525d"> Please Chose a City/Thana </option>';
                    $.each(response, function (key, value) {
                        option += '<option value=" '+ value.id +' " style="background-color: #5fa4cc; color: #0c525d"> ' + value.name+ ' </option>';
                    });

                    getThanaId.append(option);
                }
            });
        }
        function getThanaSecond(id)
        {
            $.ajax({
                method: "GET",
                url: "{{url('/get-thana-by-district-id')}}",
                data: {id: id},
                dataType: "JSON",
                success: function (response) {
                    console.log(response);

                    var getThanaSecondId = $('#getThanaSecondId');
                    getThanaSecondId.empty();

                    var option = '';
                    option += '<option value="" style="background-color: #5fa4cc; color: #0c525d"> Please Chose a City/Thana </option>';
                    $.each(response, function (key, value) {
                        option += '<option value=" '+ value.id +' " style="background-color: #5fa4cc; color: #0c525d"> ' + value.name+ ' </option>';
                    });

                    getThanaSecondId.append(option);
                }
            });
        }

    </script>

    </body>
</html>







