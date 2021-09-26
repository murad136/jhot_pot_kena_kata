<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


        public function brandTable(Request $request){
            if ($request->ajax()){
            $brands = Brand::all();
            return DataTables::of($brands)
                ->addIndexColumn()
                ->addColumn('action',function ($brand){
                    $actionBtn ='<a href="#" class="btn btn-sm btn-info edit" data-id="'.($brand->id).'" data-toggle="modal" data-target="#editBrand"> <span class="fa fa-edit"></span></a>
                                           <a href="'.route('brand_delete',[$brand->id]).'" class="btn btn-sm btn-danger" id="delete"><span class="fa fa-trash"></span></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make('true');
        }

        return view('admin.brand.brandTable');
        }



        public function brandInsert(Request $request){

            $validated = $request->validate([
                'brand_name' => 'required|unique:brands|max:55',
            ]);

            $slug = Str::slug($request->brand_name,'-');
            $data = array();
            $data['brand_name'] = $request->brand_name;
            $data['brand_slug']    = Str::slug($request->brand_name,'-');
            $photo           = $request->brand_logo;
            $photoName = $slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(220,120)->save('photos/brand/'.$photoName);
            $data['brand_logo']   = 'photos/brand/'.$photoName;

            Brand::insert($data);
            $notification = array('messege'=>'Brand Successfully Inserted','alert-type'=>'success');
            return redirect()->back()->with($notification);
        }


        public function brandEdit($id){
            $brand = Brand::find($id);
            return view('admin.brand.edit',[
                'brand' =>$brand
            ]);
        }


        public function brandUpdate(Request $request){
            $brand = Brand::find($request->id);
            $slug = Str::slug($request->brand_name,'-');
            $data = array();
            $data['brand_name'] = $request->brand_name;
            $data['brand_slug']    = Str::slug($request->brand_name,'-');
                if ($request->brand_logo){
                        if (File::exists($request->old_logo)){
                                unlink($request->old_logo);
                        }
                    $photo           = $request->brand_logo;
                    $photoName = $slug.'.'.$photo->getClientOriginalExtension();
                    Image::make($photo)->resize(220,120)->save('photos/brand/'.$photoName);
                    $data['brand_logo']   = 'photos/brand/'.$photoName;
                    $brand->save();
            //    DB::table('brands')->where('id',$request->id)->update($data);
                    $notification = array('messege'=>'Brand Successfully Update','alert-type'=>'info');
                    return redirect()->back()->with($notification);
                }else{
                    $data['brand_logo']   = $request->old_logo;
                    $brand->save();
            //     DB::table('brands')->where('id',$request->id)->update($data);
                    $notification = array('messege'=>'Brand Successfully Update','alert-type'=>'info');
                    return redirect()->back()->with($notification);
                }
        }

        public function brandDelete($id){
            $brand = Brand::find($id);
            $image = $brand->brand_logo;
            if (File::exists($image)){
                unlink($image);
            }
            $brand->delete();
            $notification = array('messege'=>'Brand Successfully Delete','alert-type'=>'warning');
            return redirect()->back()->with($notification);
        }

}
