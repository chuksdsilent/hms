@extends('partials.layout')
@section('title', 'Patient Test Details')
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
                                <a href="{{url("staff/tests")}}"><img src="{{ asset("images/arrow.png") }}" class="me-4 img-fluid" style="height: 30px" alt="Back"></a>
                                <div>Patient Test Details</div>
                        </h3>
                        <div class="d-flex justify-content-between">

                            <a href="{{ url('staff/tests/create') }}" class="btn btn-danger">Create New Test</a>
                        </div>

                    </div>
                    <hr />
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <h6 class="font-weight-bold me-3">Name: {{ $patient_details->first_name }}
                                {{ $patient_details->last_name }}</h6>
                            <h6 class="text-bold test-date">Date:
                                {{ \Carbon\Carbon::parse($patient_details->created_at)->format('d M, Y') }}</h6>
                        </div>
                        <div class="mb-2">
                            <span>Total: </span>
                            <span class="me-4 test-total">{!! \App\Settings::where('id', '1')->value('money_sign') !!}
                                {{ number_format(\App\PatientTransactions::where('id', $id)->value('total')) }}</span>
                            <span>Amount Paid: </span>
                            <span class="me-4 test-amount-paid">{!! \App\Settings::where('id', '1')->value('money_sign') !!}
                                {{ number_format(\App\PatientTransactions::where('id', $id)->value('amount_paid')) }}</span>
                            <span>Balance: </span>
                            <span class="me-4 test-balance">{!! \App\Settings::where('id', '1')->value('money_sign') !!}
                                {{ number_format(\App\PatientTransactions::where('id', $id)->value('balance')) }}</span>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <th width="10%">#</th>
                            <th>Test Name</th>
                            <th>Test Price</th>
                            <th>Payment Type</th>
                        </thead>
                        <tbody>
                            @foreach ($patient_tests as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->test_price }}</td>
                                    <td>{{ $item->payment_type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
