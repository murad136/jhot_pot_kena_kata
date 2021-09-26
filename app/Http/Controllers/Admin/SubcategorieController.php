<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Subcategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class SubcategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }




    public function SubcategorieTable(){
        $categories =  Categorie::all();
        $joingDatas = DB::table('subcategories')
                            ->leftJoin('categories','subcategories.categorie_id','categories.id')
                            ->select('categories.categorie_name','subcategories.*')->get();
        return view('admin.subcategorie.subcategorieTable',[
                'joingDatas' =>$joingDatas,
                'categories'  =>$categories
        ]);
    }

    public function SubcategorieInsert(Request $request){
        $validated = $request->validate([
            'subcategorie_name' => 'required|max:55',
        ]);

//            Subcategorie::insert([
//            'categorie_id'                  =>$request->categorie_id,
//            'subcategorie_name	'    =>$request->subcategorie_name,
//            'subcategorie_slug'        =>Str::slug($request->subcategorie_name,'-')
//        ]);

        //queryBuilder//
            $data = array();
            $data['categorie_id']              = $request->categorie_id;
            $data['subcategorie_name']  =$request->subcategorie_name;
            $data['subcategorie_slug']     = Str::slug($request->subcategorie_name,'-');

            DB::table('subcategories')->insert($data);

            $notification = array('messege'=>'Subcategorie Insert Successfully','alert-type'=>'success');
            return redirect()->back()->with($notification);

    }


    public function SubcategorieEdit($id){
        $categories       = Categorie::all();
        $subcategorie  = Subcategorie::find($id);
        return view('admin.subcategorie.edit',[
            'categories'       =>$categories,
            'subcategorie'  =>$subcategorie
        ]);

    }

    public function SubcategorieUpdate(Request $request){
        $data = array();
        $data['categorie_id']              = $request->categorie_id;
        $data['subcategorie_name']  =$request->subcategorie_name;
        $data['subcategorie_slug']     = Str::slug($request->subcategorie_name,'-');

        Subcategorie::find($request->id)->update($data);
        $notification = array('messege'=>'Subcategorie Update Successfully','alert-type'=>'info');
        return redirect()->back()->with($notification);
    }


    public function SubcategorieDelete($id){
        $subcategorie = Subcategorie::find($id);
        $subcategorie->delete();
        $notification = array('messege'=>'Subcategorie Delete Successfully','alert-type'=>'warning');
        return redirect()->back()->with($notification);
    }

}
