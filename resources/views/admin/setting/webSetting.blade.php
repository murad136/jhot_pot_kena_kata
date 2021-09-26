@extends('admin.master')
@section('title')
    Web Setting Form
@endsection
@section('body')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6" style="margin-top: 20px">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"> Web Setting</h3>
                            </div>

                            <form role="form" action="{{route('webSettingUpdate',[$webSetting->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1"> Currency</label>
                                    <select name="currency" class="form-control">
                                        <option value="৳" {{ ($webSetting->currency== "৳") ? 'selected': ' ' }}>TAKA</option>
                                        <option value="$" {{ ($webSetting->currency== "$") ? 'selected': ' ' }}>USD</option>
                                        <option value="₹" {{ ($webSetting->currency== "₹") ? 'selected': ' ' }}>RUPEE</option>
                                    </select>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Phone Number</label>
                                    <input type="number" class="form-control" name="phone_one" value="{{$webSetting->phone_one}}" placeholder="017xxx" required>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Optional Phone Number</label>
                                    <input type="number" class="form-control" name="phone_two" value="{{$webSetting->phone_two}}" placeholder="018xxxx" required>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Main Email</label>
                                    <input type="email" class="form-control" name="main_email" value="{{$webSetting->main_email}}" placeholder="main@gmail.com" required>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Support Email</label>
                                    <input type="email" class="form-control" name="support_email" value="{{$webSetting->support_email}}" placeholder="support@gmail.com" required>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Address</label>
                                    <textarea class="form-control" name="address"  rows="4">{{$webSetting->address}}</textarea>
                                </div>

                                <small style="font-size: 20px;margin-left: 20px;font-family: Apple;color: #0c84ff;">---- Social Links ----</small>
                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Facebook</label>
                                    <input type="text" class="form-control" name="facebook" value="{{$webSetting->facebook}}" placeholder="facebook" required>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Youtube</label>
                                    <input type="text" class="form-control" name="youtube" value="{{$webSetting->youtube}}" placeholder="youtube" required>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Instagram</label>
                                    <input type="text" class="form-control" name="instagram" value="{{$webSetting->instagram}}" placeholder="instagram" required>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Linkdin</label>
                                    <input type="text" class="form-control" name="linkdin" value="{{$webSetting->linkdin}}" placeholder="linkdin" required>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Twitter</label>
                                    <input type="text" class="form-control" name="twitter" value="{{$webSetting->twitter}}" placeholder="twitter" required>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Logo</label>
                                    <img src="{{asset($webSetting->logo)}}" style="height: 100px;width: 200px;" alt="">
                                    <input type="file" class="form-control" name="logo">
                                    <input type="hidden" name="old_logo" value="{{$webSetting->logo}}">
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Favicon</label>
                                    <img src="{{asset($webSetting->favicon)}}" style="height: 100px;width: 200px;" alt="">
                                    <input type="file" class="form-control" name="favicon">
                                    <input type="hidden" name="old_favicon" value="{{$webSetting->favicon}}">
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
