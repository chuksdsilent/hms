@extends('partials.sadmin')
@section('title', 'Dashboard')
@section('content')

<div class="  my-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
            <h2>Completed Payment</h2>
            
            </div>
            <hr>

            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Pat. ID</th>
                    <th>Trx ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Amount Paid</th>
                    <th>Date</th> 
                    
                </thead>
            @foreach($debts as $key => $debt)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$debt->pat_id}}</td>
                <td>{{$debt->trx_id}}</td>
                <td>{{\App\Patients::where("pat_id", $debt->pat_id)->value("first_name")}}</td>
                <td>{{\App\Patients::where("pat_id", $debt->pat_id)->value("last_name")}}</td>
                <td style="color: red;">N{{\App\Medicals::where("trx_id", $debt->trx_id)->sum("price") - $debt->amount_paid}}</td>

                <td>{{Carbon\Carbon::parse($debt->updated_at)->format("d F, Y")}}</td>
                
                
                
            </tr>
            @endforeach
            </table>

        </div>
    </div>
</div>
@endsection
