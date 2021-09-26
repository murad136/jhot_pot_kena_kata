<div class="modal-body">
    <form action="{{route('coupnUpdate')}}" method="post">
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Coupn Code</label>
            <input type="text" class="form-control"  name="coupn_code"  value="{{$coupn->coupn_code}}" required="">
            <input type="hidden" name="id" value="{{$coupn->id}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Coupn Type</label>
            <select name="coupn_type" class="form-control" >
                <option value="1" {{ ($coupn->coupn_type == '1')? 'selected': "" }}>Fixed</option>
                <option value="2" {{ ($coupn->coupn_type == '2')? 'selected': "" }}>Percentage</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Coupn Amount</label>
            <input type="number" class="form-control"  name="coupn_amount" value="{{$coupn->coupn_amount}}" required="">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Valid Date</label>
            <input type="date" class="form-control"  name="valid_date"  value="{{$coupn->valid_date}}" required="">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Coupn Status</label>
            <select name="coupn_status" class="form-control">
                <option value="Active" {{ ($coupn->coupn_status == 'Active')? 'selected': "" }}>Active</option>
                <option value="Deactive" {{ ($coupn->coupn_status == 'Deactive')? 'selected': "" }}>Deactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update</button>
    </form>
</div>
