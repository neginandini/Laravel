
@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('msg'))
<div class="alert alert-danger">{{Session::get('msg')}}</div>
@endif
    <form method="post" action="/updateuser">
        @csrf()
        <div class="row form-group m-auto col-5">
      First name <input type="text" class="form-control" name="fname" value="{{$data->first_name}}"/>
      @if($errors->has('fname'))
      <label class="text-danger">{{$errors->first('fname')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
      Last name <input type="text" class="form-control" name="lname" value="{{$data->last_name}}"/>
      @if($errors->has('lname'))
      <label class="text-danger">{{$errors->first('lname')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
      Email<input type="email" class="form-control" name="email" value="{{$data->email}}"/>
      @if($errors->has('email'))
      <label class="text-danger">{{$errors->first('email')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
        Role Type
      <select name="rtype" class="form-control">
        <option value="">Role Type</option>
        @foreach($role as $i)
        <option value="{{$i->id}}" {{($i->id == $data->role_id)?'selected':''}}>{{$i->role_name}}</option>
        @endforeach
      </select>
      @if($errors->has('rtype'))
      <label class="text-danger">{{$errors->first('rtype')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
      <h6>Status</h6>
      </div>
      <div class="row form-group m-auto col-5">
      <div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status" value="1" {{($data->status == "1")?'checked':''}}>Active
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status" value="0" {{($data->status == "0")?'checked':''}}>Inactive
  </label>
</div>
@if($errors->has('status'))
      <label class="text-danger">{{$errors->first('status')}}</label>
      @endif
      </div>
      <input type="hidden" name="uid" value="{{$data->id}}"/>
      <div class="text-center mt-2">
    <input type="submit" class="btn btn-success" value="submit"/>
      </div>
    </form>

</div>
@endsection