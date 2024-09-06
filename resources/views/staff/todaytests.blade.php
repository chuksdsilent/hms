@extends('partials.client')
@section('title', 'Today Test')
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
                        <th>Phone</th>
                        <th>Price</th>
                        <th>Referral By</th>
                        <th>Payment Type</th>
                        
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
                            <td>N{{\App\Medicals::where("trx_id",$item->trx_id)->sum("price")}}</td>
                            <td><a href="{{url('staff/dr-referrals/'. \App\Referrals::where('id', $item->referred_by)->value('id')  )}}">{{\App\Referrals::where("id", $item->referred_by)->value("name")}}</a></td>
                            <td>{{$item->paymentType}}</td>
                            <td> <a href="{{url("staff/test/view/" . $item->trx_id)}}" class="btn btn-primary">View
                                    Test</a> </td>

                        </tr> @endforeach
                        
                        <tr>
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>N{{ \App\Medicals::where("created_at", \Carbon\Carbon::today()->format("Y-m-d"))->sum("price")}}</td>
                            <td> </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection