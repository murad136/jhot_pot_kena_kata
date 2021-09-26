@extends('admin.master')
@section('title')
    Edit Product Form
@endsection

@section('body')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <style type="text/css">
        .bootstrap-tagsinput .tag {
            background: #428bca;;
            border: 1px solid white;
            padding: 16px;
            padding-left: 2px;
            margin-right: 2px;
            color: white;
            border-radius: 4px;
        }
    </style>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <form action="{{route('product_update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8" style="margin-top: 15px;">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Your Product Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Product Name</label>
                                            <input type="text" class="form-control" name="name" value="{{$product->name}}"  required>
                                            <input type="hidden" name="id" value="{{$product->id}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Product Code</label>
                                            <input type="text" class="form-control" name="code" value="{{$product->code}}"  required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Categorie/Subcategorie</label>
                                            <select class="form-control" name="subcategorie_id" id="subcategorie_id" required>
                                                <option>--select categorie/subcategorie--</option>
                                                @foreach($categories as $categorie)
                                                    <option style="color:red" disabled >{{$categorie->categorie_name}}</option>
                                                    @php
                                                        $subcats = DB::table('subcategories')->where('categorie_id',$categorie->id)->get();
                                                    @endphp
                                                    @foreach ($subcats as $subcat)
                                                        <option value="{{$subcat->id}}"@if($subcat->id==$product->subcategorie_id) selected="" @endif>{{$subcat->subcategorie_name}}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Childcategorie</label>
                                            <select class="form-control" name="childcategorie_id" id="childcategorie_id">
                                                <option value="">{{$product->childcategorie_id}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Brand</label>
                                            <select name="brand_id" class="form-control" required>
                                                <option>--select brand--</option>
                                                @foreach($brands as $brand)
                                                    <option style="color: green" value="{{$brand->id}}"@if($brand->id==$product->brand_id) selected @endif>{{$brand->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Pickup Point</label>
                                            <select name="pickup_id" class="form-control" required>
                                                <option>--select pickup point--</option>
                                                @foreach($pickups as $pickup)
                                                    <option value="{{$pickup->id}}"@if($pickup->id==$product->pickup_id) selected @endif>{{$pickup->pickup_point_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Unit</label>
                                            <input type="text" class="form-control" name="unit" value="{{$product->unit}}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Tags</label>
                                            <input type="text" name="tags" class="form-control" value="{{$product->tags}}" data-role="tagsinput">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Purchase Price</label>
                                            <input type="number" class="form-control" name="purchase_price" value="{{$product->purchase_price}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Sealing Price</label>
                                            <input type="number" class="form-control" name="selling_price" value="{{$product->selling_price}}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Discount Price</label>
                                            <input type="number" class="form-control" name="discount_price" value="{{$product->discount_price}}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Warehouse</label>
                                            <select class="form-control" name="warehouse" required>
                                                <option>--select warehouse--</option>
                                                @foreach($warehouses as $warehouse)
                                                    <option value="{{$warehouse->id}}"@if($warehouse->id==$product->warehouse) selected=""@endif>{{$warehouse->warehouse_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Stock</label>
                                            <input type="number" class="form-control" name="sku" value="{{$product->sku}}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Color</label>
                                            <input type="text" class="form-control" name="color" value="{{$product->color}}" data-role="tagsinput">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Size</label>
                                            <input type="text" name="size"  class="form-control" value="{{$product->size}}" data-role="tagsinput">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="">Product Details</label>
                                            <textarea class="form-control textarea" name="description">{{$product->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="">Video Embd Code </label>
                                            <input type="text" class="form-control" name="video" value="{{$product->video}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4" style="margin-top: 15px;">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Thumbnail & Others Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="file" class="form-control dropify" name="thumbnail"  accept="image/*"/>
                                        <br>
                                        <img src="{{asset('admin/products_img/'.$product->thumbnail)}}" height="120px;" width="200px;" alt="pic pay nai">
                                        <input type="hidden" name="old_thumbnail" value="{{$product->thumbnail}}">
                                    </div>

                                    <div style="padding-top: 2px;padding-bottom: 5px;"  class="card form-group">
                                        <h6>Featured Status</h6>
                                        <div class="col-md-4">
                                            <input type="checkbox" name="featured" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div style="padding-top: 2px;padding-bottom: 5px;" class="card form-group">
                                        <h6>Today Deal</h6>
                                        <div class="col-md-4">
                                            <input type="checkbox" name="today_deal" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div style="padding-top: 2px;padding-bottom: 5px;" class="card form-group">
                                        <h6>Product Slider</h6>
                                        <div class="col-md-4">
                                            <input type="checkbox" name="product_slider" value="1"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div style="padding-top: 2px;padding-bottom: 5px;" class="card form-group">
                                        <h6>Status</h6>
                                        <div class="col-md-4">
                                            <input type="checkbox" name="status" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success col-l-4">Update</button>
                </form>
            </div>
        </section>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <script src="{{ asset('/') }}admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

    <script type="text/javascript">
        $('.dropify').dropify();
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $("#subcategorie_id").change(function(){
            var id = $(this).val();
            $.ajax({
                url: "{{ url("/get-child-categorie/") }}/"+id,
                type: 'get',
                success: function(data) {
                    $('select[name="childcategorie_id"]').empty();
                    $.each(data, function(key,data){
                        $('select[name="childcategorie_id"]').append('<option value="'+ data.id +'">'+ data.childcategorie_name+'</option>');
                    });
                }
            });
        });


    </script>
@endsection
