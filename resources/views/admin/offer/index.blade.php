@extends('admin.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Offers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Offers</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="font-weight-bold">Offers</span>
                            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#addModal">Add</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Offer Name</th>
                                    <th>Offer Description</th>
                                    <th>Offer Start Date</th>
                                    <th>Offer End Date</th>
                                    <th>Offer Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($offers as $offer)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$offer->offer_name}}</td>
                                        <td>{{$offer->offer_description}}</td>
                                        <td>{{$offer->offer_start}}</td>
                                        <td>{{$offer->offer_end}}</td>
                                        <td>
                                            <span class="badge badge-{{ $offer->status == 1 ? 'success' : 'danger' }}">{{ $offer->status == 1 ? 'Active' : 'Inactive' }}</span>
                                        </td>
                                        <td>
                                            <button type="button" value="{{$offer->id}}" class="btn btn-sm editBtn btn-warning"><i class="fa fa-edit"></i></button>
                                            <button type="button" value="{{$offer->id}}" class="btn btn-sm deleteBtn btn-danger"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Color Add Modal -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header">
                    <h4 class="modal-title">Offer Add</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('offer.store')}}" method="POST" enctype="multipart/form-data" id="offerForm">
                        @csrf
                        <div class="mb-4 form-group">
                            <label for="offerName">Offer Name</label>
                            <input type="text" id="offerName" name="offer_name" class="form-control">
                        </div>
                        <div class="mb-4 form-group">
                            <label for="offerDescription">Offer Description</label>
                            <input type="text" id="offerDescription" name="offer_description" class="form-control">
                        </div>
                        <div class="mb-4 form-group">
                            <label for="offerStart">Offer Start</label>
                            <input type="date" id="offerStart" name="offer_start" class="form-control">
                        </div>
                        <div class="mb-4 form-group">
                            <label for="offerEnd">Offer End</label>
                            <input type="date" id="offerEnd" name="offer_end" class="form-control">
                        </div>
                        <div class="mb-4 form-group">
                            <label for="status">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="" selected disabled>--------Select Status-------</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="event.preventDefault(); document.getElementById('offerForm').submit();" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Color Edit Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header">
                    <h4 class="modal-title">Offer Edit</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('offer.update')}}" method="POST" enctype="multipart/form-data" id="colorEditForm">
                        @csrf
                        <input type="hidden" id="offer_id" name="offer_id" class="form-control">
                        <div class="mb-4 form-group">
                            <label for="offer_name">Offer Name</label>
                            <input type="text" id="offer_name" name="offer_name" class="form-control">
                        </div>
                        <div class="mb-4 form-group">
                            <label for="offer_description">Offer Description</label>
                            <input type="text" id="offer_description" name="offer_description" class="form-control">
                        </div>
                        <div class="mb-4 form-group">
                            <label for="offer_start">Offer Start</label>
                            <input type="date" id="offer_start" name="offer_start" class="form-control">
                        </div>
                        <div class="mb-4 form-group">
                            <label for="offer_end">Offer End</label>
                            <input type="date" id="offer_end" name="offer_end" class="form-control">
                        </div>
                        <div class="mb-4 form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="" selected disabled>--------Select Status-------</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="event.preventDefault(); document.getElementById('colorEditForm').submit();" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Color Delete Modal -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header">
                    <h4 class="modal-title">Offer Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('offer.destroy')}}" method="POST" enctype="multipart/form-data" id="colorDeleteForm">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="d_id" name="d_id" class="form-control">
                        <p class="text-danger text-center">Are you sure to delete this?</p>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="event.preventDefault(); document.getElementById('colorDeleteForm').submit();" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.editBtn', function () {
                var offer_id = $(this).val();
                // alert(offer_id);
                $('#editModal').modal('show');

                $.ajax({
                    type: 'GET',
                    url: "/home/offer/edit/" + offer_id,
                    success: function (response) {
                        // console.log(response);

                        $('#offer_name').val(response.offer.offer_name);
                        $('#offer_description').val(response.offer.offer_description);
                        $('#offer_start').val(response.offer.offer_start);
                        $('#offer_end').val(response.offer.offer_end);
                        $('#status').val(response.offer.status);
                        $('#offer_id').val(offer_id);
                    }
                });
            });

            $(document).on('click', '.deleteBtn', function () {
                var d_id = $(this).val();
                // alert(color_id);
                $('#deleteModal').modal('show');

                $.ajax({
                    type: 'GET',
                    url: "/home/offer/edit/" + d_id,
                    success: function (response) {
                        // console.log(response);

                        $('#offer_name').val(response.offer.offer_name);
                        $('#d_id').val(d_id);
                    }
                });
            });
        });
    </script>



@endsection

@section('scripts')
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example3').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
