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
                    <h3 class="my-auto">Overall Patients</h3>
                </div>
                <hr />
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Patient's ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Date of Birth</th>

                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach ($todaypatient as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->pat_id}}</td>
                            <td>{{$item->first_name}}</td>
                            <td>{{$item->last_name}}</td>
                            <td>{{($item->gender == "F") ? "Female" : "Male" }}</td>
                            <td>{{ $item->phone}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->age)->format("d M, Y")}}</td>

                        </tr> @endforeach </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection