@extends('admin.master')
@section('title')
    Pickup Table
@endsection

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pickup Table</h1>
                    </div>
                    <div class="col-sm-6" style="float: left; margin-left: 80%;">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addpickup">
                            +Add Pickup
                        </button>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable with default features</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table  class="table table-bordered table-striped ytable">
                                    <thead>
                                    <tr>
                                        <th>SL NO</th>
                                        <th>Pickup Point Name</th>
                                        <th>Pickup Point Address</th>
                                        <th>Pickup Point Phone</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    //pickup Insert modal//
    <div class="modal fade" id="addpickup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pickup Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('pickupInsert')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">Pickup Point  Name</label>
                            <input type="text" class="form-control"  name="pickup_point_name"  placeholder="dhanmoni#27" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pickup Point Address</label>
                            <input type="text" class="form-control"  name="pickup_point_address"  placeholder="new-market,dhaka" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pickup Point Phone</label>
                            <input type="number" class="form-control"  name="pickup_point_phone"  placeholder="017xxxxxxxx" required="">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{--    edit pickup form--}}
    <div class="modal fade" id="editpickup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pickup Edit Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script type="text/javascript">

        $(function childcategorie(){
            var table=$('.ytable').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('pickupForm') }}",
                columns:[
                    {data:'DT_RowIndex',                  name:'DT_RowIndex'},
                    {data:'pickup_point_name',        name:'pickup_point_name'},
                    {data:'pickup_point_address',     name:'pickup_point_address'},
                    {data:'pickup_point_phone',       name:'pickup_point_phone'},
                    {data:'action',                                 name:'action',orderable:true, searchable:true},
                ]

            });
        });

        $('body').on('click','.edit', function(){
            let id=$(this).data('id');
            $.get("pickup/edit/"+id, function(data){
                $("#modal_body").html(data);
            });
        });

    </script>
@endsection
