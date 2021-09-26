@extends('admin.master')
@section('title')
    Coupn Table
@endsection

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Coupn Table</h1>
                    </div>
                    <div class="col-sm-6" style="float: left; margin-left: 80%;">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCoupn">
                            +Add Coupn
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
                                <table class="table table-bordered table-striped ytable">
                                    <thead>
                                    <tr>
                                        <th>SL NO</th>
                                        <th>Coupn Code</th>
                                        <th>Valid Date</th>
                                        <th>Coupn Amount</th>
                                        <th>Coupn Status</th>
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


    //Coupn Insert modal//
    <div class="modal fade" id="addCoupn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Coupn Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('coupnInsert')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">Coupn Code</label>
                            <input type="text" class="form-control"  name="coupn_code"  placeholder="jaj#45" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Coupn Type</label>
                            <select name="coupn_type" class="form-control" >
                                <option value="1">Fixed</option>
                                <option value="2">Percentage</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Coupn Amount</label>
                            <input type="number" class="form-control"  name="coupn_amount"  placeholder="1550.50" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Valid Date</label>
                            <input type="date" class="form-control"  name="valid_date"  placeholder="" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Coupn Status</label>
                            <select name="coupn_status" class="form-control">
                                <option value="Active">Active</option>
                                <option value="Deactive">Deactive</option>
                            </select>
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

    {{--    edit coupn form--}}
    <div class="modal fade" id="editCoupn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Coupn Edit Form</h5>
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
                ajax:"{{ route('coupnForm') }}",
                columns:[
                    {data:'DT_RowIndex',    name:'DT_RowIndex'},
                    {data:'coupn_code',        name:'coupn_code'},
                    {data:'valid_date',          name:'valid_date'},
                    {data:'coupn_amount',  name:'coupn_amount'},
                    {data:'coupn_status',      name:'coupn_status'},
                    {data:'action',                  name:'action',orderable:true, searchable:true},
                ]

            });
        });

        $('body').on('click','.edit', function(){
            let id=$(this).data('id');
            $.get("coupn/edit/"+id, function(data){
                $("#modal_body").html(data);
            });
        });

    </script>
@endsection
