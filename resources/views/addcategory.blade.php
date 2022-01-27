
@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('msg'))
<div class="alert alert-danger">{{Session::get('msg')}}</div>
@endif
    <form method="post" action="/uploadcat" enctype="multipart/form-data">
      <h1 class="text-center text-primary">Add Category</h1>
        @csrf()
        <div class="row form-group m-auto col-5">
     Category Name <input type="text" class="form-control" name="cat_name"/>
      @if($errors->has('cat_name'))
      <label class="text-danger">{{$errors->first('cat_name')}}</label>
      @endif
      </div>

      <div class="text-center mt-2"> 
    <input type="submit" class="btn btn-success" value="submit"/>
      </div>
    </form>

</div>
@endsection