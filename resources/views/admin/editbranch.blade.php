@extends('partials.sadmin')
@section('title', 'New Referral')
@section('content')
<div class="custom mt-5">
    <div class="card">
        <div class="card-body">
            @if (Session::has("msg"))
            <div class="alert alert-success">{{Session::get("msg")}}</div>
            @endif
            <h4>Edit Branch</h4>
            <hr>
            <form action="{{url("admin/branch/edit/" . $branch->id)}}" method="post">
                @csrf
                <label for="">Name</label>
                <input type="text" name="name" id="" value="{{$branch->name}}" class="form-control my-3">
                @if ($errors->any())
                <div class="my-2" style="color: red;"><span>{{$errors->first()}}</span></div>
                @endif
                <input type="submit" value="Update" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection