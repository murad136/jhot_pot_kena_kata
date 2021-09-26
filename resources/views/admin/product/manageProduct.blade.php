@extends('admin.master')
@section('title')
    Product Mange Table
@endsection

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Table</h1>
                    </div>
                    <div class="col-sm-6" style="float: left; margin-left: 80%;">
                        <a href="{{route('productTable')}}" class="btn btn-primary">+Add Product</a>
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
                                <h3 class="card-title">All Products List Here</h3>
                            </div>

                                <div class="row">
                                    <div class="col-md-2 form-group" style="margin: 2px;">
                                        <label for="">Categories</label>
                                        <select class="form-control submitable" name="categorie_id" id="categorie_id">
                                                <option value="">All</option>
                                                @foreach($categories as $categorie)
                                                <option value="{{$categorie->id}}">{{$categorie->categorie_name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group" style="margin: 2px;">
                                        <label for="">Brands</label>
                                        <select class="form-control submitable" name="brand_id" id="brand_id">
                                                <option value="">All</option>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group" style="margin: 2px;">
                                        <label for="">Publication Status</label>
                                        <select class="form-control submitable" name="status" id="status">
                                            <option value="1">Active</option>
                                            <option value="0">Deactive</option>
                                        </select>
                                    </div>
                                </div>

                            <div class="card-body">
                                <table class="table table-bordered table-striped ytable">
                                    <thead>
                                    <tr>
                                        <th>SL NO</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Categorie Name</th>
                                        <th>Brand Name</th>
                                        <th>Image</th>
                                        <th>Fetured Status </th>
                                        <th>Today Deal</th>
                                        <th>Status</th>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(function childcategorie(){
          table=$('.ytable').DataTable({
              "processing":true,
              "serverSide":true,
              "searching":true,
              "ajax":{"url": "{{ route('manageProduct') }}",
                  "data":function(e) {
                      e.categorie_id =$("#categorie_id").val();
                      e.brand_id =$("#brand_id").val();
                      e.status =$("#status").val();
                  }
              },
                columns:[
                    {data:'DT_RowIndex',    name:'DT_RowIndex'},
                    {data:'name',                   name:'name'},
                    {data:'code',                     name:'code'},
                    {data:'categorie_name', name:'categorie_name'},
                    {data:'brand_name',       name:'brand_name'},
                    {data:'thumbnail',           name:'thumbnail'},
                    {data:'featured',               name:'featured'},
                    {data:'today_deal',          name:'today_deal'},
                    {data:'status',                   name:'status'},
                    {data:'action',                  name:'action',orderable:true, searchable:true},
                ]

            });
        });

        //filteering
        $(document).on('change','.submitable',function(){
            $('.ytable').DataTable().ajax.reload();
        });

        //publiation status option
        $('body').on('click','.deactive_feat', function(){
            var id=$(this).data('id');
            var url = "{{ url('product/deactive_feat') }}/"+id;
            $.ajax({
                url:url,
                type:'get',
                success:function(data){
                    toastr.success(data);
                    table.ajax.reload();
                }
            });
        });

        $('body').on('click','.active_feat', function(){
            var id=$(this).data('id');
            var url = "{{ url('product/active_feat') }}/"+id;
            $.ajax({
                url:url,
                type:'get',
                success:function(data){
                    toastr.success(data);
                    table.ajax.reload();
                }
            });
        });

        //today deal
        $('body').on('click','.deactive_deal', function(){
            var id=$(this).data('id');
            var url = "{{ url('product/deactive_deal') }}/"+id;
            $.ajax({
                url:url,
                type:'get',
                success:function(data){
                    toastr.success(data);
                    table.ajax.reload();
                }
            });
        });

        $('body').on('click','.active_deal', function(){
            var id=$(this).data('id');
            var url = "{{ url('product/active_deal') }}/"+id;
            $.ajax({
                url:url,
                type:'get',
                success:function(data){
                    toastr.success(data);
                    table.ajax.reload();
                }
            });
        });
        //status
        $('body').on('click','.deactive_status', function(){
            var id=$(this).data('id');
            var url = "{{ url('product/deactive_status') }}/"+id;
            $.ajax({
                url:url,
                type:'get',
                success:function(data){
                    toastr.success(data);
                    table.ajax.reload();
                }
            });
        });

        $('body').on('click','.active_status', function(){
            var id=$(this).data('id');
            var url = "{{ url('product/active_status') }}/"+id;
            $.ajax({
                url:url,
                type:'get',
                success:function(data){
                    toastr.success(data);
                    table.ajax.reload();
                }
            });
        });
    </script>
@endsection
