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
                            <th>Deposits</th>
                            <th>Balance</th>
                            <th>Date</th>
                            <th>Action</th>

                        </thead>
                        <tbody>
                            @foreach ($drugTransactions as $key => $drugTransaction)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \App\Patients::where("id", $drugTransaction->patient_id)->value("patient_id") }}</td>
                                    <td>{{ \App\Patients::where('id', $drugTransaction->patient_id)->value('first_name') }}</td>
                                    <td>{{ \App\Patients::where('id', $drugTransaction->patient_id)->value('last_name') }}</td>

                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($drugTransaction->total) }}</td>
                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($drugTransaction->amount_paid) }}</td>
                                    <td>{!! \App\Settings::where('id', '1')->value('money_sign') !!}{{ number_format($drugTransaction->balance) }}</td>
                                    <td>{{ $drugTransaction->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{$drugTransaction->id}}">
                                            Delete
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$drugTransaction->id}}" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Drug</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete the Drug?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        <a href="{{url("admin/drug/delete/". $drugTransaction->id)}}"
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
