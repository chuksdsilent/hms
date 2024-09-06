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
                    <h3 class="my-auto">Today's Tests </h3>
                </div>
                <hr />
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Patient's ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Price</th>
                        <th>Action</th>

                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach ($medical as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{\App\Patients::where("id", $item->patients_id)->value("pat_id")}}</td>
                            <td>{{\App\Patients::where("id", $item->patients_id)->value("first_name")}}</td>
                            <td>{{\App\Patients::where("id", $item->patients_id)->value("last_name")}}</td>
                            <td>{{$item->price}}</td>
                            <td> <a href="{{url("admin/test/view/" . $item->trx_id)}}" class="btn btn-primary">View
                                    Test</a> </td>

                        </tr> @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection