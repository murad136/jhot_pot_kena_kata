@extends('admin.master')
@section('title')
    Warehouse Page
    @endsection
@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Warehouse Table</h1>
                    </div>
                    <div class="col-sm-6" style="float: left; margin-left: 80%;">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addWare">
                            +Add Warehouse
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
                                <h3 class="card-title">Warehouse Table List Here</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped ytable">
                                    <thead>
                                    <tr>
                                        <th>SL NO</th>
                                        <th>Warehouse Name</th>
                                        <th>Warehouse Address</th>
                                        <th>Warehouse Phone</th>
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


    //warehouse Insert modal//
    <div class="modal fade" id="addWare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warehouse Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('warehouseInsert')}}" method="post" id="add-form">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Warehouse Name</label>
                            <input type="text" class="form-control"  name="warehouse_name"  placeholder="Warehouse name" required="">
                            <small id="emailHelp" class="form-text text-muted">Insert Your Warehiuse Name</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Warehouse Address</label>
                            <input type="text" class="form-control"  name="warehouse_address"  placeholder="Warehouse Address" required="">
                            <small id="emailHelp" class="form-text text-muted">Insert Your Warehiuse Name</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Warehouse Phone</label>
                            <input type="number" class="form-control"  name="warehouse_phone"  placeholder="Warehouse Phone" required="">
                            <small id="emailHelp" class="form-text text-muted">Insert Your Warehiuse Phone</small>
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

    {{--    edit warehouse form--}}
    <div class="modal fade" id="editWare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warehouse Form</h5>
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
                ajax:"{{ route('warehouseForm') }}",
                columns:[
                    {data:'DT_RowIndex',              name: 'DT_RowIndex'},
                    {data:'warehouse_name',        name: 'warehouse_name'},
                    {data:'warehouse_address',     name: 'warehouse_address'},
                    {data:'warehouse_phone',       name: 'warehouse_phone'},
                    {data:'action',                            name: 'action',orderable:true, searchable:true},
                ]

            });
        });

        $('body').on('click','.edit', function(){
            let id=$(this).data('id');
            $.get("warehouse/edit/"+id, function(data){
                $("#modal_body").html(data);
            });
        });

    </script>
    @endsection
