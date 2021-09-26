<div class="modal-body">
    <form action="{{route('pickupUpdate')}}" method="post">
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Pickup Point  Name</label>
            <input type="text" class="form-control"  name="pickup_point_name"  value="{{$pickup->pickup_point_name}}" required="">
            <input type="hidden" name="id" value="{{$pickup->id}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Pickup Point Address</label>
            <input type="text" class="form-control"  name="pickup_point_address"  value="{{$pickup->pickup_point_address}}" required="">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Pickup Point Phone</label>
            <input type="number" class="form-control"  name="pickup_point_phone"  value="{{$pickup->pickup_point_phone}}" required="">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update</button>
    </form>
</div>
