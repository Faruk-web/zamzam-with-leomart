@extends('layouts.master')

@section('title')
    {{ 'Return And Refund Policy' . ' | '. env('APP_NAME') }}
@endsection



@section('content')

    <!-- Start of Main -->
    <main class="main contact">
        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">
                <!-- Start of Breadcrumb -->
                <nav class="breadcrumb-nav">
                    <div class="container">
                        <ul class="breadcrumb bb-no">
                            <li><a href="{{ route('products') }}">Home</a></li>
                            <li>Return And Refund Policy</li>
                        </ul>
                    </div>
                </nav>
                <!-- End of Breadcrumb -->

                <div class="row">

                    <div class="col-md-12">
                        <div style="padding: 15px;border: 1px solid #336699;">
                            <h2 class="pt-4 pb-4">Return And Refund Policy</h2>
                            {!! $return->description !!}
                        </div>

                    </div>

                </div>
            </div>
            <!-- End of PageContent -->
        </div>
    </main>
    <!-- End of Main -->

@endsection
