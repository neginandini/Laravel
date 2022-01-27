@php
$sess=session('check');
@endphp
@extends('layouts.app')
<style>
    .btnMargin{
        margin-left:25%;
    }
    </style>
@section('content')
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Management</h3>
                <a href="/adduser" class="btn btn-warning btnMargin">Add User</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Sno</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Roll type</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php
    $sn=1;
    @endphp
    @foreach($data as $i)
    <tr>

    <td>{{$sn++}}</td>
    <td>{{$i->first_name}}</td>
    <td>{{$i->last_name}}</td>
    <td>{{$i->email}}</td>
    <td>{{$i->role_type}}</td>
    <td>
    <a href="/edituser/{{$i->id}}" class="btn btn-info">Edit</a>
    <button type="submit" onclick="return confirm('Do you really want to delete this user!')" class="btn btn-danger">
    <a href="deleteuser/{{$i->id}}" class="text-decoration-none text-white">Delete</button>
    </td>
    </tr>
    @endforeach
                 
                  </tbody>
                </table>
            
              </div>
            </div>
              <!-- /.card-body -->
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
            @endsection
        