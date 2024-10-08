@extends('partials.sadmin')
@section('title', 'Revenue')
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
                            <div>Revenue</div>
                        </h3>


                    </div>
                    <table class="table table-striped mt-4">
                        <thead>
                            <th width="10%">#</th>
                            <th>Amount(N)</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($revenues as $key => $revenue)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ number_format($revenue->amount_paid) }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($revenue->created_at)->format('d M, Y') }}
                                    </td>
 <td><a
                                            href="{{ url('admin/revenue/' . $revenue->created_at) }}">View</a>
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
