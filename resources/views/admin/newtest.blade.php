@extends('partials.sadmin')
@section('title', 'New Test')
@section('content')
<div class="custom my-4">
    <div class="card">
        <div class="card-body">
            @if (Session::has("msg"))
            <div class="alert alert-success">
                <h6>{{Session::get("msg")}}</h6>
            </div>
            @endif
            <h3>Create New Test</h3>
            <hr />
            <form action="{{url('admin/create-new-test')}}" method="POST">
                @csrf
                <div class="my-3">
                    <label for="" class="form-label">Name</label><input type="text" name="name" class="form-control">
                    @if ($errors->first("name"))
                    <span>{{$errors->first("name")}}</span>
                    @endif
                </div>
                <div class="my-3">
                    <label for="" class="form-label">Price</label><input type="text" name="price" class="form-control">
                    @if ($errors->first("price"))
                    <span>{{$errors->first("price")}}</span>
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