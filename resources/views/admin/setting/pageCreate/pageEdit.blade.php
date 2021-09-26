@extends('admin.master')
@section('title')
    Page Edit Form
@endsection

@section('body')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12" style="margin-top: 20px">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> Edit  Page</h3>
                            </div>

                            <form role="form" action="{{route('pageUpdate',[$pageCreate->id])}}" method="post">
                                @csrf
                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Page Possition</label>
                                    <select class="form-control" name="page_position">
                                        <option value="1" @if($pageCreate->page_position==1) selected @endif>Page One</option>
                                        <option value="2" @if($pageCreate->page_position==2) selected @endif>Page Two</option>
                                    </select>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Page Name</label>
                                    <input type="text" class="form-control" name="page_name" value="{{$pageCreate->page_name}}" placeholder="Page Name">
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Page Title</label>
                                    <input type="text" class="form-control" name="page_title" value="{{$pageCreate->page_title}}"  placeholder="Page Title">
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Page Description</label>
                                    <textarea class="form-control textarea" name="page_description">{{$pageCreate->page_description}}</textarea>
                                </div>


                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <button type="submit" class="btn btn-success btn-block form-control">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
