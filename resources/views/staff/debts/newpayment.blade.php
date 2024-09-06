@extends('partials.layout')
@section('title', 'New Payment')
@section('content')
    <form action="{{ url('staff/patient/payment') }}" method="POST">
        @csrf
        <div class="card" style="margin: 0 auto; width: 50%;">
            <div class="card-body">
                <h4>Amount</h4>
                <hr />
                <input type="hidden" name="trx_id" value="{{$data->id}}">
                <input type="hidden" name="patient_id" value="{{$data->patient_id}}">
                <input type="text" name="amount_paid" class="form-control mb-3" placeholder="Enter Amount">
                @if ($errors->has('amount_paid'))
                <span class="error">{{ $errors->first('amount_paid') }}</span>
            @endif
                <button type="submit" class="btn btn-primary" >
                    Submit
                </button>
            </div>
        </div>
    </form>
@endsection
