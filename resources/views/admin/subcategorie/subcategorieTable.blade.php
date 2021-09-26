@extends('admin.master')
@section('title')
    Subcategorie Table
@endsection

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subcategories Table</h1>
                    </div>
                    <div class="col-sm-6" style="float: left; margin-left: 80%;">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSubcategorie">
                            +Add Subcategorie
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
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>SL NO</th>
                                        <th>Categorie Name</th>
                                        <th>Subcategorie Name</th>
                                        <th>Subcategorie Slug</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i =1)
                                    @foreach($joingDatas as $joingData)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$joingData->categorie_name}}</td>
                                            <td>{{$joingData->subcategorie_name}}</td>
                                            <td>{{$joingData->subcategorie_slug}}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-info edit" data-id="{{ $joingData->id }}" data-toggle="modal" data-target="#editSubcategorie"> <span class="fa fa-edit"></span></a>
                                                <a href="{{route('subcategorie_delete',[$joingData->id])}}" class="btn btn-sm btn-danger" id="delete"><span class="fa fa-trash"></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
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
    <div class="modal fade" id="addSubcategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subcategorie Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('subcategorie_insert')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Categorie Name</label>
                            <select class="form-control" name="categorie_id" required="">
                                @foreach($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->categorie_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Subcategorie Name</label>
                            <input type="text" class="form-control"  name="subcategorie_name"  placeholder="subcategorie name" required="">
                            <small id="emailHelp" class="form-text text-muted">Insert Your Subcategorie Name</small>
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
    <div class="modal fade" id="editSubcategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subcategorie Form</h5>
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
        $('body').on('click','.edit', function(){
            let subcat_id=$(this).data('id');
            $.get("subcategorie/edit/"+subcat_id, function(data){
                $("#modal_body").html(data);
            });
        });
    </script>
@endsection
