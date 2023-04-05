@extends('admin.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Attributes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">variation</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <span class="font-weight-bold">Color</span>
                            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#addModal">Add</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($colors as $color)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$color->name}}</td>
                                    <td>
                                        <div style="margin-left:6px; width: 38% ; height: 30px ; box-sizing: border-box; background: {{$color->code}}">
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $color->status == 1 ? 'success' : 'danger' }}">{{ $color->status == 1 ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td>
                                        <button type="button" value="{{$color->id}}" class="btn btn-sm editBtn btn-warning"><i class="fa fa-edit"></i></button>
                                        <button type="button" value="{{$color->id}}" class="btn btn-sm deleteBtn btn-danger"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <span class="font-weight-bold">Size</span>
                            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#addSizeModal">Add</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="example3">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sizes as $size)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$size->name}}</td>
                                        <td>
                                            <span class="badge badge-{{ $size->status == 1 ? 'success' : 'danger' }}">{{ $size->status == 1 ? 'Active' : 'Inactive' }}</span>
                                        </td>
                                        <td>
                                            <button type="button" value="{{$size->id}}" class="btn btn-sm editSizeBtn btn-warning"><i class="fa fa-edit"></i></button>
                                            <button type="button" value="{{$size->id}}" class="btn btn-sm deleteSizeBtn btn-danger"><i class="fa fa-trash"></i></button>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header">
                    <h4 class="modal-title">Color Add</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('color.store')}}" method="POST" enctype="multipart/form-data" id="colorForm">
                        @csrf
                        <label for="colorPicker">Color Name</label>
                        <input type="text" id="colorPicker" name="name" class="form-control">

                        <label for="codePicker">Color Code</label>
                        <input type="color" id="codePicker" name="code" class="form-control">

                        <label for="status">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="" selected disabled>--------Select Status-------</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="event.preventDefault(); document.getElementById('colorForm').submit();" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Color Edit Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header">
                    <h4 class="modal-title">Color Edit</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('color.update')}}" method="POST" enctype="multipart/form-data" id="colorEditForm">
                        @csrf
                        <input type="hidden" id="color_id" name="color_id" class="form-control">
                        <label for="colorPicker">Color Name</label>
                        <input type="text" id="name" name="name" class="form-control">

                        <label for="code">Color Code</label>
                        <input type="color" id="code" name="code" class="form-control">

                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="" selected disabled>--------Select Status-------</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
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
                    <h4 class="modal-title">Color Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('color.delete')}}" method="POST" enctype="multipart/form-data" id="colorDeleteForm">
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
                var color_id = $(this).val();
                // alert(color_id);
                $('#editModal').modal('show');

                $.ajax({
                    type: 'GET',
                    url: "/home/color/edit/" + color_id,
                    success: function (response) {
                        // console.log(response);

                        $('#name').val(response.color.name);
                        $('#code').val(response.color.code);
                        $('#status').val(response.color.status);
                        $('#color_id').val(color_id);
                    }
                });
            });

            $(document).on('click', '.deleteBtn', function () {
                var d_id = $(this).val();
                // alert(color_id);
                $('#deleteModal').modal('show');

                $.ajax({
                    type: 'GET',
                    url: "/home/color/edit/" + d_id,
                    success: function (response) {
                        // console.log(response);

                        $('#name').val(response.color.name);
                        $('#status').val(response.color.status);
                        $('#d_id').val(d_id);
                    }
                });
            });
        });
    </script>

    <!-- Size Add Modal -->
    <div class="modal fade" id="addSizeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header">
                    <h4 class="modal-title">Size Add</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('size.store')}}" method="POST" enctype="multipart/form-data" id="sizeForm">
                        @csrf
                        <label for="name">Size Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>

                        <label for="status">Status</label>
                        <select name="status" id="" class="form-control" required>
                            <option selected disabled>--------Select Status-------</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="event.preventDefault(); document.getElementById('sizeForm').submit();" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Size Edit Modal -->
    <div class="modal fade" id="editSizeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header">
                    <h4 class="modal-title">Size Edit</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('size.update')}}" method="POST" enctype="multipart/form-data" id="sizeEditForm">
                        @csrf
                        <input type="hidden" id="size_id" name="size_id" class="form-control">
                        <label for="colorPicker">Size Name</label>
                        <input type="text" id="s_name" name="name" class="form-control">

                        <label for="status">Status</label>
                        <select name="status" id="s_status" class="form-control" required>
                            <option value="" selected disabled>--------Select Status-------</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="event.preventDefault(); document.getElementById('sizeEditForm').submit();" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Size Delete Modal -->
    <div class="modal fade" id="deleteSizeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header">
                    <h4 class="modal-title">Size Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('size.delete')}}" method="POST" enctype="multipart/form-data" id="sizeDeleteForm">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="sd_id" name="sd_id" class="form-control">
                        <p class="text-danger text-center">Are you sure to delete this?</p>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="event.preventDefault(); document.getElementById('sizeDeleteForm').submit();" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.editSizeBtn', function () {
                var size_id = $(this).val();
                // alert(size_id);
                $('#editSizeModal').modal('show');

                $.ajax({
                    type: 'GET',
                    url: "/home/size/edit/" + size_id,
                    success: function (response) {
                        // console.log(response);

                        $('#s_name').val(response.size.name);
                        $('#s_status').val(response.size.status);
                        $('#size_id').val(size_id);
                    }
                });
            });

            $(document).on('click', '.deleteSizeBtn', function () {
                var sd_id = $(this).val();
                // alert(color_id);
                $('#deleteSizeModal').modal('show');

                $.ajax({
                    type: 'GET',
                    url: "/home/size/edit/" + sd_id,
                    success: function (response) {
                        // console.log(response);

                        $('#name').val(response.size.name);
                        $('#status').val(response.size.status);
                        $('#sd_id').val(sd_id);
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
