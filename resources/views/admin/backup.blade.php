@extends('partials.sadmin')
@section('title', 'Backup')
@section('content')
@if(Session::has("msg"))
<div class="alert alert-success">{{Session::get("msg")}}</div>
@endif

<a href="{{url('/admin/backup')}}" class="btn btn-primary">Backup</a>
@endsection