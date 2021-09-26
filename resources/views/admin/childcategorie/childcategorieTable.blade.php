@extends('admin.master')
@section('title')
    Childcategorie Table
@endsection

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Childcategories Table</h1>
                    </div>
                    <div class="col-sm-6" style="float: left; margin-left: 80%;">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addChildbcategorie">
                            +Add Childcategorie
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
                                        <th>Categorie Name</th>
                                        <th>Subcategorie Name</th>
                                        <th>Childcategorie Name</th>
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


    //subcategorie Insert modal//
    <div class="modal fade" id="addChildbcategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subcategorie Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('childcategorie_insert')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Categorie/Subcategorie Name</label>
                            <select class="form-control" name="subcategorie_id" required="">
                                @foreach($categories as $categorie)
                                    <option disabled style="color: #0c84ff">{{$categorie->categorie_name}}</option>
                                    @php
                                    $subcats = DB::table('subcategories')->where('categorie_id',$categorie->id)->get();
                                    @endphp
                                        @foreach($subcats as $subcat)
                                        <option style="color: #7c151f" value="{{$subcat->id}}">{{$subcat->subcategorie_name}}</option>
                                                @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Childcategorie Name</label>
                            <input type="text" class="form-control"  name="childcategorie_name"  placeholder="childcategorie name" required="">
                            <small id="emailHelp" class="form-text text-muted">Insert Your Childcategorie Name</small>
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

    {{--    edit categorie form--}}
    <div class="modal fade" id="editChildcategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subcategorie Edit Form</h5>
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
                ajax:"{{ route('childcategorie_table') }}",
                columns:[
                    {data:'DT_RowIndex',name:'DT_RowIndex'},
                    {data:'categorie_name',       name:'categorie_name'},
                    {data:'subcategorie_name',    name:'subcategorie_name'},
                    {data:'childcategorie_name',  name:'childcategorie_name'},
                    {data:'action',               name:'action',orderable:true, searchable:true},
                ]

            });
        });

        $('body').on('click','.edit', function(){
            let childcat_id=$(this).data('id');
            $.get("childcategorie/edit/"+childcat_id, function(data){
                $("#modal_body").html(data);
            });
        });

    </script>
@endsection
