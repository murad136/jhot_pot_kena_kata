<div class="modal-body bg-gradient-light">
    <form action="{{route('brand_update')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Brand Name</label>
            <input type="text" class="form-control"  name="brand_name" value="{{$brand->brand_name}}"  required="">
        </div>
        <input type="hidden" name="id" value="{{$brand->id}}">
        <div class="form-group">
            <label for="exampleInputEmail1">Brand Logo</label>
            <img src="{{asset($brand->brand_logo)}}" height="120" style="margin: 10px"/>
            <input type="file" class="form-control dropify" data-height="120" name="brand_logo" >
            <input type="hidden"  name="old_logo" value="{{$brand->brand_logo}}">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update</button>
    </form>
</div>
