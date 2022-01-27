
@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('msg'))
<div class="alert alert-danger">{{Session::get('msg')}}</div>
@endif
    <form method="post" action="addedc" enctype="multipart/form-data">
    <h2 class="text-center text-primary">Add Coupon</h2>
        @csrf()
        <div class="row form-group m-auto col-5">
      Coupon name <input type="text" class="form-control" name="cname"/>
      @if($errors->has('cname'))
      <label class="text-danger">{{$errors->first('cname')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
      Coupon Value<input type="text" class="form-control" name="cvalue"/>
      @if($errors->has('cvalue'))
      <label class="text-danger">{{$errors->first('cvalue')}}</label>
      @endif
      </div>
     
      <div class="text-center mt-2">
    <input type="submit" class="btn btn-success" value="submit"/>
      </div>
    </form>

</div>
@endsection