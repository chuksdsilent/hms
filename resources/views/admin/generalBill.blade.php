@extends('partials.sadmin')
@section('title', 'General Bill')
@section('content')

    <div class="custom mt-5">
        <div class="card">
            <div class="card-body">
                @if (Session::has('msg'))
                    <div class="alert alert-success">{{ Session::get('msg') }}.</div>
                @endif
                <div class="test-header d-flex">
                    <h3 class="flex-grow-1">General Bill</h3>
                    <a href="{{ url('admin/create-new-bill') }}" class="btn btn-primary">New General Bill</a>
                    <hr />
                </div>
                <div class="table mt-4">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Bill Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($bills as $key => $bill)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $bill->bill_name }}</td>
                                    <td>
                                        <a href="#" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#editExampleModal{{ $bill->id }}">Edit</a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editExampleModal{{ $bill->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{url("admin/bill/edit/". $bill->id)}}" method="post">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">
                                                                Edit Bill</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="Name" class="mb-2">Name</label>
                                                            <input type="text" name="name" value="{{$bill->bill_name}}" class="form-control">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#exampleModal{{ $bill->id }}">Delete</a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $bill->id }}"  tabindex="-1"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{url("admin/bill/delete/". $bill->id)}}" method="post">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel{{ $bill->id }}">
                                                                Alert</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Do you want to delete the bill?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
