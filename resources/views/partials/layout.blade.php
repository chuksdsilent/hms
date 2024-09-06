<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/client.css') }}">
    <link rel="stylesheet" href="{{ asset('libraries/datatables/DataTables-1.10.23/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>@yield('title')</title>
    <style>
        .slide-in {
            position: absolute;
            left: -500px;
            width: 200px;
            height: 100vh;
            background: blue;
            -webkit-animation: slideIn 1s forwards;
            animation: slideIn 1s forwards;
            z-index: 1000;
        }

        @-webkit-keyframes slideIn {
            100% {
                left: 0;
            }
        }


        @media only screen and (max-width: 600px) {
            .out {
                position: absolute;
                left: -500px;
            }

             .col-md-10{
                padding: 0px;
            }

            .main-content .card{
                margin-bottom: .5rem;
            }
            .dashboard-item .card {
                margin-bottom: 10px;
            }
        }

        @keyframes slideIn {
            100% {
                left: 0;
            }
        }

        .slide-out {
            position: absolute;
            left: 0px;
            width: 200px;
            height: 100vh;
            background: blue;
            -webkit-animation: slideOut 2s forwards;
            animation: slideOut 2s forwards;
            z-index: 1000;
        }

        @-webkit-keyframes slideOut {
            100% {
                left: -500px;
            }
        }

        @keyframes slideOut {
            100% {
                left: -500px;
            }
        }

        .dropdown-container {
            display: block;
            line-height: 0;
            height: 0;
            overflow: hidden;
        }

        .dropdown-btn {
            background: none;
            border: 0px;
            color: white;
            padding: .8rem 1rem;
            cursor: pointer;
        }

        .dropdown-btn:hover {
            color: rgb(208, 206, 206);
            text-decoration: none;
            display: block;
            padding: .8rem 1rem;
            background-color: #1a4f68;
            cursor: pointer;
        }

        .bg-light {
            background: #144962 !important;
            color: white;
        }

        .navbar-brand {
            color: white !important;
        }

        i {
            margin-right: .5rem;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Godfrey Okoye University Teaching Hospital</a>
            <button class="navbar-toggler" type="button" id="nav-btn" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <form class="d-flex">
                    {{-- <img src="{{asset('icons/profile.png')}}" style=" margin-right: 5px; width: 30px; height:
                    30px;"
                    alt=""> --}}
                    <span class="mx-1">
                        {{ \App\Staff::where('user_id', Auth::user()->id)->value('first_name') }} </span>
                    <span class="mx-1">
                        {{ \App\Staff::where('user_id', Auth::user()->id)->value('last_name') }} </span>
                </form>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-2 out" id="side-nav">
            <div class="side-bar">

                <ul>
                    <li><a href="{{ url('staff/dashboard') }}"><i class="bi bi-rainbow"></i> Dashboard</a></li>
                    {{-- <li><a href="{{url("staff/patient/search")}}">Search</a></li> --}}

                    <li>
                        <div class="dropdown-btn d-flex justify-content-between">
                            <div class="d-flex">
                                <i class="bi bi-person"></i>
                                <span> Patient </span>

                            </div>
                            <i class="bi bi-caret-down-fill"></i>
                        </div>

                        <div class="dropdown-container">
                            <a href="{{ url('staff/patient/create') }}">
                                <i class="bi bi-person"></i> New Patient
                            </a>
                            <a href="{{ url('staff/patients') }}">
                                <i class="bi bi-people"></i> Patients
                            </a>
                        </div>
                    </li>

                    <li>
                        <div class="dropdown-btn d-flex justify-content-between">
                            <div class="d-flex">
                                <i class="bi bi-app-indicator"></i>
                                <span> Tests </span>
                            </div>
                            <i class="bi bi-caret-down-fill"></i>
                        </div>

                        <div class="dropdown-container">
                            <a href="{{ url('staff/tests/create') }}">
                                <i class="bi bi-segmented-nav"></i> New Test
                            </a>
                            <a href="{{ url('staff/tests') }}">
                                <i class="bi bi-app"></i> All Tests
                            </a>
                        </div>
                    </li>
                    <li>
                        <a href="{{ url('/staff/drug-payment/create') }}">
                            <i class="bi bi-bounding-box"></i>
                            Drugs
                        </a>

                    </li>
                    <li>
                        <a href="{{ url('staff/other-bill-payment') }}">
                            <i class="bi bi-receipt"></i>
                            Bills
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-btn d-flex justify-content-between">
                            <div class="d-flex">
                                <i class="bi bi-person"></i>
                                <span> Patient Trxs </span>

                            </div>
                            <i class="bi bi-caret-down-fill"></i>
                        </div>

                        <div class="dropdown-container">
                            <a href="{{ url('staff/patient/payments') }}">
                                <i class="bi bi-credit-card"></i> Patient Payments
                            </a>
                            <a href="{{ url('staff/patient/debts') }}">
                                <i class="bi bi-people"></i> Patient Debts
                            </a>
                        </div>
                    </li>

                    <li><a href="{{ url('staff/password/change') }}"><i class="bi bi-file-lock-fill"></i> Change
                            Password</a></li>
                    <li><a href="{{ url('/staff/login') }}"><i class="bi bi-power"></i> Logout</a></li>

                </ul>
            </div>
        </div>
        <div class="col-md-10">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('bootstrap/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/axios.js') }}"></script>

    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.height === "90px") {
                    dropdownContent.style.height = "0px";
                } else {
                    dropdownContent.style.height = "90px";
                    dropdownContent.style.transition = "all .5s ease-in-out";
                }
            });
        }

        const patient = $("#patientid");
        const loading = $("#loadings");
        const patient_details = $("#patient-details");
        $(patient).on("keyup", function() {
            console.log("patient id is ", patient.val());
            const patientid = patient.val();
            const patient_id_length = patientid.length;
         
                patient_details.addClass("hide");
                loading.text("loading patient details...");
                loading.removeClass("hide");
                axios.get('/api/v1/get-patient-details/' + patientid)
                    .then(function(response) {
                        loading.addClass("hide");
                        patient_details.removeClass("hide");
                        $("#first_name").text(response.data[0].first_name)
                        $("#last_name").text(response.data[0].last_name)
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    })
           
        })


        let isSidebarOpen = false;

        const element = document.getElementById("nav-btn");
        const sidenav = document.getElementById("side-nav");

        element.addEventListener("click", function() {
            isSidebarOpen = !isSidebarOpen;

            if (isSidebarOpen) {
                sidenav.classList.add("slide-in");
                sidenav.classList.remove("slide-out");
            } else {
                sidenav.classList.add("slide-out");
                sidenav.classList.remove("out");
                sidenav.classList.remove("slide-in");
            }
            console.log(isSidebarOpen);
            console.log("button clicked");
        });
    </script>

    <script src="{{ asset('libraries/datatables/DataTables-1.10.23/js/jquery.dataTables.js') }}"></script>
    <script>
        $("table").DataTable();
    </script>

    @stack('scripts')
</body>

</html>
