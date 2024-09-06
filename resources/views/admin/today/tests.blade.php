@extends('partials.sadmin')
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
                            <div>Patient Test Transactions</div>
                        </h3>
                        

                    </div>
                    <table class="table table-striped mt-4">
                        <thead>
                            <th width="10%">#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Total</th>
                            <th>Deposits</th>
                            <th>Action</th>

                        </thead>
                        <tbody>
                            @foreach ($patient_tests as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->patient->first_name }}</td>
                                    <td>{{ $item->patient->last_name }}</td>
                                    <td>{{ number_format($item->total) }}</td>
                                    <td>{{ number_format($item->amount_paid) }}</td>
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
