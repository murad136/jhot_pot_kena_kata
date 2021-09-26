@extends('admin.master')
@section('title')
    E-Campaign Table
@endsection

@section('body')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Campaign</h1>
                    </div>
                    <div class="col-sm-6" style="float: left; margin-left: 80%;">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCampaign">
                            +Add Campaign
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
                                <table id="" class="table table-bordered table-striped ytable">
                                    <thead>
                                    <tr>
                                        <th>SL NO</th>
                                        <th>Campign Title</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Discount(%)</th>
                                        <th>Status</th>
                                        <th>Image</th>
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


    //addCampaign Insert modal//
    <div class="modal fade" id="addCampaign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Campaign Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-yellow">
                    <form action="{{route('campaignAdd')}}" enctype="multipart/form-data" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">Campaign Title</label>
                            <input type="text" class="form-control"  name="title"  placeholder="campaign title" required="">
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="exampleInputEmail1">Start Date</label>
                                <input type="date" name="start_date" class="form-control" required="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="exampleInputEmail1">End Date</label>
                                <input type="date" name="end_date" class="form-control" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="exampleInputEmail1">Discount(%)</label>
                                <input type="number" name="discount" class="form-control" required="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select class="form-control" name="status" required="">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Campaign Logo</label>
                            <input type="file" class="form-control dropify" data-height="120" name="campaign_img"   required="">

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


    {{--    edit Campaign form--}}
    <div class="modal fade" id="editCampaing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Campaign Form</h5>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js">
    </script>
    <script type="text/javascript">
        $('.dropify').dropify();
    </script>

    <script type="text/javascript">
        $(function childcategorie(){
            var table=$('.ytable').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('campaignTable') }}",
                columns:[
                    {data:'DT_RowIndex',    name:'DT_RowIndex'},
                    {data:'title',                      name:'title'},
                    {data:'start_date',            name:'start_date'},
                    {data:'end_date',              name:'end_date'},
                    {data:'discount',               name:'discount'},
                    {data:'status',                    name:'status'},
                    {data:'campaign_img',     name:'campaign_img',render: function (data, type, full, meta){
                            return "<img src=\""+data+"\" height=\"60\" />";
                        }},
                    {data:'action',                  name:'action',orderable:true, searchable:true},
                ]

            });
        });

        $('body').on('click','.edit', function(){
            let id=$(this).data('id');
            $.get("campaign/edit/"+id, function(data){
                $("#modal_body").html(data);
            });
        });

    </script>
@endsection
