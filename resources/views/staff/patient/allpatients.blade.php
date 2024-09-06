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
                        <h3 class="my-auto">Patients</h3>
                        <a href="{{ url('staff/patient/create') }}" class="btn btn-primary">Create New Patient</a>

                    </div>
                    <hr />
                    <table class="table table-striped">
                        <thead>
                            <th width="10%">#</th>
                            <th width="10%">Patient ID</th>
                            <th >First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            
                        </thead>
                        <tbody>
                            @foreach ($patients as $key => $patient)
                                <tr>
                                    <td>{{ $key + 1}}</td>
                                    <td>{{ $patient->patient_id}}</td>
                                    <td>{{ $patient->first_name}}</td>
                                    <td>{{ $patient->last_name}}</td>
                                    <td>{{ $patient->gender}}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
