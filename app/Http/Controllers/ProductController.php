<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function delete_product($id)
    {
        $product=Product::find($id);
        $product->delete();
        return response()->json(['message'=>'Delete Successfully','status'=>true]);
    }

    public function all_products()
    {
        
        $products=Product::with('category')->where('user_id',Auth::user()->id)->get();
        // return $products;
        return response()->json(['data'=>$products,'status'=>true]);
       
    }
    public function addproduct(Request $request)
    {
        
         $validation = Validator::make($request->all(),[ 
                    'name' => 'required',
                    'price' => 'required',
                    'desc' => 'required',
                    'category_id'=>'required'
        
            ]);

        if($validation->fails()){

                return response()->json(['message'=>$validation->messages(),'status'=>false]);
        }
        
        $product=new Product;
        $product->name=$request->name;
        $product->price=$request->price;
        $product->desc=$request->desc;
        $product->category_id=$request->category_id;
        $product->user_id=Auth::user()->id;
        $product->save();
        return response()->json(['data'=>$product,'status'=>true]);
    }
}