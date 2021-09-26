<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Childcategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function CategorieTable(){
        $categories = Categorie::all();
        return view('admin.categorie.categorieTable',[
            'categories' =>$categories
        ]);
    }

public function CategorieInsert(Request $request){
    $validated = $request->validate([
        'categorie_name' => 'required|unique:categories|max:55',
    ]);

    Categorie::insert([
        'categorie_name' =>$request->categorie_name,
        'categorie_slug'    => Str::slug($request->categorie_name,'-')
    ]);
    $notification = array('messege'=>'Categorie Insert Successfully','alert-type'=>'success');
    return redirect()->back()->with($notification);
}

public function CategorieEdit($id){
        $categorie = Categorie::find($id);
        return response()->json($categorie);
}



public function CategorieUpdate(Request $request){
        $categorie = Categorie::find($request->id);
        $categorie->update([
            'categorie_name' =>$request->categorie_name,
            'categorie_slug'    => Str::slug($request->categorie_name,'-')
        ]);
    $notification = array('messege'=>'Categorie Update Successfully','alert-type'=>'info');
    return redirect()->back()->with($notification);
}



public function CategorieDelete($id){
        $categorie = Categorie::find($id);
        $categorie->delete();
        $notification = array('messege'=>'Categorie Delete Successfully','alert-type'=>'warning');
        return redirect()->back()->with($notification);
}


public function GetChildCategorie($id){
        $data = DB::table('childcategories')->where('subcategorie_id',$id)->get();
        return response()->json($data);
}


}
