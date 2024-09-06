@extends('partials.sadmin')
@section('title', 'New Referral')
@section('content')
<div class="custom mt-5">
    <div class="card">
        <div class="card-body">
            @if (Session::has("msg"))
            <div class="alert alert-success">{{Session::get("msg")}}.</div>
            @endif

            <div class="d-flex align-items-stretch mb-3">
                <div class="flex-grow-1">
                    <h4>Department</h4>
                </div>
                <div>
                    <a href="{{url("admin/new-department")}}" class="btn btn-primary">Create New Department</a>
                </div>

            </div>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th width="30%">Name</th>
                    <th>Date</th>
                    <th>Action</th>
                   
                   
                </thead>
                <tbody>

                    @foreach ($department as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            {{\Carbon\Carbon::parse($item->created_at)->format("d M, Y")}}
                        </td>
                        <td>
                         <a href="{{url('admin/department/view/'.$item->id)}}" class="btn btn-primary">View</a>
                         <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{$item->id}}">Delete</a>
                        </td>

                    </tr>
                    
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Department</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the Department?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <a href="{{url('admin/department/delete/'.$item->id)}}"
                                                class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection