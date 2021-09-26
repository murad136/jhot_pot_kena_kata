<div class="modal-body">
    <form action="{{route('subcategorie_update')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Categorie Name</label>
            <select class="form-control" name="categorie_id" required="">
                @foreach($categories as $categorie)
                    <option value="{{$categorie->id}}" @if($categorie->id==$subcategorie->categorie_id) selected=""@endif >{{$categorie->categorie_name}}</option>
                @endforeach
            </select>
            <input type="hidden" name="id" value="{{$subcategorie->id}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Subcategorie Name</label>
            <input type="text" class="form-control"  name="subcategorie_name"  value="{{$subcategorie->subcategorie_name}}" required="">
            <small id="emailHelp" class="form-text text-muted">Insert Your Subcategorie Name</small>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update</button>
    </form>
</div>
