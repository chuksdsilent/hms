@extends('partials.sadmin')
@section('title', 'Dashboard')
@section('content')
    <style>
        .admin-dashboard .card .card-body p {
            font-size: 25px;
        }

        .col-md-4 .card {
            font-size: 16px !important;
            font-weight: normal !important;
            height: 27.5rem;
        }

    </style>
    <div class="admin-dashboard main-content dashboard">
        <div class="row">
            <div class="col-12 col-md-3">
                <a href="{{ url('admin/patient/tests') }}">
                    <div class="dashboard-item" style="border-left: 2px solid red">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">TEST BILL</div>
                                    <p>
                                        &#8358;{{ number_format(\App\PatientTransactions::where('transaction_type', 'tests')->sum('total')) }}
                                    </p>
                                </div>
                                <div>
                                    <img class="img-fluid" src="{{ asset('images/test.png') }}" alt=""
                                        style="height: 50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-3">
                <a href="{{ url('admin/patient/drugs') }}">

                    <div class="dashboard-item" style="border-left: 2px solid rgb(0, 255, 21)">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">DRUG BILL</div>
                                    <p>
                                        &#8358;{{ number_format(\App\PatientTransactions::where('transaction_type', 'drugs')->sum('total')) }}

                                    </p>
                                </div>
                                <div>
                                    <img class="img-fluid" src="{{ asset('images/dressing.png') }}" alt=""
                                        style="height: 50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-3">
                <a href="{{ url('admin/patient/general') }}">

                    <div class="dashboard-item" style="border-left: 2px solid blue">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">GENERAL BILL</div>
                                    <p>
                                        &#8358;{{ number_format(\App\PatientTransactions::where('transaction_type', 'general_bills')->sum('total')) }}

                                    </p>
                                </div>
                                <div>
                                    <img class="img-fluid" src="{{ asset('images/bill.png') }}" alt=""
                                        style="height: 50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-3">
                <div class="dashboard-item" style="border-left: 2px solid gold">
                    <a href="{{ url('admin/revenue') }}">

                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">REVENUE</div>
                                    <p>
                                        &#8358;{{ number_format(\App\PatientTransactions::sum('amount_paid')) }}

                                    </p>
                                </div>
                                <div>
                                    <img class="img-fluid" src="{{ asset('images/revenue.png') }}" alt=""
                                        style="height: 50px;">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 col-md-3">
                <a href="{{ url('admin/patients') }}">

                    <div class="dashboard-item" style="border-left: 2px solid rgb(0, 255, 21)">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">PATIENTS</div>
                                    <p>
                                        {{ number_format(\App\Patients::count()) }}

                                    </p>
                                </div>
                                <div>
                                    <img class="img-fluid" src="{{ asset('images/examination.png') }}" alt=""
                                        style="height: 50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-3">
                <a href="{{ url('admin/debts') }}">
                    <div class="dashboard-item" style="border-left: 2px solid blue">

                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">DEBTS</div>
                                    <p>
                                        &#8358;{{ number_format(\App\PatientTransactions::where('balance', '>', 0)->sum('balance')) }}
                                    </p>
                                </div>
                                <div>
                                    <img class="img-fluid" src="{{ asset('images/borrow.png') }}" alt=""
                                        style="height: 50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-3">
                <a href="{{ url('admin/staff') }}">
                    <div class="dashboard-item" style="border-left: 2px solid gold">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">STAFFS</div>
                                    <p>
                                        {{ \App\Staff::count() }}
                                    </p>
                                </div>
                                <div>
                                    <img class="img-fluid" src="{{ asset('images/teamwork.png') }}" alt=""
                                        style="height: 50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-3">
                <a href="{{ url('admin/tests') }}">
                    <div class="dashboard-item" style="border-left: 2px solid red">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title">TESTS</div>
                                    <p>
                                        {{ number_format(\App\Tests::count()) }}
                                    </p>
                                </div>
                                <div>
                                    <img class="img-fluid" src="{{ asset('images/test.png') }}" alt=""
                                        style="height: 50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h6>This month Transactions</h6>
                        <hr class="my-4">
                        <span id="loading">loading...</span>
                        <canvas id="myChart">
                        </canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Today's Transactions</h5>
                        <hr />
                        <div class="d-flex justify-content-between mb-3">
                            <div class="fw-bold"><a href="{{ url('admin/today/tests') }}">TESTS</a></div>
                            <div class="badge bg-primary">
                                &#8358;{{ number_format(\App\PatientTransactions::whereDate('created_at', \Carbon\Carbon::today())->where('transaction_type', 'tests')->sum('total')) }}

                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="fw-bold"><a href="{{ url('admin/today/drugs') }}">DRUGS</a></div>
                            <div class="badge bg-danger">
                                &#8358;{{ number_format(\App\PatientTransactions::whereDate('created_at', \Carbon\Carbon::today())->where('transaction_type', 'drugs')->sum('total')) }}

                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="fw-bold"><a href="{{ url('admin/today/general') }}">GENERAL</a></div>
                            <div class="badge bg-warning">
                                &#8358;{{ number_format(\App\PatientTransactions::whereDate('created_at', \Carbon\Carbon::today())->where('transaction_type', 'general_bills')->sum('total')) }}

                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="fw-bold">REVENUE</div>
                            <div class="badge bg-success">
                                &#8358;{{ \App\Payments::whereDate('created_at', \Carbon\Carbon::today())->sum('amount_paid') }}

                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="fw-bold"><a href="{{ url('admin/today/patients') }}">PATIENTS</a></div>
                            <div class="badge bg-info">
                                {{ number_format(\App\Patients::whereDate('created_at', \Carbon\Carbon::today())->count()) }}

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
        axios.get('/api/v1/get-chart-data')
            .then(function(response) {
                // handle success
                document.getElementById("loading").style.display = "none";
                console.log(response.data.transaction_date);
                labels = response.data.transaction_date
                data = response.data.total_amount_paid
                const ctx = document.getElementById('myChart');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Revenue',
                            data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 100, 64, 0.2)',
                                'rgba(25, 100, 64, 0.2)',
                                'rgba(75, 100, 64, 0.2)',
                                'rgba(15, 100, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 100, 64, 1)',
                                'rgba(25, 100, 64, 1)',
                                'rgba(75, 100, 64, 1)',
                                'rgba(15, 100, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: false
                                }

                            },
                            x: {
                                grid: {
                                    display: false
                                }

                            },

                        },

                    }
                });
            })
    </script>
@endsection
