@extends('partials.layout')
@section('title', 'Search Patient')
@section('content')
    <form action="{{ url('staff/patient/debts/search') }}" method="POST">
        @csrf
        <div class="card" style="margin: 0 auto; width: 50%;">
            <div class="card-body">
                <h4>Patient ID</h4>
                <hr />
                <input type="text" name="patient_id" class="form-control mb-3" placeholder="Enter Patient ID">
                @if ($errors->has('patient_id'))
                    <span class="error">{{ $errors->first('patient_id') }}</span>
                @endif
                <button type="submit" class="btn btn-primary">
                    Search
                </button>
            </div>
        </div>
    </form>
@endsection
