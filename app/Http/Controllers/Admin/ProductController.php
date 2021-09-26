<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Childcategorie;
use App\Models\Pickup;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

        //product table show
    public  function productTable(){
        $categories         = Categorie::all();
        $brands               = Brand::all();
        $pickups             = Pickup::all();
        $warehouses      = Warehouse::all();

        return view('admin.product.productTable',[
                 'categories'    =>$categories,
                'brands'          =>$brands,
                'pickups'        =>$pickups,
                'warehouses' =>$warehouses
                    ]);
    }


    //product insert
    public function productInsert(Request $request){
        $validated = $request->validate([
            'code' => 'required|unique:products|max:55',
        ]);
        $data = array();
        $subcat = DB::table('subcategories')->where('id',$request->subcategorie_id)->first();
        $slug = Str::slug($request->name, '-');

        $data['name']                      = $request->name;
        $data['code']                       = $request->code;
        $data['product_slug']         = Str::slug($request->name, '-');
        $data['categorie_id']          = $subcat->categorie_id;
        $data['subcategorie_id']    = $request->subcategorie_id;
        $data['childcategorie_id'] = $request->childcategorie_id;
        $data['brand_id']               = $request->brand_id;
        $data['pickup_id']            = $request->pickup_id;
        $data['unit']                      = $request->unit;
        $data['tags']                      = $request->tags;
        $data['purchase_price'] = $request->purchase_price;
        $data['selling_price']     = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['warehouse']         = $request->warehouse;
        $data['sku']                      = $request->sku;
        $data['color']                   = $request->color;
        $data['size']                     = $request->size;
        $data['description']        = $request->description;
        $data['featured']             = $request->featured;
        $data['today_deal']        = $request->today_deal;
        $data['product_slider']  = $request->product_slider;
        $data['status']                 = $request->status;
        $data['admin_id']           = Auth::id();
        $data['date']                    = date('d-m-Y');
        $data['month']                = date('F');

        if ($request->thumbnail) {
                $photo = $request->thumbnail;
                $photoName = $slug . '.' . $photo->getClientOriginalExtension();
                Image::make($photo)->resize(600, 600)->save('admin/products_img/' . $photoName);
                $data['thumbnail'] = $photoName;
            }
        $images = array();
        if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(600, 600)->save('admin/products_img/' . $imageName);
                array_push($images, $imageName);
            }
            $data['images'] = json_encode($images);

            }

         Product::insert($data);
         $notification = array('messege'=>'Product Successfully Inserted','alert-type'=>'success');
         return redirect()->back()->with($notification);

    }



    //manage product table for edit & Delete
    public function mangeProduct(Request $request){
        if ($request->ajax()){
            $imgUrl = asset('admin/products_img' );

            $products=" ";
            $query = DB::table('products')
                    ->leftJoin('categories','products.categorie_id','categories.id')
                    ->leftJoin('brands','products.brand_id','brands.id');
                    if($request->categorie_id){
                        $query->where('products.categorie_id',$request->categorie_id);
                    }
                    if ($request->brand_id){
                        $query->where('products.brand_id',$request->brand_id);
                    }
                    if ($request->status==1){
                        $query->where('products.status',1);
                    }else{
                        $query->where('products.status',0);
                    }
                $products=$query->select('products.*','categories.categorie_name','brands.brand_name')->get();
                return DataTables::of($products)
                    ->addIndexColumn()
                    ->editColumn('thumbnail',function ($product) use($imgUrl){ return '<img src=" '.$imgUrl.'/'.$product->thumbnail.' "  height="60">'; })
                    ->editColumn('featured',function ($product){
                        if ($product->featured==1){
                                        return '<a href="#" data-id="'.$product->id.'" class="deactive_feat"><i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-success">active</span></a>';
                                }else{
                                        return '<a href="#" data-id="'.$product->id.'" class="active_feat"><i class="fas fa-thumbs-down text-danger"></i><span class="badge badge-danger">deactive</span></a>';
                                        }
                        })
                ->editColumn('today_deal',function ($product){
                    if ($product->today_deal==1){
                                    return '<a href="#"  data-id="'.$product->id.'" class="deactive_deal"><i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-success">active</span></a>';
                            }else{
                                    return '<a href="#"  data-id="'.$product->id.'" class="active_deal" ><i class="fas fa-thumbs-down text-danger"></i><span class="badge badge-danger">deactive</span></a>';
                                }
                        })
                ->editColumn('status',function ($product){
                    if ($product->status==1){
                                    return '<a href="#" data-id="'.$product->id.'" class="deactive_status"><i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-success">active</span></a>';
                            }else{
                                    return '<a href="#" data-id="'.$product->id.'" class="active_status"><i class="fas fa-thumbs-down text-danger"></i><span class="badge badge-danger">deactive</span></a>';
                                }
                        })

                    ->addColumn('action',function ($product){
                        $actionBtn ='<a href="'.route('productEdit',[$product->id]).'" class="btn btn-sm btn-info"> <span class="fa fa-edit"></span></a>
                                               <a href="'.route('productDelate',[$product->id]).'" class="btn btn-sm btn-danger" id="delete"><span class="fa fa-trash"></span></a>';
                        return $actionBtn;
                    })

                ->rawColumns(['action','thumbnail','featured','today_deal','status'])
                ->make(true);
             }

            $categories = Categorie::all();
            $brands       =  Brand::all();
                return view('admin.product.manageProduct',[
                    'categories'=>$categories,
                    'brands'      =>$brands
                ]);
    }


    //product Edit
        public function productEdit($id){
            $categories            = Categorie::all();
            $brands                  = Brand::all();
            $pickups                = Pickup::all();
            $warehouses         =Warehouse::all();
            $product = Product::find($id);
            return view('admin.product.productEdit',[
                'product'       =>$product,
                'categories'   =>$categories,
                'brands'         =>$brands,
                'pickups'       =>$pickups,
                'warehouses'=>$warehouses
            ]);
        }



        //update product is running
    public function updateProduct(Request $request){
        $data = array();
        $subcat = DB::table('subcategories')->where('id',$request->subcategorie_id)->first();
        $slug = Str::slug($request->name, '-');

        $data['name']                      = $request->name;
        $data['code']                       = $request->code;
        $data['product_slug']         = Str::slug($request->name, '-');
        $data['categorie_id']          = $subcat->categorie_id;
        $data['subcategorie_id']    = $request->subcategorie_id;
        $data['childcategorie_id'] = $request->childcategorie_id;
        $data['brand_id']               = $request->brand_id;
        $data['pickup_id']            = $request->pickup_id;
        $data['unit']                      = $request->unit;
        $data['tags']                      = $request->tags;
        $data['purchase_price'] = $request->purchase_price;
        $data['selling_price']     = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['warehouse']         = $request->warehouse;
        $data['sku']                      = $request->sku;
        $data['color']                   = $request->color;
        $data['size']                     = $request->size;
        $data['description']        = $request->description;
        $data['featured']             = $request->featured;
        $data['today_deal']        = $request->today_deal;
        $data['product_slider']  = $request->product_slider;
        $data['status']                 = $request->status;
        $data['admin_id']           = Auth::id();
        $data['date']                    = date('d-m-Y');
        $data['month']                = date('F');

        if ($request->thumbnail) {
                if (File::exists($request->old_thumbnail)){
                    unlink($request->old_thumbnail);
                            }
                            $photo = $request->thumbnail;
                            $photoName = $slug . '.' . $photo->getClientOriginalExtension();
                            Image::make($photo)->resize(600, 600)->save('admin/products_img/' . $photoName);
                            $data['thumbnail'] = $photoName;
                 }else{
                            $data['old_thumbnail'] = $request->old_thumbnail;

                                return $request;
//            DB::table('products')->where('id',$request->id)->update($data);
//            $notification = array('messege'=>'Product Successfully Updated','alert-type'=>'info');
//            return redirect()->back()->with($notification);
        }

    }


//product delete
        public function productDelate($id){
            $product = Product::find($id);
            $path = asset('admin/products_img/');

            $image=$product->thumbnail;
            if (File::exists($path.$image)){
                unlink($path.$image);
            }

            $product->delete();
            $notification = array('messege'=>'Product Successfully Deleted','alert-type'=>'error');
            return redirect()->back()->with($notification);
        }




//publication status on of function
    public function deactiveFeat($id){
        DB::table('products')->where('id',$id)->update(['featured'=>0]);
        return response()->json('Featured Status Deactive');
    }

    public function activeFeat($id){
        DB::table('products')->where('id',$id)->update(['featured'=>1]);
        return response()->json('Featured Status Active');
    }

    public function deactiveDeal($id){
        DB::table('products')->where('id',$id)->update(['today_deal'=>0]);
        return response()->json('Today Deal Is Deactive');
    }
    public function activeDeal($id){
        DB::table('products')->where('id',$id)->update(['today_deal'=>1]);
        return response()->json('Today Deal Is active');
    }
    public function deactiveStatus($id){
        DB::table('products')->where('id',$id)->update(['status'=>0]);
        return response()->json('Publication Status Is Deactive');
    }
    public function activeStatus($id){
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        return response()->json('Publication Status Is active');
    }


}
