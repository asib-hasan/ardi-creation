<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Validator;
use Str;

class CategoryController extends Controller
{
    public function index(){
        $categories =  CategoryModel::latest()->paginate(10);

        return view('admin.category.list');
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
       // dd("Hello");
        $validator = Validator::make($request->all(),[
            'name' =>'required',
            'slug' => 'required | unique:categories',
        ]);

        if($validator->passes()){
            $category = new CategoryModel();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            $request->session()->flash('success','Category Added Successfully');
            
            return response()->json([
                'status' => true,
                'message' => 'Category Added Successfully',
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }

    public function slug(Request $request){
        $slug = '';
        if(!empty($request->title)){
            $slug = Str::slug($request->title);
        }
        return response()->json([
            'status' => true,
            'slug' =>$slug,
            'fuck' =>'fuck'
        ]);
    }
}
