@extends('frontEnd.master')
@section('title')
    New Product Details
@endsection

@section('body')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontEnd/styles/product_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontEnd/styles/product_responsive.css">
    <div class="single_product">
        <div class="container">
            <div class="row">
                @php
                    $images = json_decode($products->images,true);
                    $sizes = explode(',',$products->size);
                    $colors = explode(',',$products->color);
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
                    <div class="image_selected"><img src="{{asset('admin/products_img/'.$products->thumbnail)}}" alt=""></div>
                </div>

                <div class="col-lg-5 order-3">
                    <div class="product_description">
                        <div class="product_name">{{$products->name}}</div>
                        <h4><span class="text-info">Brand Name: </span><span class="text-success">{{$products->brand->brand_name}}</span></h4>
                        <h4>Product Stock: @if($products->sku<1) <span class="badge badge-danger"> Stock Out</span>@else<span class="badge badge-success"> Stock Available</span>@endif</h4>
                        <h4>Product Unit: {{$products->unit}}</h4>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Product Details:</h4>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $products->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($products->discount_price==NULL)
                            <div class="banner_price"> <span>{{$websetting->currency}}{{$products->selling_price}}</span></div>
                        @else
                            <div class="banner_price"><del>{{$websetting->currency}}{{$products->selling_price}}</del>  {{$websetting->currency}}{{$products->discount_price}}</div>
                        @endif
                        <div class="row">

                            <form action="{{route('addToCart')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    @if($products->size)
                                        <label for="" style="margin-left: 8px;">Size: </label>
                                        <select class="form-control" name="size">
                                            @foreach($sizes as $size)
                                                <option value="{{ $size }}" class="text-danger">{{$size}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @if($products->color)
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
                                    <input type="hidden" name="name" value="{{$products->name}}">
                                    <input type="number" name="product_qty" class="form-control" value="1"/>
                                    <input type="hidden" name="id"  value="{{$products->id}}"/>
                                    <input type="hidden" name="thumbnail" value="{{ $products->thumbnail }}">

                                    {{--                                        product price system--}}
                                    @if($products->discount_price==NULL)
                                        <input type="hidden" name="price" value="{{$products->selling_price}}">
                                    @else
                                        <input type="hidden" name="price" value="{{$products->discount_price}}">
                                    @endif
                                </div>
                                @if($products->sku<1) <span class="badge badge-danger"> Stock Out</span>
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
