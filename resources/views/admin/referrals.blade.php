@extends('partials.sadmin')
@section('title', 'New Referral')
@section('content')
<div class="custom mt-5">
    <div class="card">
        <div class="card-body">
            @if (Session::has("msg"))
            <div class="alert alert-success">{{Session::get("msg")}}. Click <a
                    href="{{url('admin/new-referral')}}">here</a> to create a new
                referral </div>
            @endif

            <div class="d-flex align-items-stretch mb-3">
                <div class="flex-grow-1">
                    <h4>Referrals</h4>
                </div>
                <div>
                    <a href="{{url("admin/new-referral")}}" class="btn btn-primary">Create New Referral</a>
                </div>

            </div>
            <table class="table table-hover">
                <thead>
                    <th width="20%">#</th>
                    <th width="45%">Name</th>
                    <th>Actions</th>
                </thead>
                <tbody>

                    @foreach ($referrals as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            <a href="{{url("admin/referral/view/" . $item->id)}}" class="btn btn-success">View</a>
                            <a href="{{url("admin/referral/edit/" . $item->id)}}" class="btn btn-success">Edit</a>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Referral</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the Referral?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <a href="{{url("admin/referral/delete/". $item->id)}}"
                                                class="btn btn-danger">Delete</a>
                                        </div>
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
@endsection