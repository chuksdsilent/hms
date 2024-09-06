@extends('partials.client')
@section('title', 'All Test')
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
                    <h3 class="flex-grow-1">Tests</h3>
                    <a href="{{url("staff/patient/create")}}" class="btn btn-primary">Create New Patient Test</a>

                </div>
                <hr />
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Pat ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Phone</th>
                        <th>Referred By</th>
                        <th>Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach ($medical as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{\App\Patients::where('id', $item->patients_id)->value('pat_id')}}</td>
                            <td>{{ \App\Patients::where('id', $item->patients_id)->value('first_name')}}</td>
                            <td>{{ \App\Patients::where('id', $item->patients_id)->value('last_name')}}</td>
                            <td>{{ \Carbon\Carbon::parse(\App\Patients::where('id', $item->patients_id)->value('age'))->format("d M, Y")}}
                            </td>
                            <td>{{ \App\Patients::where('id', $item->patients_id)->value('phone')}}</td>
                            <td><a href="{{url('staff/dr-referrals/'. \App\Referrals::where('id', $item->referred_by)->value('id')  )}}">{{\App\Referrals::where("id", $item->referred_by)->value("name")}}</a></td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format("d M, Y")}}</td>
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