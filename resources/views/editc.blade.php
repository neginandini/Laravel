
@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('msg'))
<div class="alert alert-danger">{{Session::get('msg')}}</div>
@endif
    <form method="post" action="/updatec" enctype="multipart/form-data">
        @csrf()
        <div class="row form-group m-auto col-5">
      Coupon Name <input type="text" class="form-control" name="cname" value="{{$data->coupon_name}}"/>
      @if($errors->has('cname'))
      <label class="text-danger">{{$errors->first('cname')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
      Coupon Value<input type="text" class="form-control" name="cvalue" value="{{$data->coupon_value}}"/>
      @if($errors->has('cvalue'))
      <label class="text-danger">{{$errors->first('cvalue')}}</label>
      @endif
      </div>
      
      <input type="hidden" name="uid" value="{{$data->id}}"/>
      <div class="text-center mt-2">
    <input type="submit" class="btn btn-success" value="submit"/>
      </div>
    </form>

</div>
@endsection