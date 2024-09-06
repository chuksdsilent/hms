@extends('partials.layout')
@section('title', 'Dashboard')
@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-bing border-radius">
                        <div class="card-body">
                            <div class="dashboard-item">
                                <a href="{{ url('staff/tests') }}">
                                    <div class="d-flex">
                                        <div>
                                            <img class="img-fluid" src="{{ asset('images/test.png') }}" alt="">
                                        </div>
                                        <div class="dashboard-content">
                                            <div class="item-title">
                                                TEST BILL
                                            </div>
                                            <div class="item-number">
                                                &#8358;{{ number_format(\App\PatientTransactions::whereDate('created_at', \Carbon\Carbon::today())->where('transaction_type', 'tests')->sum('total')) }}
                                            </div>
                                        </div>
                                    </div>

                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-bing border-radius">
                        <div class="card-body">
                            <div class="dashboard-item">
                                <a href="{{ url('staff/drug/bills') }}">
                                    <div class="d-flex">
                                        <div>
                                            <img class="img-fluid" src="{{ asset('images/dressing.png') }}" alt="">
                                        </div>
                                        <div class="dashboard-content">
                                            <div class="item-title">
                                                DRUG BILL
                                            </div>
                                            <div class="item-number">
                                                &#8358;{{ number_format(\App\PatientTransactions::whereDate('created_at', \Carbon\Carbon::today())->where('transaction_type', 'drugs')->sum('total')) }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-bing border-radius">
                        <div class="card-body">
                            <div class="dashboard-item">
                                <a href="{{ url('staff/other-bills') }}">
                                    <div class="d-flex">
                                        <div>
                                            <img class="img-fluid" src="{{ asset('images/bill.png') }}" alt="">
                                        </div>
                                        <div class="dashboard-content">
                                            <div class="item-title">
                                                GENERAL BILL
                                            </div>
                                            <div class="item-number">
                                                &#8358;{{ number_format(\App\PatientTransactions::whereDate('created_at', \Carbon\Carbon::today())->where('transaction_type', 'general_bills')->sum('total')) }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card card-bing border-radius">
                        <div class="card-body">
                            <div class="dashboard-item">
                                <div class="d-flex">
                                    <div>
                                        <img class="img-fluid" src="{{ asset('images/bill.png') }}" alt="">
                                    </div>
                                    <div class="dashboard-content">
                                        <div class="item-title">
                                            REVENUE
                                        </div>
                                        <div class="item-number">
                                            &#8358;{{\App\Payments::whereDate('created_at', \Carbon\Carbon::today())->sum('amount_paid') - \App\Expenses::whereDate('created_at', \Carbon\Carbon::today())->sum("amount") }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-bing border-radius">
                        <div class="card-body">
                            <div class="dashboard-item">
                                <a href="{{ url('staff/patients') }}">
                                    <div class="d-flex">
                                        <div>
                                            <img class="img-fluid" src="{{ asset('images/bill.png') }}" alt="">
                                        </div>
                                        <div class="dashboard-content">
                                            <div class="item-title">
                                                PATIENTS
                                            </div>
                                            <div class="item-number">
                                                {{ number_format(\App\Patients::whereDate('created_at', \Carbon\Carbon::today())->count()) }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-bing border-radius">
                        <div class="card-body">
                            <div class="dashboard-item">
                                <a href="{{ url('staff/expenses') }}">
                                    <div class="d-flex">
                                        <div>
                                            <img class="img-fluid" src="{{ asset('images/bill.png') }}" alt="">
                                        </div>
                                        <div class="dashboard-content">
                                            <div class="item-title">
                                                EXPENSES
                                            </div>
                                            <div class="item-number">
                                                {{ number_format(\App\Expenses::whereDate('created_at', \Carbon\Carbon::today())->sum("amount")) }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script>
        let labels = [];
        let data = [];
        axios.get('http://localhost:8000/api/v1/get-chart-data')
            .then(function(response) {
                // handle success
                console.log(response);
                labels = response.data.test_dates
                data = response.data.prices
                const ctx = document.getElementById('myChart');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Bill Payments',
                            data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,

                            },
                            x: {

                            },

                        },

                    }
                });
            })
    </script>
@endsection
