@extends('partials.sadmin')
@section('title', 'All Patients')
@section('content')
<div class="container my-4">
    <div class="tests">
        <div class="card">
            <div class="card-body">
                @if (Session::has("msg"))
                <div class="alert alert-danger">
                    <h6>{{Session::get("msg")}}</h6>
                </div>
                @endif
                <div class="test-header">
                    <h3 class="my-auto">Staff</h3>
                    <a href="{{url("admin/staff/create")}}" class="btn btn-primary">Create New Staff</a>

                </div>
                <hr />
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
{{--                        <th>Username</th>--}}
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach ($staff as $item)
                        <tr>
                            <td>{{$i++}}</td>
{{--                            <td>{{$item->user->email}}</td>--}}
                            <td>{{$item->first_name}}</td>
                            <td>{{$item->last_name}}</td>
                            <td>{{ $item->phone}}</td>
                            <td>{{ $item->address}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format("d M, Y")}}</td>
                            <td>
                                <a href="{{url("admin/staff/edit/". $item->id)}}"
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
                                                <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the Staff?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="{{url("admin/staff/delete/". \App\User::where("id", $item->user_id)->value("id"))}}"
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