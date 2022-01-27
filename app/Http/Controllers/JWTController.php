<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class JWTController extends Controller
{
    public function __construct() {
        auth()->setDefaultDriver('api'); 
       }
    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|string|min:8'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else {
            $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> Hash::make($request->password)
            ]);
            return response()->json([
                'message'=>'User create successfully',
                'user'=>$user
            ],201);
        }
    }
    public function login(Request $request){
        $apiemail=$request['email'];
        $validator=Validator::make($request->all(),[
            'email'=>'required|string|email',
            'password'=>'required|string|min:8'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else {
            if(!$token=auth()->attempt($validator->validated())){
               return response()->json(['error'=>'Unauthorized'],401);
            }
            // return $this->respondWithToken($token);
            return response()->json(['access_token' => $token, "email" => $request->email], 200);
        }
    }
    public function logout(){
        auth()->logout();
        return response()->json(["message"=>"User Logout Successfully"]);
    }
    public function respondWithToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth()->factory()->getTTL()*60
        ]);
    }
    public function profile(){
        $arr=["admin","admin"];
        return response()->json($arr);
    }
    public function refresh(){
        return $this->responseWithToken(auth()->refresh());
    }
}
