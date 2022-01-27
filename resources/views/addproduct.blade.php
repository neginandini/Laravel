
@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('msg'))
<div class="alert alert-danger">{{Session::get('msg')}}</div>
@endif
    <form method="post" action="addedp" enctype="multipart/form-data">
    <h2 class="text-center text-primary">Add Product</h2>
        @csrf()
        <div class="row form-group m-auto col-5">
      Product name <input type="text" class="form-control" name="pname"/>
      @if($errors->has('pname'))
      <label class="text-danger">{{$errors->first('pname')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
      Product Image <input type="file" class="form-control" name="proimage"/>
      @if($errors->has('proimage'))
      <label class="text-danger">{{$errors->first('proimage')}}</label>
      @endif
      </div>

      <div class="row form-group m-auto col-5">
      Product Name
      <select name="category" class="form-control">
      <option>--Category Name--</option>
        @foreach($data as $i)
        <option value="{{$i->id}}">{{$i->cat_name}}</option>
        @endforeach
        @if($errors->has('pro'))
      <label class="text-danger">{{$errors->first('pro')}}</label>
      @endif
      </select>
      </div><br>

      <div class="text-center mt-2">
    <input type="submit" class="btn btn-success" value="submit"/>
      </div>
    </form>

</div>
@endsection