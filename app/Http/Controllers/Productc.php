<?php

namespace App\Http\Controllers;
use App\Http\Resources\apiresource;
use App\Models\Product;
use DB;
use App\Models\Attribute;
use App\Models\Image;

use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class Productc extends Controller
{
    public function __construct() {
        auth()->setDefaultDriver('api'); 
       }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data=Product::latest()->get();
        // $attr=Attribute::latest()->get();
        
        // //$data=["msg"=>"Task Api call"];
        // return response()->json(['products'=>$data,'attributes'=>$attr]); 
      $productData=DB::select('SELECT products.id,products.pro_name,products.proimage,attributes.price,attributes.quantity,attributes.description,categories.id
      as category_id FROM categories JOIN products ON categories.id=products.category_id JOIN attributes ON attributes.product_id=products.id');
      $data=compact('productData');
      return response()->json(compact('data'));
    //   return response()->json(['products'=>$data]); 

    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'pro_name'=>['required'],
            'cat_type'=>['required'],
            'proimage'=>['required'],
            'category_id'=>['required']
        ]);
        if($validator->fails()){
            return response(['errors'=>$validator->errors()]);
        }
        else{
            $data = new Product();
            $data->pro_name=$request->pro_name;
            $data->cat_type=$request->cat_type;
            $data->proimage=$request->proimage;
            $data->category_id=$request->category_id;

            if($data->save()){
                return response(['data'=>new apiresource($data),"message"=>"data stored"],201);
               // return response()->json($data);
            }
            else{
               // return response()->json(['msg'=>'api not added']);
               return response(['msg'=>"data not stored"]);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {$products=Product::find($id);
    
        $attr=$products->attributes;

        return response()->json(['products'=>$products,'attributes'=>$attr]);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Apimodel $apimodel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request,$idd)
    // {
    //     $validator=Validator::make($request->all(),[
    //         'pro_name'=>['required','max:5'],
    //         'cat_type'=>['required','max:10'],

    //     ]);
    //     if($validator->fails()){
    //         return response(['errors'=>$validator->errors()]);
    //     }
    //     else{
    //         $data =Product::find($idd);
    //         $data->name=$request->name;
    //         $data->description=$request->description;
    //         if($data->save()){
    //             return response(['data'=>new apiresource($data),"message"=>"data updated"],201);
    //            // return response()->json($data);
    //         }
    //         else{
    //            // return response()->json(['msg'=>'api not added']);
    //            return response(['msg'=>"data not updated"]);
    //         }
    //     }

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=Product::find($id);
        $task->delete();
        return response(['data'=>new apiresource($task),"message"=>"deleted"],201);

    }
}
