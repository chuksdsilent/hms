<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="{{asset("bootstrap/css/bootstrap.css")}}">
<link rel="stylesheet" href="{{asset("bootstrap/css/client.css")}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ASMC</title>
</head>

<body style="background-image:url({{asset('images/staffbg.jpg')}}); object-fit:cover;">

    <div class="top-line"></div>
    <div class="contains my-5">
        <div class="login-container login-content border-radius">
            <div class="row" style="font-size: 16px;">
                <div class="col-md-6">
                    <p>Godfrey Okoye University Teaching Hospital is a world-class comprehensive health care service provider located
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
                <div class="col-md-6">
                    <div class="">
                        @if (Session::has("errmsg"))
                        <h6 style="color: red;">{{Session::get("errmsg")}}</h6>
                        @endif

                        <h2 class="mb-4">Staff</h2>
                        <form action="{{url("staff/login")}}" method="POST">
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
                            <div class="my-3"><input type="submit" value="Login"
                                    class="btn btn-primary btn-block">
                            </div>
                            <div class="my-3">
                                <a href="{{url("/")}}" style="width: 100%;" class="btn btn-danger">Login As Admin</a>
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