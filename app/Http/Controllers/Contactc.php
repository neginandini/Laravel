<?php

namespace App\Http\Controllers;
use App\Http\Resources\apiresource;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class Contactc extends Controller
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
        $data=Contact::latest()->get();
        //$data=["msg"=>"Task Api call"];
        return response()->json(['contacts'=>$data]); 
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
            'name'=>['required'],
            'email'=>['required'],
            'subject'=>['required'],
            'message'=>['required'],
        ]);
        if($validator->fails()){
            return response(['errors'=>$validator->errors()]);
        }
        else{
            $data = new Contact();
            $data->name=$request->name;
            $data->email=$request->email;
            $data->subject=$request->subject;
            $data->message=$request->message;
        

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
     {$contact=Contact::find($id);

        return response()->json(['contacts'=>$contact]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $product
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
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
        $task=Contact::find($id);
        $task->delete();
        return response(['data'=>new apiresource($task),"message"=>"deleted"],201);

    }
}
