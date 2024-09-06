@extends('partials.layout')
@section('title', 'Patient Details')
@section('content')
<div class="card custom">
    <div class="card-body">
        <h3>{{$patient->first_name}}'s Profile</h3>
        <hr />
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>First Name</h5>
                <span>{{$patient->first_name}}</span>
            </div>
            <div class="col-md-6">
                <h5>Last Name</h5>
                <span>{{$patient->last_name}}</span>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Patient ID</h5>
                <span>{{$patient->patient_id}}</span>
            </div>
            <div class="col-md-6">
                <h5>Gender</h5>
                <span>{{($patient->gender == "F") ? "Female" : "Male"}}</span>
            </div>
        </div>
       
    </div>
    <div class="p-3 d-flex justify-content-end">
        <a href="{{url("/staff/dashboard")}}" class="btn btn-primary rounded-pill">Continue -></a>
    </div>
</div>
@endsection