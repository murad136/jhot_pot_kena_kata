<div class="modal-body">
    <form action="{{route('campaignUpdate')}}" enctype="multipart/form-data" method="post">
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Campaign Title</label>
            <input type="text" class="form-control"  name="title" value="{{$campaign->title}}"  placeholder="campaign title" required="">
        </div>
        <input type="hidden" name="id" value="{{$campaign->id}}">
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="exampleInputEmail1">Start Date</label>
                <input type="date" name="start_date" value="{{$campaign->start_date}}" class="form-control" required="">
            </div>
            <div class="col-md-6 form-group">
                <label for="exampleInputEmail1">End Date</label>
                <input type="date" name="end_date" value="{{$campaign->end_date}}" class="form-control" required="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="exampleInputEmail1">Discount(%)</label>
                <input type="number" name="discount" value="{{$campaign->discount}}" class="form-control" required="">
            </div>
            <div class="col-md-6 form-group">
                <label for="exampleInputEmail1">Status</label>
                <select class="form-control" name="status" required="">
                    <option value="1" @if($campaign->status==1) selected="" @endif>Active</option>
                    <option value="0" @if($campaign->status==0)selected="" @endif>Deactive</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Campaign Logo</label>
            <input type="file" class="form-control dropify" data-height="120" name="campaign_img" />
            <br>
            <img src="{{asset($campaign->campaign_img)}}" style="height: 80px;width: 80px;" alt="pay nai">
            <input type="hidden" class="form-control dropify" data-height="120" name="old_campaign" value="{{$campaign->campaign_img}}" />

        </div>
        <button type="submit" class="btn btn-primary btn-block">Update</button>
    </form>
</div>

