<?php

namespace App\Http\Controllers;
use App\Http\Resources\apiresource;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class Categoryc extends Controller
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
        $data=Category::latest()->get();
        //$data=["msg"=>"Task Api call"];
        return response()->json(['categories'=>$data]); 
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
            'cat_name'=>['required'],
        ]);
        if($validator->fails()){
            return response(['errors'=>$validator->errors()]);
        }
        else{
            $data = new Category();
            $data->cat_name=$request->cat_name;
        

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
     {$cat=Category::find($id);

        return response()->json(['cat'=>$cat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $product
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
     * @param  \App\Models\Category  $product
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
     * @param  \App\Models\Category  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=Product::find($id);
        $task->delete();
        return response(['data'=>new apiresource($task),"message"=>"deleted"],201);

    }
}
