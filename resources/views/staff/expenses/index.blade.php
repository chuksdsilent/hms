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
                        <h3 class="my-auto">Expenses</h3>
                        <a href="{{ url('staff/expenses/create') }}" class="btn btn-primary">New Expenses</a>

                    </div>
                    <hr />
                    <table class="table table-striped">
                        <thead>
                            <th width="10%">#</th>
                            <th width="10%">Title</th>
                            <th >Amount</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                          @foreach($expenses as $key => $expense)
                            <tr>
                                <th width="10%">{{ $key + 1 }}</th>
                                <th width="10%">{{$expense->title}}</th>
                                <th >{{$expense->amount}}</th>
                                <th>{{\Carbon\Carbon::parse($expense->created_at)->format("d M, Y")}}</th>
                            </tr>
                          @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
