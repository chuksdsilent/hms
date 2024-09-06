@extends('partials.sadmin')
@section('title', 'New General Bill')
@section('content')

    <div class="custom mt-5">
        <div class="card">
            <div class="card-body">
                <h3>New Bill</h3>
                <hr />
                <form action="{{url("admin/create-new-bill")}}" method="post">
                    @csrf
                    <div class="mt-3">
                        <div class="form-group mb-4">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
