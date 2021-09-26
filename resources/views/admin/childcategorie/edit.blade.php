<div class="modal-body">
    <form action="{{route('childcategorie_update')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Categorie/Subcategorie Name</label>
            <select class="form-control" name="subcategorie_id" required="">
                @foreach($categories as $categorie)
                    <option disabled style="color: #0c84ff">{{$categorie->categorie_name}}</option>
                    @php
                        $subcats = DB::table('subcategories')->where('categorie_id',$categorie->id)->get();
                    @endphp
                    @foreach($subcats as $subcat)
                        <option style="color: #7c151f" value="{{$subcat->id}}" @if($subcat->id==$childcategorie->subcategorie_id) selected="" @endif>{{$subcat->subcategorie_name}}</option>
                    @endforeach
                @endforeach
            </select>
            <input type="hidden" name="id" value="{{$childcategorie->id}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Childcategorie Name</label>
            <input type="text" class="form-control"  name="childcategorie_name"  value="{{$childcategorie->childcategorie_name}}" required="">
            <small id="emailHelp" class="form-text text-muted">Edit Your Childcategorie Name</small>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update</button>
    </form>
</div>
