<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderAddress extends Controller
{
    // / Api for order  storing /
        public function order(Request $request){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'pid'=>'required',
                'image' => 'required',
                'price' => 'required',
                'quantity' => 'required',
                'uid' => 'required',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            }
            $order= new Order;
            $order->name=$request->get('name');
            $order->pid=$request->get('pid');
            $order->image=$request->get('image');
            $order->price=$request->get('price');
            $order->quantity=$request->get('quantity');
            $order->uid=$request->get('uid');
            if($order->save()){
                $message=["Order Saved Successfully"];
                return response()->json(compact('message'));
            }else{
                $message=["Unsuccessful"];
                return response()->json(compact('message'));
            }

        }
         
         public function address(Request $request){
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name'=>'required',
                'email' => 'required',
                'postal' => 'required',
                'contact' => 'required',
                'address' => 'required',
                'payment_method' => 'required',
                'uid' => 'required',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            }
            $address= new Address;
            $address->first_name=$request->get('first_name');
            $address->last_name=$request->get('last_name');
            $address->email=$request->get('email');
            $address->postal=$request->get('postal');
            $address->contact=$request->get('contact');
            $address->address=$request->get('address');
            $address->payment_method=$request->get('payment_method');
            $address->uid=$request->get('uid');
            if($address->save()){
                $message=["Address Saved Successfully"];
                return response()->json(compact('message'));
            }else{
                $message=["Unsuccessful"];
                return response()->json(compact('message'));
            }

        }
}
