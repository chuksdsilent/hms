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
                            <th>Created_at</th>
                            <th>Action</th>

                        </thead>
                        <tbody>
                            @foreach ($patientTransactions as $key => $patientTransaction)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \App\Patients::where("id", $patientTransaction->patient->id)->value("patient_id") }}</td>
                                    <td>{{ $patientTransaction->patient->first_name }}</td>
                                    <td>{{ $patientTransaction->patient->last_name }}</td>

                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($patientTransaction->total) }}</td>
                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($patientTransaction->amount_paid) }}</td>
                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($patientTransaction->balance) }}</td>
                                    <td>{{ $patientTransaction->created_at }}</td>
                                    <td>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{$patientTransaction->id}}">
                                            Delete
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$patientTransaction->id}}" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete General Bill</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete the General Bill?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        <a href="{{url("admin/general/delete/". $patientTransaction->id)}}"
                                                           class="btn btn-danger">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
