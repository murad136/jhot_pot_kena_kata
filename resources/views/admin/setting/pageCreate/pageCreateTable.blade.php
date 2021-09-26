@extends('admin.master')
@section('title')
Page Create Table
@endsection

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-family: Apple;">Page Management  Table</h1>
                    </div>

                    <div class="col-sm-6" style="float: left; margin-left: 80%;">
                        <button type="button" class="btn btn-primary" >
                            <a href="{{route('pageCreateForm')}}" style="color: white;"> +Create New Page</a>
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
                                <h3 class="card-title">All Page Create Table Here</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>SL NO</th>
                                        <th>Page Name</th>
                                        <th>Page Title</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i =1)
                                    @foreach($pageCreates as $pageCreate)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$pageCreate->page_name}}</td>
                                            <td>{{$pageCreate->page_title}}</td>
                                            <td>
                                                <a href="{{route('pageEdit',[$pageCreate->id])}}" class="btn btn-sm btn-info edit" > <span class="fa fa-edit"></span></a>
                                                <a href="{{route('pageDelete',[$pageCreate->id])}}" class="btn btn-sm btn-danger" id="delete"><span class="fa fa-trash"></span></a>
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


@endsection
