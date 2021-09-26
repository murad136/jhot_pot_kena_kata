@extends('frontEnd.master')
@section('title')
    Show Cart Products
    @endsection
@section('body')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontEnd/styles/product_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontEnd/styles/product_responsive.css">
          <div class="container">
                <div class="row">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th>SL NO</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Delete</th>
                                </tr>
                                @php($i =1)
                                @php($sum = 0)
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$product->name}}</td>
                                        <td><img src="{{ asset('admin/products_img/'.$product->options->thumbnail) }}" alt="img not found.!" style="height: 60px;width: 80px;"></td>
                                        <td>{{$product->options->color}}</td>
                                        <td>{{$product->options->size}}</td>
                                        <td>{{$websetting->currency}} {{ $product->price}}</td>
                                        <td>
                                            <form action="#" method="post">
                                                @csrf
                                                <input type="number" name="qtyUpdate" value="{{$product->qty}}"/>
                                                <input type="hidden" name="rowId" value="{{ $product->rowId }}"/>
                                                <input type="submit" name="btn" value="Update"/>
                                            </form>
                                        </td>
                                        <td>{{$websetting->currency}} {{ $totalPrice = $product->price*$product->qty}}</td>
                                        <td><a href="{{route('cartProductDelete',['rowId'=>$product->rowId])}}" class="btn btn-danger" onclick="return confirm('Are Yor Sure To Delete..?');"> <i class="fas fa-trash"></i></a></td>
                                    </tr>
                                    @php($sum = $sum +$totalPrice)
                                @endforeach
                            </table>
                </div>
                <div class="row">
                    <div class="card card-info" style="margin-left:78%; background-color: #B2E4AE;">
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th class="text-danger">Total Price</th>
                                    <td class="text-info">{{$websetting->currency}} {{ $total = $sum }}</td>
                                </tr>
                                <tr>
                                    <th class="text-danger"> Vat(0.05%)</th>
                                    <td class="text-info">{{$websetting->currency}} {{ $vat = $sum*0.05 }}</td>
                                </tr>
                                    <tr>
                                      <th class="text-danger">Final Price</th>
                                        <td class="text-info">{{$websetting->currency}} {{$total+$vat}} </td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                        <a href="{{url('/')}}" class="btn btn-primary"><i class="fa fa-cart-plus"></i> Continue Shopping</a>
                        <a href="#" class="btn btn-danger" style="margin-left: 90%;"><i class="fas fa-shopping-bag"></i> Checkout</a>
                </div>
    @endsection
