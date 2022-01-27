@php
$sess=session('check');
@endphp
@extends('layouts.app')
@section('content')
  
  <div class="content-wrapper">
  <h1 class="text-warning">
    Welcome!!! {{$sess}}
  </h1>
  </div>
  @stop
  <!-- /.content-wrapper -->
  