@extends('partials.layout')
@section('title', 'patients')
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
                        <h3 class="my-auto d-flex">
                            <a href="{{ url('/staff/dashboard') }}"><img src="{{ asset('images/arrow.png') }}"
                                    class="me-4 img-fluid" style="height: 30px" alt="Back"></a>
                            <div>Patient Test Transactions</div>
                        </h3>
                        <div class="d-flex justify-content-between">
                            <a href="{{ url('staff/tests/create') }}" class="btn btn-danger">Create New Test</a>
                        </div>

                    </div>
                    <hr />
                    <div class="d-flex justify-content-between mb-4">
                        <div><span class="fw-bold">Cash: </span><span>N {{number_format(\App\PatientTransactions::whereDate('created_at', \Carbon\Carbon::today())->where("payment_type", "cash")->where('transaction_type', 'tests')->sum('total'))}}</span></div>
                        <div><span  class="fw-bold">POS: </span><span></span> {{number_format(\App\PatientTransactions::whereDate('created_at', \Carbon\Carbon::today())->where("payment_type", "pos")->where('transaction_type', 'tests')->sum('total'))}}</div>
                        <div><span  class="fw-bold">Bank Transfer: </span><span></span> {{number_format(\App\PatientTransactions::whereDate('created_at', \Carbon\Carbon::today())->where("payment_type", "bank_transfer")->where('transaction_type', 'tests')->sum('total'))}}</div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <th width="10%">#</th>
                             <th>Patient ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Total</th>
                            <th>Initial Deposit</th>
                            <th>Payment Type</th>
                            <th>Action</th>

                        </thead>
                        <tbody>
                            @foreach ($patient_tests as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{$item->patient->patient_id}}</td>
                                    <td>{{ $item->patient->first_name }}</td>
                                    <td>{{ $item->patient->last_name }}</td>
                                    <td>{{ number_format($item->total) }}</td>
                                    <td>{{ number_format($item->amount_paid) }}</td>
                                    <td>{{ $item->payment_type }}</td>
                                    <td><a href="{{ url('staff/tests/' . $item->id) }}" class="view">View</a>
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
