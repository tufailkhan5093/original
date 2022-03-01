<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function addcategory(Request $request)
    {
         $validation = Validator::make($request->all(),[ 
        'name' => 'required',
        
            ]);

        if($validation->fails()){

                return response()->json(['message'=>$validation->messages(),'status'=>false]);
        }
        
        $category=new Category();
        $category->name=$request->name;
        $category->user_id=Auth::user()->id;
        $category->save();
        return response()->json(['data'=>$category,'status'=>true]);
    }

    public function all_categories()
    {
        $categories=Category::where('user_id',Auth::user()->id)->get();
        if($categories->count()>0)
        {
            return response()->json(['data'=>$categories,'status'=>true]);
        }
        else
        {
            return response()->json(['message'=>'No Category','status'=>false]);
        }
        
        
    }
}