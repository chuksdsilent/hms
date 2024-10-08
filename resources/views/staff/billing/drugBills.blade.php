@extends('partials.layout')
@section('title', 'Drug Bills')
@section('content')
    <div class="my-4">
        <div class="tests">
            <div class="card">
                <div class="card-body">
                    @if (Session::has('msg'))
                        <div class="alert alert-success">
                            <h6>{{ Session::get('msg') }}</h6>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between">
                        <div class="my-auto d-flex">
                            <a href="{{ url('staff/dashboard') }}"><img src="{{ asset('images/arrow.png') }}"
                                    class="me-4 img-fluid" style="height: 30px" alt="Back"></a>
                            <h3>Drugs Transactions</h3>

                        </div>
                     
                    </div>
                    <hr />
                    
                    <div class="d-flex justify-content-between mb-4">
                        <div><span class="fw-bold">Cash: </span><span>N {{number_format(\App\PatientTransactions::whereDate('created_at', \Carbon\Carbon::today())->where("payment_type", "cash")->where('transaction_type', 'drugs')->sum('total'))}}</span></div>
                        <div><span  class="fw-bold">POS: </span><span></span> {{number_format(\App\PatientTransactions::whereDate('created_at', \Carbon\Carbon::today())->where("payment_type", "pos")->where('transaction_type', 'drugs')->sum('total'))}}</div>
                        <div><span  class="fw-bold">Bank Transfer: </span><span></span> {{number_format(\App\PatientTransactions::whereDate('created_at', \Carbon\Carbon::today())->where("payment_type", "bank_transfer")->where('transaction_type', 'drugs')->sum('total'))}}</div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <th width="10%">#</th>
                            <th>Patient ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Total</th>
                            <th>Initial Deposit</th>
                            <th>Balance</th>
                            <th>Payment Type</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($drugTransactions as $key => $drugTransaction)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $drugTransaction->patient->patient_id }}</td>
                                    <td>{{ $drugTransaction->patient->first_name }}</td>
                                    <td>{{ $drugTransaction->patient->last_name }}</td>

                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($drugTransaction->total) }}</td>
                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($drugTransaction->amount_paid) }}</td>
                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($drugTransaction->balance) }}</td>
                                    <td>{{ $drugTransaction->payment_type}}</td>
                                    <td>
                                        <a href="{{ url('staff/receipt/drug/' . $drugTransaction->id) }}"
                                            class="view">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
