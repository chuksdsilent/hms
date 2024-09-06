@extends('partials.client')
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
                    <h3 class="my-auto">All Tests </h3>
                </div>
                <hr />
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Patient's ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Action</th>

                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach ($medical as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->patients->pat_id}}</td>
                            <td>{{$item->patients->first_name}}</td>
                            <td>{{$item->patients->last_name}}</td>
                            <td>{{$item->patients->phone}}</td>
                            <td> <a href="{{url("staff/test/view/" . $item->trx_id)}}" class="btn btn-primary">View
                                    Test</a> </td>

                        </tr> @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection