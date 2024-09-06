@extends('partials.sadmin')
@section('title', 'All Test')
@section('content')
<div class="custom my-4">
    <div class="tests">
        <div class="card">
            <div class="card-body">
                @if (Session::has("msg"))
                <div class="alert alert-danger">
                    <h6>{{Session::get("msg")}}</h6>
                </div>
                @endif
                <div class="test-header">
                    <h3 class="my-auto">Tests</h3>
                    <a href="{{url("admin/create-new-test")}}" class="btn btn-primary">Create New Test</a>

                </div>
                <hr />
                <table class="table table-striped">
                    <thead>
                        <th width="10%">#</th>
                        <th width="40%">Name</th>
                        <th>Price</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach ($tests as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->name}}</td>
                            <td>N{{$item->price}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format("d M, Y")}}</td>
                            <td>
                                <a href="{{url("admin/test/edit/". $item->id)}}"
                                    class="btn btn-success btn-edit">Edit</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{$item->id}}">
                                    Delete
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Test</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the test?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="{{url("admin/test/delete/". $item->id)}}"
                                                    class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr> @endforeach </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection