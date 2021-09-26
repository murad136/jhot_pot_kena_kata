@extends('admin.master')
@section('title')
    Seo Setting Form
    @endsection

@section('body')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6" style="margin-top: 20px">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> Seo Setting</h3>
                            </div>

                            <form role="form" action="{{route('seo_update',[$seo->id])}}" method="post">
                                @csrf
                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" value="{{$seo->meta_title}}" placeholder="Meta Title">
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Meta Author</label>
                                    <input type="text" class="form-control" name="meta_author" value="{{$seo->meta_author}}" placeholder="Meta Author">
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Meta Tag</label>
                                    <input type="text" class="form-control" name="meta_tag" value="{{$seo->meta_tag}}" placeholder="Meta Tag">
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" style="resize: vertical" rows="4">{{$seo->meta_description}}</textarea>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Meta Keyword</label>
                                    <input type="text" class="form-control" name="meta_keyword" value="{{$seo->meta_keyword}}" placeholder="Meta Keyword">
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Google Verification</label>
                                    <input type="text" class="form-control" name="google_verification" value="{{$seo->google_verification}}" placeholder="Verification Code">
                                    <small style="color: red">Input Your Verification Code Here</small>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Google Analytics</label>
                                    <input type="text" class="form-control" name="google_analytics" value="{{$seo->google_analytics}}" placeholder="Google Analytics">
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Google Adsense</label>
                                    <input type="text" class="form-control" name="google_adsense" value="{{$seo->google_adsense}}" placeholder="Google Adsense">
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <label  for="exampleInputEmail1">Alexa Verification</label>
                                    <input type="text" class="form-control" name="alexa_verification" value="{{$seo->alexa_verification}}" placeholder="Verification Code">
                                    <small style="color: red">Input Yor Verification Code Here</small>
                                </div>

                                <div class="form-group" style="padding-left: 10px; padding-right: 10px">
                                    <button type="submit" class="btn btn-primary btn-block form-control">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endsection
