
@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('msg'))
<div class="alert alert-danger">{{Session::get('msg')}}</div>
@endif
    <form method="post" action="/updatepro" enctype="multipart/form-data">
        @csrf()
        <div class="row form-group m-auto col-5">
      Banner name <input type="text" class="form-control" name="pro_name" value="{{$data->pro_name}}"/>
      @if($errors->has('pro_name'))
      <label class="text-danger">{{$errors->first('pro_name')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
        Category Type
      <select name="category" class="form-control">
        <option value="">Role Type</option>
        @foreach($cat as $i)
        <option value="{{$i->id}}" {{($i->id == $data->category_id)?'selected':''}}>{{$i->cat_name}}</option>
        @endforeach
      </select>
      @if($errors->has('category'))
      <label class="text-danger">{{$errors->first('category')}}</label>
      @endif
      </div>
     
      <input type="hidden" name="uid" value="{{$data->id}}"/>
      <div class="text-center mt-2">
    <input type="submit" class="btn btn-success" value="submit"/>
      </div>
    </form>

</div>
@endsection