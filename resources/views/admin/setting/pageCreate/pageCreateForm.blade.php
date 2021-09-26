@extends('admin.master')
@section('title')
    New Page Create Form
@endsection

@section('body')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12" style="margin-top: 20px">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> Create New Page</h3>
                            </div>

                            <form role="form" action="{{route('newPageCreate')}}" method="post">
                                @csrf
                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Page Possition</label>
                                    <select class="form-control" name="page_position">
                                        <option value="1">Page One</option>
                                        <option value="2">Page Two</option>
                                    </select>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Page Name</label>
                                    <input type="text" class="form-control" name="page_name"  placeholder="Page Name" required>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Page Title</label>
                                    <input type="text" class="form-control" name="page_title"  placeholder="Page Title" required>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Page Description</label>
                                    <textarea class="form-control textarea" name="page_description"></textarea>
                                </div>


                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <button type="submit" class="btn btn-success btn-block form-control">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
