@extends('admin.master')
@section('title')
    SMPT Setting Form
    @endsection
@section('body')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6" style="margin-top: 20px">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"> SMTP Setting</h3>
                            </div>

                            <form role="form" action="{{route('smtp_update',$smtp->id)}}" method="post">
                                @csrf
                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Mail Mailer</label>
                                    <input type="text" class="form-control" name="mailer" value="{{$smtp->mailer}}" placeholder="Mail Mailer">
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Mail Host</label>
                                    <input type="text" class="form-control" name="host" value="{{$smtp->host}}" placeholder="Mail Host">
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Mail Port</label>
                                    <input type="text" class="form-control" name="port" value="{{$smtp->port}}" placeholder="Mail Port">
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Mail User Name</label>
                                    <input type="text" class="form-control" name="user_name" value="{{$smtp->user_name}}" placeholder="Mail User Name">
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Mail Password</label>
                                    <input type="text" class="form-control" name="password" value="{{$smtp->password}}" placeholder="Mail Password">
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
