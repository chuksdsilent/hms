@extends('partials.sadmin')
@section('title', 'All Patients')
@section('content')
<div class="containe my-4">
    <div class="tests">
        <div class="card">
            <div class="card-body">
                @if (Session::has("msg"))
                <div class="alert alert-danger">
                    <h6>{{Session::get("msg")}}</h6>
                </div>
                @endif
                <div class="test-header d-flex">
                    <h3 class="flex-grow-1">Patients</h3>

                </div>
                <hr />
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Pat. ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Reg.</th>
{{--                        <th>Action</th>--}}
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach ($tests as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->patient_id}}</td>
                            <td>{{ $item->first_name}}</td>
                            <td>{{ $item->last_name}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format("d M, Y")}}</td>
                            <td>
                                <a href="{{url("admin/patients/edit/". $item->edit_id)}}"
                                    class="btn btn-success btn-edit">Edit</a>

                            </td>
                        </tr> @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection