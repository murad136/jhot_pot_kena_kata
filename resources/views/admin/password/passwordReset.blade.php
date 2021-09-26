@extends('admin.master')
@section('title')
    Password Reset Page
    @endsection

@section('body')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6" style="margin-top: 20px">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> Password Reset Form Here</h3>
                            </div>
                            <form action="{{route('password_update')}}" method="post">
                                @csrf
                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Old Password</label>
                                    <input type="password" class="form-control" name="old_password" placeholder="old password">
                                </div>
                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label for="exampleInputEmail1">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="new password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation"  placeholder="confirm password">
                                </div>
                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <button type="submit" class="btn btn-primary btn-block form-control">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    @endsection
