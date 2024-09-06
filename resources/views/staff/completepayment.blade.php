@extends('partials.client')
@section('title', 'All Test')
@section('content')
<div class="custom my-4">
    <div class="tests">
        <div class="card">
            @if(Session::has("msg"))
                <div class="alert alert-success">{{Session::get("msg")}}</div>
            @endif
            <div class="card-body">
            <h3>Complete Patient Payment</h3>
            <hr />
            <form action="{{url('staff/complete-payment')}}" method="post">
                @csrf
                <input type="hidden" value="{{$id}}" name="pat_id">
                <div class="form-group mb-2"><input type="hidden" name="trx_id" value="{{$trx_id}}" class="form-control"></div>
                <div class="form-group mb-3"><label for="" class="mb-2">Amount</label><input type="text" name="amount" class="form-control"></div>
                <div class="form-group"><input type="submit" class="btn btn-primary" value="Submit"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection