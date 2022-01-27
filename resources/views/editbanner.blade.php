
@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('msg'))
<div class="alert alert-danger">{{Session::get('msg')}}</div>
@endif
    <form method="post" action="/updatebanner" enctype="multipart/form-data">
        @csrf()
        <div class="row form-group m-auto col-5">
      Banner name <input type="text" class="form-control" name="img_name" value="{{$data->img_name}}"/>
      @if($errors->has('img_name'))
      <label class="text-danger">{{$errors->first('img_name')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
      Banner Image <input type="file" class="form-control" name="img_path" value="{{$data->img_path}}"/>
      @if($errors->has('img_path'))
      <label class="text-danger">{{$errors->first('img_path')}}</label>
      @endif
      </div>
     
      <input type="hidden" name="uid" value="{{$data->id}}"/>
      <div class="text-center mt-2">
    <input type="submit" class="btn btn-success" value="submit"/>
      </div>
    </form>

</div>
@endsection