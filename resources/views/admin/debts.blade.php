@extends('partials.sadmin')
@section('title', 'Dashboard')
@section('content')

<div class="  my-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
            <h2>Debts</h2>
            <h6 class="mt-3 me-4">Total : {!! \App\Settings::where("id", 1)->value("money_sign") !!}{{number_format(\App\patientTransactions::where("balance", ">", 0)->sum("balance"))}}</h6>
            
            </div>
            <hr>
            @if(Session::has("msg")) <div class="alert alert-danger">{{\Illuminate\Support\Facades\Session::get("msg")}}</div> @endif
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Pat. ID</th>
                    <th>Trx ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Balance</th>
                    <th>Date</th> 
                    <th>Action</th>
                </thead>
            @foreach($debts as $key => $debt)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$debt->patient->patient_id}}</td>
                <td>{{$debt->id}}</td>
                <td>{{$debt->patient->first_name}}</td>
                <td>{{$debt->patient->last_name}}</td>
                <td style="color: red;">{!! \App\Settings::where("id", 1)->value("money_sign") !!}{{number_format($debt->balance)}}</td>
                <td>{{Carbon\Carbon::parse($debt->created_at)->format("d F, Y")}}</td> 
                <td><a href="{{url("admin/debt/delete/" . $debt->id)}}" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
            </table>

        </div>
    </div>
</div>
@endsection
