@extends('partials.sadmin')
@section('title', 'Dashboard')
@section('content')

<div class="  my-4">
    <div class="card table">
        <div class="card-body">
            <div class="d-flex justify-content-between">
            <h2>Payments</h2>
            <h6 class="mt-3 me-4">Total : {!! \App\Settings::where("id", 1)->value("money_sign") !!}{{number_format(\App\Payments::sum("amount_paid"))}}</h6>
            
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
            @foreach($payments as $key => $payment)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$payment->patient_id}}</td>
                <td>{{$payment->id}}</td>
                <td>{{$payment->patient->first_name}}</td>
                <td>{{$payment->patient->last_name}}</td>
                <td style="color: green;">{!! \App\Settings::where("id", 1)->value("money_sign") !!}{{number_format($payment->amount_paid)}}</td>

                <td>{{Carbon\Carbon::parse($payment->created_at)->format("d F, Y")}}</td>                
            </tr>
            @endforeach
            </table>

        </div>
    </div>
</div>
@endsection
