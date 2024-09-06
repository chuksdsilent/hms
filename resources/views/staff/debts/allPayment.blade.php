@extends('partials.layout')
@section('title', 'All Payment')
@section('content')
    <form action="{{ url('staff/patient/debts/search') }}" method="post">
        @csrf
        <div class="card">
            @if (Session::has('msg'))
                <div class="alert alert-success m-4">{{ Session::get('msg') }}</div>
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4>All Payments</h4>
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
                            <span class="test-amount-paid">{{ $patient->patient_id }}</span>
                        </h6>
                    </div>

                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Amount Paid</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    @foreach ($payments as $key => $payment)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $payment->amount_paid }}</td>
                            <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d M, Y') }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </form>
@endsection
