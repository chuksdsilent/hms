@extends('partials.sadmin')
@section('title', 'Edit Staff')
@section('content')
<div class="container my-4">
    <div class="card">
        <div class="card-body">
            @if (Session::has("msg"))
            <div class="alert alert-success">
                <h6>{{Session::get("msg")}}</h6>
            </div>
            @endif
            <h3>Edit Staff</h3>
            <hr />
            <form action="{{url('admin/staff/edit/'. $staff->user->id)}}" method="POST">
                @csrf
                <div class="my-3">
                    <label for="" class="form-label">First Name</label><input type="text" value="{{$staff->first_name}}"
                        name="first_name" class="form-control">
                    @if ($errors->first("first_name"))
                    <span>{{$errors->first("first_name")}}</span>
                    @endif
                </div>
                <div class="my-3">
                    <label for="" class="form-label">Last Name</label><input type="text" value="{{$staff->last_name}}"
                        name="last_name" class="form-control">
                    @if ($errors->first("last_name"))
                    <span>{{$errors->first("last_name")}}</span>
                    @endif
                </div>
                <div class="my-3">
                    <label for="" class="form-label">Usernme</label><input type="text" value="{{$staff->user->email}}"
                        name="email" class="form-control">
                    @if ($errors->first("email"))
                    <span>{{$errors->first("email")}}</span>
                    @endif
                </div>
                <div class="my-3">
                    <label for="" class="form-label">Phone</label><input type="text" value="{{$staff->phone}}"
                        name="phone" class="form-control">
                    @if ($errors->first("phone"))
                    <span>{{$errors->first("phone")}}</span>
                    @endif
                </div>
                <div class="my-3">
                    <label for="" class="form-label">Address</label>
                    <textarea class="form-control" name="address" id="" cols="30"
                        rows="10">{{$staff->address}}</textarea>
                    @if ($errors->first("address"))
                    <span>{{$errors->first("address")}}</span>
                    @endif
                </div>
                <div class="my-3">
                    <input type="submit" value="Create" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>
</div>
@endsection