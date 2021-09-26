<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Childcategorie;
use App\Models\Subcategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ChildcategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


        public function childcategorieTable(Request $request){
        if ($request->ajax()){
            $cat_sub_datas = DB::table('childcategories')
                ->leftJoin('categories','childcategories.categorie_id','categories.id')
                ->leftJoin('subcategories','childcategories.subcategorie_id','subcategories.id')
                ->select('categories.categorie_name','subcategories.subcategorie_name','childcategories.*')->get();
            return DataTables::of($cat_sub_datas)
                ->addIndexColumn()
                ->addColumn('action',function ($cat_sub_data){
                    $actionBtn = '<a href="#" class="btn btn-sm btn-info edit" data-id="'.($cat_sub_data->id).'" data-toggle="modal" data-target="#editChildcategorie"> <span class="fa fa-edit"></span></a>
                            <a href="'.route('childcategorie_delete',[$cat_sub_data->id]).'" class="btn btn-sm btn-danger" id="delete"><span class="fa fa-trash"></span></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $categories = Categorie::all();
        return view('admin.childcategorie.childcategorieTable',[
            'categories' =>$categories
        ]);
        }



        public function childcategorieInsert(Request $request){
        $subcats = Subcategorie::find($request->subcategorie_id);
        $data = array();
        $data['categorie_id']                =$subcats->categorie_id;
        $data['subcategorie_id']          =$request->subcategorie_id;
        $data['childcategorie_name'] =$request->childcategorie_name;
        $data['childcategorie_slug']    =Str::slug($request->childcategorie_name,'-');

        Childcategorie::insert($data);
        $notification = array('messege' =>'Childcategorie Insert Successfully','alert-type' =>'success');
        return redirect()->back()->with($notification);

        }


        public function childcategorieEdit($id){
            $childcategorie = Childcategorie::find($id);
            $categories        = Categorie::all();
            return view('admin.childcategorie.edit',[
                    'childcategorie'  =>$childcategorie,
                    'categories'         =>$categories
            ]);
        }


        public function childcategorieUpdate(Request $request){
            $subcats = Subcategorie::find($request->subcategorie_id);
            $data = array();
            $data['categorie_id']                =$subcats->categorie_id;
            $data['subcategorie_id']          =$request->subcategorie_id;
            $data['childcategorie_name'] =$request->childcategorie_name;
            $data['childcategorie_slug']    =Str::slug($request->childcategorie_name,'-');

            Childcategorie::find($request->id)->update($data);
            $notification = array('messege' =>'Childcategorie Update Successfully','alert-type' =>'info');
            return redirect()->back()->with($notification);
        }



        public function childcategorieDelete($id){
            $childcategorie = Childcategorie::find($id);
            $childcategorie->delete();
            $notification = array('messege' =>'Childcategorie Delete Successfully','alert-type' =>'warning');
            return redirect()->back()->with($notification);
        }
}
