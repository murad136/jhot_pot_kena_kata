@extends('admin.master')
@section('title')
   Brand Table
@endsection

@section('body')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Brand Table</h1>
                    </div>
                    <div class="col-sm-6" style="float: left; margin-left: 80%;">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBrand">
                            +Add Brand
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
                                        <th>Brand Name</th>
                                        <th>Brand Logo</th>
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


    //Brand Insert modal//
    <div class="modal fade" id="addBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Brand Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gradient-yellow">
                    <form action="{{route('brand_insert')}}" enctype="multipart/form-data" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">Brand Name</label>
                            <input type="text" class="form-control"  name="brand_name"  placeholder="brand name" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Brand Logo</label>
                            <input type="file" class="form-control dropify" data-height="120" name="brand_logo"   required="">

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

    {{--    edit Brand form--}}
    <div class="modal fade" id="editBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Brand Edit Form</h5>
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
                ajax:"{{ route('brand_table') }}",
                columns:[
                    {data:'DT_RowIndex',    name:'DT_RowIndex'},
                    {data:'brand_name',       name:'brand_name'},
                    {data:'brand_logo',         name:'brand_logo',render: function (data, type, full, meta){
                        return "<img src=\""+data+"\" height=\"60\">";
                        }},
                    {data:'action',                  name:'action',orderable:true, searchable:true},
                ]

            });
        });

        $('body').on('click','.edit', function(){
            let id=$(this).data('id');
            $.get("brand/edit/"+id, function(data){
                $("#modal_body").html(data);
            });
        });

    </script>
@endsection
