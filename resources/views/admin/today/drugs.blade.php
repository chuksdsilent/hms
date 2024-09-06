@extends('partials.sadmin')
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
                          
                            <h3>Drugs Transactions</h3>

                        </div>
                     
                    </div>
                    <hr />
                    <table class="table table-striped">
                        <thead>
                            <th width="10%">#</th>
                            <th>Patient ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Total</th>
                            <th>Initial Deposit</th>
                            <th>Balance</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($drugTransactions as $key => $drugTransaction)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $drugTransaction->patient->id }}</td>
                                    <td>{{ $drugTransaction->patient->first_name }}</td>
                                    <td>{{ $drugTransaction->patient->last_name }}</td>

                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($drugTransaction->total) }}</td>
                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($drugTransaction->amount_paid) }}</td>
                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($drugTransaction->balance) }}</td>
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
