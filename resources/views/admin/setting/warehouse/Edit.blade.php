<div class="modal-body">
    <form action="{{route('wareHouseUpdate')}}" method="post" id="add-form">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Warehouse Name</label>
            <input type="text" class="form-control"  name="warehouse_name"  value="{{$warehouse->warehouse_name}}" required="">
            <small id="emailHelp" class="form-text text-muted">Insert Your Warehiuse Name</small>
            <input type="hidden" name="id" value="{{$warehouse->id}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Warehouse Address</label>
            <input type="text" class="form-control"  name="warehouse_address"  value="{{$warehouse->warehouse_address}}" required="">
            <small id="emailHelp" class="form-text text-muted">Insert Your Warehiuse Name</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Warehouse Phone</label>
            <input type="number" class="form-control"  name="warehouse_phone"  value="{{$warehouse->warehouse_phone}}" required="">
            <small id="emailHelp" class="form-text text-muted">Insert Your Warehiuse Phone</small>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update</button>
    </form>
</div>
