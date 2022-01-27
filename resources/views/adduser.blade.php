
@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('msg'))
<div class="alert alert-danger">{{Session::get('msg')}}</div>
@endif
    <form method="post" action="added" enctype="multipart/form-data">
    <h2 class="text-center text-primary">Add User</h2>
        @csrf()
        <div class="row form-group m-auto col-5">
      First name <input type="text" class="form-control" name="fname"/>
      @if($errors->has('fname'))
      <label class="text-danger">{{$errors->first('fname')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
      Last name <input type="text" class="form-control" name="lname"/>
      @if($errors->has('lname'))
      <label class="text-danger">{{$errors->first('lname')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
      Email <input type="email" class="form-control" name="email"/>
      @if($errors->has('email'))
      <label class="text-danger">{{$errors->first('email')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
      Password <input type="password" class="form-control" name="pass"/>
      @if($errors->has('pass'))
      <label class="text-danger">{{$errors->first('pass')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
      Confirm Password<input type="password" class="form-control" name="cpass"/>
      @if($errors->has('cpass'))
      <label class="text-danger">{{$errors->first('cpass')}}</label>
      @endif
      </div>
      <div class="row form-group m-auto col-5">
        Role Type
      <select name="rtype" class="form-control">
      <option>Role Type</option>
        @foreach($data as $i)
        <option value="{{$i->id}}">{{$i->role_name}}</option>
        @endforeach
        @if($errors->has('rtype'))
      <label class="text-danger">{{$errors->first('rtype')}}</label>
      @endif
      </select>
      </div><br>
      <div class="row form-group m-auto col-5">
      <h6>Status</h6>
      </div>
      <div class="row form-group m-auto col-5">
      <div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status" value="1">Active
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status" value="0">Inactive
  </label>
</div>
@if($errors->has('status'))
      <label class="text-danger">{{$errors->first('status')}}</label>
      @endif
</div>
      <div class="text-center mt-2">
    <input type="submit" class="btn btn-success" value="submit"/>
      </div>
    </form>

</div>
@endsection