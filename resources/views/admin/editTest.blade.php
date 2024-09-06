@extends('partials.sadmin')
@section('title', 'Edi Test')
@section('content')
<div class="container my-4">
    <div class="card">
        <div class="card-body">
            @if (Session::has("msg"))
            <div class="alert alert-success">
                <h6>{{Session::get("msg")}}</h6>
            </div>
            @endif
            <h3>Edit Test</h3>
            <hr />
            <form action="{{url('admin/test/edit/'. $tests->id)}}" method="POST">
                @csrf

                <div class="my-3">
                    <label for="" class="form-label">Name</label><input type="text" value="{{$tests->name}}" name="name"
                        class="form-control">
                    @if ($errors->first("name"))
                    <span>{{$errors->first("name")}}</span>
                    @endif
                </div>
                <div class="my-3">
                    <label for="" class="form-label">Price</label><input type="text" value="{{$tests->price}}"
                        name="price" class="form-control">
                    @if ($errors->first("price"))
                    <span>{{$errors->first("price")}}</span>
                    @endif
                </div>
                <div class="my-3">
                    <input type="submit" value="Update" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>
</div>
@endsection