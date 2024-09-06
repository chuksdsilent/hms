@extends('partials.sadmin')
@section('title', 'Edit Patient')
@section('content')

<div class=" custom my-4">
    <div class="card">
        <div class="card-body">
            @if (Session::has("msg"))
            <div class="alert alert-success">
                <h6>{{Session::get("msg")}}</h6>
            </div>
            @endif
            <h3>Edit Patient </h3>
            <hr />
            <form id="create" action="{{url('admin/patients/edit/' . $pat->edit_id)}}" method="POST">
                @csrf
                <div class="new-patient" id="new-patient">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="my-3">
                                <label for="" class="form-label">First Name</label><input type="text" name="first_name"
                                    class="form-control" value="{{$pat->first_name}}">
                                @if ($errors->first("first_name"))
                                <span>{{$errors->first("first_name")}}</span>
                                @endif
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="my-3">
                                <label for="" class="form-label">Last Name</label><input type="text" name="last_name"
                                    class="form-control" value="{{$pat->last_name}}">
                                @if ($errors->first("last_name"))
                                <span>{{$errors->first("last_name")}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="" class="form-label">Gender</label>
                        <select name="gender" id="" class="form-control">
                            <option value="M" {{($pat->gender == "M") ? "selected" : ""}}>Male</option>
                            <option value="F" {{($pat->gender == "F") ? "selected" : ""}}>Female</option>
                        </select>
                        @if ($errors->first("gender"))
                        <span>{{$errors->first("gender")}}</span>
                        @endif
                    </div>
{{--                    <div class="my-3">--}}
{{--                        <label for="" class="form-label">Phone</label><input type="number" name="phone"--}}
{{--                            class="form-control" value="{{$pat->phone}}">--}}
{{--                        @if ($errors->first("phone"))--}}
{{--                        <span>{{$errors->first("phone")}}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
                </div>

                <div class="my-3">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>
</div>
@endsection