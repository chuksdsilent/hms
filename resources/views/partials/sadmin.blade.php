<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('libraries/datatables/DataTables-1.10.23/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
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
            .dashboard-item .card{
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">

            <a class="navbar-brand" href="#">Godfrey Okoye University Teaching Hospital</a>
            <button class="navbar-toggler" type="button" id="nav-btn" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="color: white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <form class="d-flex">
                    <img src="{{ asset('icons/profile.png') }}" style=" margin-right: 5px; width: 30px; height: 30px;"
                        alt="">
                    <span>Admin</span>
                </form>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-2 out" id="side-nav">
            <div class="side-bar">
                <img src="{{ asset('icons/dashbord.svg') }}" style="font-size: 50px;" alt="">
                <ul>
                    <li><a href="{{ url('admin/dashboard') }}"> <i class="bi bi-rainbow"></i> Dashboard</a></li>
                    {{-- <li><a href="{{url('admin/referrals')}}"><i class="bi bi-puzzle-fill"></i> Referrals</a></li>
                    <li><a href="{{url('admin/department')}}"><i class="bi bi-puzzle-fill"></i> Department</a></li> --}}
                    <li><a href="{{ url('admin/tests') }}"><i class="bi bi-x-diamond-fill"></i> Tests</a></li>
                    <li>
                        <div class="dropdown-btn d-flex justify-content-between">
                            <div class="d-flex">
                                <i class="bi bi-person"></i>
                                <span> Transaction Bills </span>

                            </div>
                            <i class="bi bi-caret-down-fill"></i>
                        </div>

                        <div class="dropdown-container">
                            <a href="{{ url('admin/patient/tests') }}">
                                <i class="bi bi-credit-card"></i> Test
                            </a>
                            <a href="{{ url('admin/patient/drugs') }}">
                                <i class="bi bi-people"></i> Drugs
                            </a>
                            <a href="{{ url('admin/patient/general') }}">
                                <i class="bi bi-people"></i> General
                            </a>
                        </div>
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
                            <a href="{{ url('admin/payments') }}">
                                <i class="bi bi-credit-card"></i> Payments
                            </a>
                            <a href="{{ url('admin/debts') }}">
                                <i class="bi bi-people"></i> Debts
                            </a>
                        </div>
                    </li>
                    <li><a href="{{ url('admin/general-bill') }}"><i class="bi bi-person"></i> General Bill</a>
                    <li><a href="{{ url('admin/expenses') }}"><i class="bi bi-person"></i> Expenses</a>
                    </li>
                    <li><a href="{{ url('admin/patients') }}"><i class="bi bi-person"></i> Patients</a></li>
                    <li><a href="{{ url('admin/staff') }}"><i class="bi bi-person-fill"></i> Staff</a></li>
                    {{-- <li><a href="{{ url('admin/search') }}"><i class="bi bi-search"></i> Search</a></li> --}}
                    {{-- <li><a href="{{url('admin/branches')}}"><i class="bi bi-dice-5-fill"></i> Branches</a></li> --}}
                    <li><a href="{{ url('admin/password/change') }}"><i class="bi bi-file-lock-fill"></i> Change
                            Password</a></li>
                    {{-- <li><a href="{{ url('admin/backups') }}"><i class="bi bi-file-lock-fill"></i> Backup</a></li> --}}
                    <li><a href="{{ url('/') }}"><i class="bi bi-power"></i> Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('bootstrap/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
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
</body>

</html>
