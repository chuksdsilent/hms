@extends('partials.sadmin')
@section('title', 'Change Password')
@section('content')
<div class="custom my-4">
    <div class="card">
        <div class="card-body">
            @if (Session::has("msg"))
            <div class="alert alert-danger">{{Session::get("msg")}}</div>
            @endif
            <h4>Change Password</h4>
            <hr />
            <form action="{{url("staff/password/change")}}" method="POST">
                @csrf
                <div class="my-3"><label for="">Old Password</label><input value="{{old("oldpassword")}}"
                        type="password" name="oldpassword" class="form-control">
                    @if ($errors->first("oldpassword"))
                    <span>{{$errors->first("oldpassword")}}</span>
                    @endif
                </div>
                <div class="my-3"><label for="">New Password</label><input value="{{old("newpassword")}}"
                        type="password" name="newpassword" class="form-control">@if ($errors->first("newpassword"))
                    <span>{{$errors->first("newpassword")}}</span>
                    @endif</div>
                <div class="my-3"><label for="">Confirm Password</label><input value="{{old("confirmpassword")}}"
                        type="password" name="confirmpassword" class="form-control">
                    @if ($errors->first("confirmpassword"))
                    <span>{{$errors->first("confirmpassword")}}</span>
                    @endif</div>
                <input type="submit" value="Update" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection