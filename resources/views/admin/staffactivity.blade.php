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
                    <h3 class="my-auto">Staff Activity</h3>
                </div>
                <hr />
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Activity</th>
                        <th>Date/Time</th>

                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach ($loggedinstaff as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ \App\Staff::where("user_id", $item->staffs_id)->value("first_name") }}</td>
                            <td>{{ \App\Staff::where("user_id", $item->staffs_id)->value("last_name") }}</td>
                            <td>{{ $item->activity }}</td>
                            <td>{{\Carbon\Carbon::parse($item->created_at)->format("d m, Y")}}</td>
                        </tr> @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection