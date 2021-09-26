@extends('frontEnd.master')
@section('title')
    Featured Product Details
@endsection

@section('body')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontEnd/styles/product_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontEnd/styles/product_responsive.css">
    <div class="single_product">
        <div class="container">
            <div class="row">
                @php
                    $images = json_decode($featuredProducts->images,true);
                    $sizes = explode(',',$featuredProducts->size);
                    $colors = explode(',',$featuredProducts->color);
                @endphp

                <div class="col-lg-2 order-lg-1 order-2">
                    <ul class="image_list">
                        @isset($images)
                            @foreach($images as $image)
                                <li data-image="{{asset('admin/products_img/'.$image)}}">
                                    <img src="{{asset('admin/products_img/'.$image)}}" alt="">
                                </li>
                            @endforeach
                        @endisset
                    </ul>
                </div>

                <div class="col-lg-5 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{asset('admin/products_img/'.$featuredProducts->thumbnail)}}" alt=""></div>
                </div>

                <div class="col-lg-5 order-3">
                    <div class="product_description">
                        <div class="product_name">{{$featuredProducts->name}}</div>
                        <h4><span class="text-info">Brand Name: </span><span class="text-success">{{$featuredProducts->brand->brand_name}}</span></h4>
                        <h4>Product Stock: @if($featuredProducts->sku<1) <span class="badge badge-danger"> Stock Out</span>@else<span class="badge badge-success"> Stock Available</span>@endif </h4>
                        <h4>Product Unit: {{$featuredProducts->unit}}</h4>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Product Details:</h4>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $featuredProducts->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($featuredProducts->discount_price==NULL)
                            <div class="banner_price">{{$websetting->currency}}{{$featuredProducts->selling_price}}</div>
                        @else
                            <div class="banner_price"><span>{{$websetting->currency}}{{$featuredProducts->selling_price}}</span> {{$websetting->currency}} {{$featuredProducts->discount_price}}</div>
                        @endif
                        <div class="row">

                            <form action="{{route('addToCart')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    @if($featuredProducts->size)
                                        <label for="" style="margin-left: 8px;">Size: </label>
                                        <select class="form-control" name="size">
                                            @foreach($sizes as $size)
                                                <option value="{{ $size }}" class="text-danger">{{$size}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @if($featuredProducts->color)
                                        <label for="" style="margin-left: 8px;">Color: </label>
                                        <select class="form-control" name="color">
                                            @foreach($colors as $color)
                                                <option value="{{ $color }}" class="text-danger">{{$color}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>

                                <div class="form-group" style="margin-left: 9px;">
                                    <label for="" >Product Quantity</label>
                                    <input type="hidden" name="name" value="{{$featuredProducts->name}}">
                                    <input type="number" name="product_qty" class="form-control" value="1"/>
                                    <input type="hidden" name="id"  value="{{$featuredProducts->id}}"/>
                                    <input type="hidden" name="thumbnail" value="{{ $featuredProducts->thumbnail }}">

                                    {{--                                        product price system--}}
                                    @if($featuredProducts->discount_price==NULL)
                                        <input type="hidden" name="price" value="{{$featuredProducts->selling_price}}">
                                    @else
                                        <input type="hidden" name="price" value="{{$featuredProducts->discount_price}}">
                                    @endif
                                </div>

                                @if($featuredProducts->sku<1) <span class="badge badge-danger"> Stock Out</span>
                                @else
                                    <button style="margin-left: 9px;" type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
                                @endif

                            </form>
                            <div class="col-md-6" style="margin-top: 10px;">
                                <button class="btn btn-danger"><i class="fas fa-heart"></i><a href="#" class="text-white"> Wishlist</a> </button>
                                {{--                                    <button class="btn btn-danger"><i class="fas fa-heart"></i><a href="{{route('addWishlist',$products->id)}}" class="text-white"> Wishlist</a> </button>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
