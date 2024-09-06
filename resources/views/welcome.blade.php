<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="{{asset("bootstrap/css/bootstrap.css")}}">
<link rel="stylesheet" href="{{asset("bootstrap/css/custom.css")}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NDC</title>
</head>

<body style="background-image:url({{asset('images/adminloginbg.jpg')}}); object-fit:cover;">

    <div class="top-line"></div>
    <div class="contains">
        <div class="login-container login-content mt-5" style="color: white;">
            <div class="row" style="font-size: 16px; margin-top: 2rem;">
                <div class="col-md-6">
                    <div class="left-panel">
                        <p> Godfrey Okoye University Teaching Hospital is a world-class comprehensive health care service provider located
                            in
                            Enugu Nigeria. We aim to
                            bridge the gap between patients and healthcare services in any setting. All of our clinics
                            are
                            equipped with the latest
                            healthcare technologies, and the most dedicated team of healthcare professionals, providing
                            a
                            unique range of
                            patient-centric services.

                        </p>
                        <p>
                            We provide a comprehensive range of tests necessary to diagnose and treat medical problems.
                            Our laboratory service plays
                            an essential role in the quality and safety of patient care by providing accurate diagnostic
                            and treatment information.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class=" border-radius">
                        @if (Session::has("errmsg"))
                        <h6 style="color: red;">{{Session::get("errmsg")}}</h6>
                        @endif

                        <h2 class="mb-4">Admin</h2>
                        <form action="{{url("admin/login")}}" method="POST">
                            @csrf
                            <div class="my-3">
                                <label for="" class="form-label">Username</label>
                                <input type="text" name="email" class="form-control">
                                @if ($errors->first("email"))
                                <span>{{$errors->first("email")}}</span>
                                @endif
                            </div>
                            <div class="my-3">
                                <label for="" class="form-label"> Password</label>
                                <input type="password" name="password" class="form-control">
                                @if ($errors->first("password"))
                                <span>{{$errors->first("password")}}</span>
                                @endif
                            </div>
                            <div class="my-3"><input type="submit" value="Login As Admin" class="btn btn-primary">
                            </div>
                            <div class="my-3"><a href="{{url('staff/login')}}" class="btn btn-block btn-danger">Login As
                                    Staff</a>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="{{asset("bootstrap/jquery-3.4.1.min.js")}}"></script>
    <script src="{{asset("bootstrap/bootstrap.min.js")}}"></script>
</body>

</html>