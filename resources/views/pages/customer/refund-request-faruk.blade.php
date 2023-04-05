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
                <h1 class="page-title mb-0">Refund And Return Request</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <link href="{{asset('/')}}backend/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>Refund And Return Request</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->

        <div class="page-content container pt-2">
            <div class="row">
                <div class="col-md-3">
                    @include('pages.customer.nav')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Refund And Return Request</h3>
                                </div>
                                <div class="col-md-6 float-end">
                                    <h4 style="margin-left: 32%;">Date & Time : {{ $order->created_at }}</h4>
                                </div>
                            </div>


                        </div>
                        <div class="block block-rounded d-flex flex-column">
                            <div class="block-content block-content-full justify-content-between align-items-center">
                            <form method="POST" action="">
                            @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class=" p-3 shadow my-1">
                                            <div  class="row" style="display: block;">
                                            <table class="table table-bordered">
                                                <thead class="bg-dark text-light">
                                                    <tr>
                                                        <th width="30%">Name</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Total Price</th>
                                                        <th>X</th>
                                                    </tr>
                                                </thead>
                                            <tbody id="selected_products"></tbody>
                                        </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8"></div>
                                                <div class="col-md-4">
                                                    <label for="">Total Tk:</label>
                                                    <input type="text" class="form-control" id="all_total" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="">Type</label>
                                                    <select name="type" id="" class="form-control">
                                                        <option value="re">Refund and Return</option>
                                                        <option value="ex">Exchange</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="">Refund Getway</label>
                                                    <select name="refund_getway" id="" class="form-control">
                                                        <option value="bkash">Bkash</option>
                                                        <option value="nagad">Nagad</option>
                                                        <option value="bank">Bank</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="">Account Number</label>
                                                    <input type="text" name="account_no" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Date and Time</label>
                                                    <input type="text" readonly name="date" value="{{ $order->created_at }}" class="form-control" id="all_total">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="">Refund And Return cause</label>
                                                    <textarea name="cause" id=""></textarea>
                                                </div>
                                            </div>
                                    </div>
                                     </div>
                                   <div class="col-md-4">
                                    <div class="shadow">
                                        <div class="form-group shadow rounded p-3">
                                            <label for="example-text-input-alt">Search Order Product</label>
                                            <input type="text" class="form-control" id="product_search" value="{{$order->code}}" placeholder="Search By Material Name" name="product_search_code">
                                            <div class="row mt-2 p-3" id="product_show_info" style="display: block">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="" style="padding-top:10px;margin-right: 2%;">
                                        <div class="form-group text-right" id="submit_button_div">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                            </div>
                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    <!-- End of Main -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"
  referrerpolicy="no-referrer"></script>

  <script>
      $(document).ready(function () {
          SidebarColpase();
      });
      $("form").bind("keypress", function (e) {
          if (e.keyCode == 13) {
              return false;
          }
      });

      // Begin:: members Search for
      $('#product_search').blur(function () {
          var product_search_code = $(this).val();
          $.ajax({
              type: 'get',
              url: '/search/raw/material',
              data: {
                  'product_search_code': product_search_code
              },
              success: function (data) {
                // console.log(data);
                  $('#product_show_info').html(data);
              }
          });
      });
      // End:: doner Search for
  </script>

  <script>
  function setMember(id,title,qty, price) {
      var check = $('#material_id'+id).val();
      if(check) {
          error("Products is exist.");
      }
      else {
          const cartDom = `
              <tr id="product_column_`+id+`">
                <td>`+title+`</td>
                <td><input type="hidden" name="material_id[]" id="product_id_`+id+`" value="`+id+`">
                <input type="number" class="form-control qtyValue" required name="quantity[]" oninput="qty(`+id+`)" value="`+qty+`" id="qty`+id+`" ></td>
                <td> <input type="number" class="form-control priceValue" required name="price[]" oninput="price(`+id+`)" value="`+price+`" id="price`+id+`" readonly></td>
                <td> <input type="number" class="form-control totalValue" name="total_price[]" value="0" id="total`+id+`" readonly></td>
                <td><button type="button" onclick="delete_product(`+id+`)" class="mt-2 btn btn-danger btn-sm">X</button></td>
              </tr>`;
          $('#selected_products').append(cartDom);
          $('#product_show_info').html('');
          $('#product_search').val('');
          //success("product Added.");
      }
  }
  function delete_product(id) {
      $('#product_column_'+id).remove();
      success("Product Deleted.");
      multiply();
  }
  function qty(id) {
         multiply();
    }
    function price(id) {
         multiply();
    }
    function multiply() {
        var qty = document.querySelectorAll(".price");

        var i, qty = qty.length;
        for (i = 0; i < qty; i++) {
            perprice = Number(document.getElementsByClassName('priceValue')[i].value);
            qty = Number(document.getElementsByClassName('qtyValue')[i].value);
            tk = (perprice * qty);
            document.getElementsByClassName('totalValue')[i].value=tk.toFixed(2);
            calculateSum();
        }
        function calculateSum() {
            var final_tk = 0;
            $(".totalValue").each(function() {
                if(!isNaN(this.value) && this.value.length!=0) {
                    final_tk += parseFloat(this.value);
                }
            });
            $('#all_total').val(final_tk);
        }
    }
  </script>
@endsection
