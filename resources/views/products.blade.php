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
                <h3 class="card-title">Products Management</h3>
                <a href="/addproduct" class="btn btn-warning btnMargin">Add Product</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Sno</th>
        <th>Product Name</th>
        <th>Product Image</th>
        <th>Category Name</th>
        <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php
    $sn=1;
    @endphp
    @foreach($data as $i)
    <tr>
    <td>{{$sn++}}</td>
    <td>{{$i->pro_name}}</td>
    <td>{{$i->proimage}}</td>
    <td>  <img src="{{url('uploads/'.$i->proimage)}}" height="100" width="100"/></td>
    <td>
    <a href="/image/{{$i->id}}" class="btn btn-info">Images</a>
    <a href="/editpro/{{$i->id}}" class="btn btn-info">Edit</a>
    <button type="submit" onclick="return confirm('Do you really want to delete this product')" class="btn btn-danger">
    <a href="deletepro/{{$i->id}}" class="text-decoration-none text-white">Delete</button>
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
        