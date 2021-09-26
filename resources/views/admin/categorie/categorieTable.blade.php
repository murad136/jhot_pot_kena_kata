@extends('admin.master')
@section('title')
    Categorie Table
    @endsection

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categories Table</h1>
                    </div>
                    <div class="col-sm-6" style="float: left; margin-left: 80%;">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategorie">
                            +Add Categorie
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
                                        <th>Categorie Slug</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i =1)
                                    @foreach($categories as $categorie)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$categorie->categorie_name}}</td>
                                        <td>{{$categorie->categorie_slug}}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info edit" data-id="{{ $categorie->id }}" data-toggle="modal" data-target="#editcategorie"> <span class="fa fa-edit"></span></a>
                                            <a href="{{route('categorie_delete',[$categorie->id])}}" class="btn btn-sm btn-danger" id="delete"><span class="fa fa-trash"></span></a>
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



    <div class="modal fade" id="addCategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Categorie Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('categorieInsert')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Categorie Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="categorie_name" aria-describedby="emailHelp" placeholder="categorie name" required>
                            <small id="emailHelp" class="form-text text-muted">Insert Your Categorie Name</small>
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
    <div class="modal fade" id="editcategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Categorie Edit Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('categorie_update')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Categorie Name</label>
                            <input type="text" class="form-control" id="editcategorie_name" name="categorie_name" aria-describedby="emailHelp" placeholder="categorie name">
                            <input type="hidden" id="editcategorie_id" name="id">
                            <small id="emailHelp" class="form-text text-muted">Edit Your Categorie Name</small>
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

    <script type="text/javascript">
        $('body').on('click','.edit', function(){
            let cat_id=$(this).data('id');
            $.get("categorie/edit/"+cat_id, function(data){
                $('#editcategorie_name').val(data.categorie_name);
                $('#editcategorie_id').val(data.id);
            });
        });
    </script>
    @endsection
