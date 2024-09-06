@extends('partials.sadmin')
@section('title', 'General Bills')
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
                          
                            <h3>General Bill Transactions</h3>

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
                            <th>Amount Paid</th>
                            <th>Balance</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($patientTransactions as $key => $patientTransaction)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $patientTransaction->patient->id }}</td>
                                    <td>{{ $patientTransaction->patient->first_name }}</td>
                                    <td>{{ $patientTransaction->patient->last_name }}</td>

                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($patientTransaction->total) }}</td>
                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($patientTransaction->amount_paid) }}</td>
                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($patientTransaction->balance) }}</td>
                                    <td>
                                        <a href="{{ url('admin/staff/general-bills/' . $patientTransaction->id) }}"
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
