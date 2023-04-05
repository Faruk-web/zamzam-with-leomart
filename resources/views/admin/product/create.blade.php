@extends('admin.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" target="_blank">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <style>
        #single-image-preview{
            display: flex;
            flex-wrap: wrap;
        }
        #previews {
            display: flex;
            flex-wrap: wrap;
        }

        #single-image-preview img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin: 10px;
            border: 1px solid #ccc;
        }
        #previews img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin: 10px;
            border: 1px solid #ccc;
        }
    </style>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body p-0">
                            <div class="col-12 col-sm-12">
                                <div class="card card-primary card-tabs">
                                    <div class="card-header p-0 pt-1">
                                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                            @php
                                                session(['activeTab' => session('activeTab', 'custom-tabs-two-home')]);
                                            @endphp
                                            @php
                                                $submission = \App\Models\Product::where('submission', 2)->first();
                                            @endphp
                                            <li class="nav-item">
                                                <a class="nav-link {{ session('activeTab') == 'custom-tabs-two-home' ? 'active' : '' }}" id="custom-tabs-two-home-tab"  data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Product Basic Information</a>
                                            </li>
                                            @if($submission == true)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ session('activeTab') == 'custom-tabs-two-profile' ? 'active' : '' }}" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Description</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link {{ session('activeTab') == 'custom-tabs-two-messages' ? 'active' : '' }}" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Variants, Price, Stock</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link {{ session('activeTab') == 'custom-tabs-two-settings' ? 'active' : '' }}" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Service & Warranty</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-two-tabContent">
                                            <div class="tab-pane fade {{ session('activeTab') == 'custom-tabs-two-home' ? 'show active' : '' }}" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                                @include('admin.product.add-product.basic')
                                            </div>
                                            <div class="tab-pane fade {{ session('activeTab') == 'custom-tabs-two-profile' ? 'show active' : '' }}" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                                                @include('admin.product.add-product.description')
                                            </div>
                                            <div class="tab-pane fade {{ session('activeTab') == 'custom-tabs-two-messages' ? 'show active' : '' }}" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                                                @include('admin.product.add-product.variation')
                                            </div>
                                            <div class="tab-pane fade {{ session('activeTab') == 'custom-tabs-two-settings' ? 'show active' : '' }}" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                                                @include('admin.product.add-product.service')
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
                var target = e.target.getAttribute("href").substring(1);
                sessionStorage.setItem('activeTab', target);
            });
        });
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>


    <script>
        // Save the active tab index when a tab is selected
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            var activeTabIndex = $(e.target).parent().index();
            localStorage.setItem('activeTabIndex', activeTabIndex);
        });

        // Activate the saved active tab on page reload
        $(function() {
            var activeTabIndex = localStorage.getItem('activeTabIndex');
            if (activeTabIndex !== null) {
                $('.nav-tabs li').eq(activeTabIndex).find('a').tab('show');
            }
        });
    </script>




    <script>
        const checking = document.querySelectorAll(".group1");

        checking.forEach((checkboxs) => {
            checkboxs.addEventListener("click", () => {
                checking.forEach((c) => {
                    if (c !== checkboxs) {
                        c.checked = false;
                    }
                });
            });
        });


    </script>

    <script>
        const checkboxes = document.getElementsByName("unit");

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("click", () => {
                checkboxes.forEach((c) => {
                    if (c !== checkbox) {
                        c.checked = false;
                    }
                });
            });
        });
    </script>


@endsection

@section('scripts')
    <script>
        $('#category_id').change(function(){
            var category_id = $(this).val();
            if (category_id == ''){
                category_id = -1;
            }
            var option = "";
            var url = "{{ url('/') }}";

            $.get( url + "/get-sub-category/"+category_id, function( data ) {
                data = JSON.parse(data);
                option += "<option value='' selected disabled>Select Sub Category</option>";
                data.forEach(function (element) {
                    option += "<option value='"+ element.id +"'>"+ element.title + "</option>";
                });
                //console.log(option);
                $('#sub_category').html(option);
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $("input[type='radio']").change(function() {
                if ($(this).val() == "variation") {
                    $("#variation").show();
                }
                else {
                    $("#variation").hide();
                }

                if ($(this).val() == "single") {
                    $("#single").show();
                }
                else {
                    $("#single").hide();
                }
            });
        });
    </script>
@endsection

