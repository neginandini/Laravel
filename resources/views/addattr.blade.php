
@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('msg'))
<div class="alert alert-danger">{{Session::get('msg')}}</div>
@endif
    <form method="post" action="addedattr" enctype="multipart/form-data">
    <h2 class="text-center text-primary">Add User</h2>
        @csrf()
        <div class="row form-group m-auto col-5">
      Price<input type="text" class="form-control" name="price"/>
      @if($errors->has('price'))
      <label class="text-danger">{{$errors->first('price')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
      Quantity<input type="text" class="form-control" name="quan"/>
      @if($errors->has('quan'))
      <label class="text-danger">{{$errors->first('quan')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
      Description <input type="text" class="form-control" name="desc"/>
      @if($errors->has('desc'))
      <label class="text-danger">{{$errors->first('desc')}}</label>
      @endif
      </div>
    
      <div class="row form-group m-auto col-5">
        Product Name
      <select name="proname" class="form-control">
      <option>Products</option>
        @foreach($data as $i)
        <option value="{{$i->id}}">{{$i->pro_name}}</option>
        @endforeach
        @if($errors->has('proname'))
      <label class="text-danger">{{$errors->first('proname')}}</label>
      @endif
      </select>
      </div><br>
     
      <div class="text-center mt-2">
    <input type="submit" class="btn btn-success" value="submit"/>
      </div>
    </form>

</div>
@endsection