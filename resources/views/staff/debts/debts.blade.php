@extends('partials.layout')
@section('title', 'Debts')
@section('content')
    <form action="{{ url('staff/patient/debts/search') }}" method="post">
        @csrf
        <div class="card">
            @if (Session::has('msg'))
                <div class="alert alert-success m-4">{{ Session::get('msg') }}</div>
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4>Debts</h4>
                    <!-- Button trigger modal -->

                </div>
                <hr />
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <h6 class="p-2">
                            <span>Name</span>
                            <span class="test-total">{{ $patient->first_name }} {{ $patient->last_name }}</span>
                        </h6>
                        <h6 class="p-2">
                            <span>Patient ID</span>
                            <span class="test-amount-paid">{{ $patient_id }}</span>
                        </h6>
                    </div>

                    <h6 class="p-2">
                        <span>Total</span>
                        <span
                            class="test-balance">{{ \App\PatientTransactions::where('patient_id', $patient_id)->sum('balance') }}</span>
                    </h6>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Total</th>
                            <th>Amount Paid</th>
                            <th>Balance</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($debts as $key => $debt)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ number_format($debt->total) }}</td>
                            <td>{{ number_format(\App\Payments::where("trx_id", $debt->id)->sum("amount_paid")) }}</td>
                            <td>{{ number_format($debt->total - $debt->amount_paid)}}</td>
                            <td>{{ \Carbon\Carbon::parse($debt->created_at)->format('d M, Y') }}</td>
                            <td>
                                <a href="{{url("staff/patient/payment/new/". $debt->id)}}" class="edit">Make Payment</a>
                              
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </form>
@endsection
