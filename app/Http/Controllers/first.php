<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use  App\Models\Role;
use  App\Models\Banner;
use  App\Models\Category;
use  App\Models\Product;
use  App\Models\Image;
use  App\Models\Coupon;
use App\Models\Attribute;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;




class first extends Controller
{

    public function user(){
        $dat=Auth::user();
        $a=User::where('id',$dat->id)->first();
        $b=$a->role_id;
        $sess=session()->put('check',$b);
        $data=User::all();
        return view('user',compact('data','dat'));

    }
    public function adduser(){
        $data=Role::all();
        return view('adduser',compact('data'));
    }
    
    public function added(Request $req){
        $validated=$req->validate([
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required|unique:users',
            'pass'=>'required|min:5',
            'cpass'=>'required|min:5',
            'rtype'=>'required',
            'status'=>'required'
           
        ],
        [
            'fname.required'=>'First name is required',
            'lname.required'=>'Last name is required',
            'email.required'=>'Email is required',
            'pass.required'=>'Password is required',
            'cpass.required'=>'Confirm your password',
            'rtype.required'=>'Role type i required',
            'status.required'=>'Status is required'
        ]
        );
        if($validated){
            if($req->cpass==$req->pass){
             $data=Role::where('id',$req->rtype)->first();
                User::insert([
                    'first_name'=>$req->fname,
                    'last_name'=>$req->lname,
                    'email'=>$req->email,
                    'password'=>$req->pass,
                    'role_type'=>$data->role_name,
                    'status'=>$req->status,
                    'role_id'=>$data->id
                ]);
                return redirect('user');
            }
            else{
                return back()->with('msg','Passwords should be same');
            }
            

        }
    }

    public function edituser($id){
        $role=Role::all();
        $data=User::find($id);
        return view('edituser',compact('data','role'));
    } 

    public function deluser($id){
        $data=User::find($id)->delete();
        return redirect('/user');
    }

    public function update(Request $req){
        $role=Role::where('id',$req->rtype)->first();
        $validateData=$req->validate([
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required',
            'rtype'=>'required',
            'status'=>'required',
        ],[
            'fname.required'=>'First name is required',
            'lname.required'=>'Last name is required',
            'email.required'=>'Email is required',
            'rtype.required'=>'Role type is required',
            'status.required'=>'Select the status',
        ]);
        if($validateData){
        User::where('id',$req->uid)->update([
            'first_name'=>$req->fname,
            'last_name'=>$req->lname,
            'email'=>$req->email,
                'role_type'=>$role->role_name,
                'role_id'=>$role->id,  
                'status'=>$req->status,
        ]);
        return redirect('/user');
    }
}
    public function banner(){
        $data=Banner::all();
        return view('banner',compact('data'));
    }

    public function addbanner(){
        return view('addbanner');
    }

    public function upload(Request $req){
        $validated=$req->validate([
         'img_name'=>'required',
         'img_path'=>'required|mimes:jpg,jpeg,png,JPEG,JPG,PNG'
        ]);
        if($validated){
            $filename=$req->img_name.rand().".".$req->img_path->extension();
            if($req->img_path->move(public_path('uploads/'),$filename))
{
    Banner::insert([
    'img_name'=>$req->img_name,
    'img_path'=>$filename
    ]);


}   
return redirect('/banner');
     }
    }

    public function editbanner($id){
        $data=Banner::find($id);
         return view('editbanner',compact('data'));
    }

    public function updatebanner(Request $req){
        $validated=$req->validate([
            'img_name'=>'required',
            'img_path'=>'required'
        ]);
        if($validated){
            $filename=$req->img_name.rand().".".$req->img_path->extension();
        if($req->img_path->move(public_path('uploads/'),$filename)){
         Banner::where('id',$req->uid)->update([
                'img_name'=>$req->img_name,
                'img_path'=>$filename,
        
                
            ]);
            return redirect('/banner');
        }
        }
    
    else{
        return back()->with('msg','Not done');
    }
}

public function delbanner($id){
    Banner::find($id)->delete();
    return redirect('/banner');

}

public function category(){
    $data=Category::all();
    return view('category',compact('data'));
}
public function addcat(){
    return view('addcategory');
}
public function uploadcate(Request $req){
       $validated=$req->validate([
           'cat_name'=>'required'
       ]);
       if($validated){
           Category::insert([
               'cat_name'=>$req->cat_name,
           ]);
           return redirect('/category');
       }
       else{
           return back()->with('msg','Failed to add');
       }
}

public function deletecat($id){
    Category::find($id)->delete();
    return redirect('category');
}
public function editcat($id){
    $data=Category::find($id);
    return view('editcat',compact('data'));
}
public function updatecat(Request $req){
    $validated=$req->validate([
        'cat_name'=>'required'
    ]);
    if($validated){
        Category::where('id',$req->uid)->update([
            'cat_name'=>$req->cat_name
        ]);
        return redirect('category');
    }
}

public function products(){
    $data=Product::all();
    return view('products',compact('data'));
}
public function addproduct()
{
    $data=Category::all();
    return view('addproduct',compact('data'));
}

public function addedp(Request $req){
$validated=$req->validate([
  'pname'=>'required',
  'category'=>'required',
  'proimage'=>'required'
]);
if($validated){
    $cat=Category::where('id',$req->category)->first();
    $filename=$req->pname.rand().".".$req->proimage->extension();
    if($req->proimage->move(public_path('uploads/'),$filename)){
      Product::insert([
    'pro_name'=>$req->pname,
    'cat_type'=>$cat->cat_name,
     'proimage'=>$filename,
    'category_id'=>$req->category
]);
    }

    return redirect('products/');
}
else{
    return back()->with('msg','Not added');
}
 
}
public function editpro($id){
    $data=Product::find($id);
    $cat=Category::all();
    return view('editpro',compact('data','cat'));
}
public function updatep(Request $req){
    $validated=$req->validate([
        'pro_name'=>'required',
        'category'=>'required'
    ]);
    if($validated){
        $cat=Category::where('id',$req->category)->first();
Product::where('id',$req->uid)->update([
    'pro_name'=>$req->pro_name,
    'cat_type'=>$cat->cat_name,
    'category_id'=>$req->category
]);
 
return redirect('products');
    }

}
public function deletepro($id){
Product::find($id)->delete();
return redirect('products');
}
public function images($id){
       $pro=Product::find($id);
        $imgs=$pro->images;
        return view('image',compact('imgs','pro'));

}
public function proback(){
    return redirect('products');
}
public function imgg($id){
    $data=Product::where('id',$id)->first();
    return view('imageupload',compact('data'));
}
public function uploadimg(Request $req){
    $filename=$req->image_name.rand().".".$req->image->extension();
    if($req->image->move(public_path('uploads/'),$filename)){
        Image::insert([
            'img_name'=>$req->image_name,
            'img_path'=>$filename,
            'product_id'=>$req->uid,
        ]);
        return redirect('products');
    }
    else{
        return back()->with("msg","not uploaded");
    }
}
public function coupons(){
    $data=Coupon::all();
    return view('coupons',compact('data'));
}
public function addc(){
    return view('addc');
}
public function addedc(Request $req){
    $validated=$req->validate([
        'cname'=>'required',
        'cvalue'=>'required'
      ]);
      if($validated){
      Coupon::insert([
          'coupon_name'=>$req->cname,
          'coupon_value'=>$req->cvalue
      ]);
      
          return redirect('coupons');
      }
      else{
          return back()->with('msg','Not added');
      }
       
}
public function editc($id){
    $data=Coupon::find($id);
    return view('editc',compact('data'));

}
public function uploadc(Request $req){
    $validated=$req->validate([
        'cname'=>'required',
        'cvalue'=>'required'
    ]);
    if($validated){
   Coupon::where('id',$req->uid)->update([
    'coupon_name'=>$req->cname,
    'coupon_value'=>$req->cvalue
]);
 
return redirect('coupons');
    }
     
}
public function deletec($id){
    Coupon::find($id)->delete();
    return redirect('coupons');
}

    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}


public function attr(){
    $data=Attribute::all();
    return view('attr',compact('data'));
}
public function addattr(){
    $data=Product::all();
    return view('addattr',compact('data'));
}
public function addedattr(Request $req){
    { 
        $validated=$req->validate([ 
        'price'=>'required',
         'desc'=>'required',
          'proname'=>'required', ] );
         if($validated)
         {
              Attribute::insert([
                   'price'=>$req->price, 
                   'description'=>$req->desc,
                   'quantity'=>$req->quan,
                    'product_id'=>$req->proname
                 ]);
                  return redirect('attr');
                 } 
                 else{ return back()->with('msg','Passwords should be same'); 
                } 
    }
            } 
            public function deleteattr($id){
                 Attribute::find($id)->delete(); 
                 return redirect('attr');
     } 
     public function contact(){
         $data=Contact::all();
         return view('contact',compact('data'));
     }
     public function delcontact($id){
         Contact::find($id)->delete();
         return redirect('contact');
     }

     
}
    

