@extends('partials.layout')
@section('title', 'Debts')
@section('content')
    <style>
        .img {
            height: 200px;
        }

        div.content {
            font-size: 2.5rem;
        }
        .arrow{
            height: 30px;
        }
    </style>
    <div class="card">
        <div class="card-body py-4">
            <div class="d-flex justify-content-center mb-4">
                <img src="{{ asset('images/checked.png') }}" class="img img-fluid" alt="">
        
            </div>
            <div class="content text-center">
                Payment made succesfully...
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{url("staff/patient/debts")}}" class="btn btn-warning rounded-pill"> <img src="{{asset("images/arrow.png")}}" class="arrow img-fluid me-2"><span>Back</span></a>
                <a href="{{url("staff/dashboard")}}" class="btn btn-primary rounded-pill">Continue <img src="{{asset("images/rightarrow.png")}}" class="arrow img-fluid"></a>
            </div>

        </div>
    </div>
@endsection
