@extends('partials.client')
@section('title', 'Patient Bill Payment')
@section('content')
    <form action="{{ url('patient/bill-payment') }}" method="post">
        <div class="card" style="margin: 0 auto; width: 50%;">
            <div class="card-body">
                <h4>Patient Bill Payments</h4>
                <hr />
                <div class="bill-content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12 col-xs-12">
                            <section class="mb-3">
                                <div class="form-group mb-2">
                                    <label for="Patient ID" class="mb-2">Patient ID</label>
                                    <input type="text" placeholder="Enter Patient ID" class="form-control">
                                </div>
                                <h5 class="mb-3">Surgery</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                        value="option1">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Minor
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                        value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Intermediate
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
                                        value="option3">
                                    <label class="form-check-label" for="exampleRadios3">
                                        Major
                                    </label>
                                </div>
                            </section>
                            <section class="mb-3">
                                <h5 class="mb-3">
                                    Card
                                </h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                        value="option1">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Normal Card
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                        value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Emergency/Accidental Card
                                    </label>
                                </div>
                            </section>
                            <section class="mb-3">
                                <h5 class="mb-3">Other Payments</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Feeding
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Blood Transfusion
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input onchange="checkDischarge()" class="form-check-input" type="checkbox" value=""
                                        id="dischargeCheckBox">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Discharge
                                    </label>
                                    <input type="text" name="" id="discharge-bill" class="form-control my-2">
                                </div>
                                <div class="form-check">
                                    <input onchange="checkDressing()" class="form-check-input" type="checkbox" value=""
                                        id="dressingCheckBox">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Dressing
                                    </label>
                                    <input type="text" name="" id="dressing-bill" class="form-control my-2">

                                </div>
                                <div class="form-check">
                                    <input onchange="checkServiceCharge()" class="form-check-input" type="checkbox" value=""
                                        id="serviceChargeCheckBox">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Service Charge
                                    </label>
                                    <input type="text" name="" id="service-charge-bill" class="form-control my-2">

                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <script>
        function checkServiceCharge() {
            if (document.getElementById("serviceChargeCheckBox").checked) {
                document.getElementById("service-charge-bill").style.display = "block";
            } else {
                document.getElementById("service-charge-bill").style.display = "none";

            }
        }

        function checkDressing() {
            if (document.getElementById("dressingCheckBox").checked) {
                document.getElementById("dressing-bill").style.display = "block";
            } else {
                document.getElementById("dressing-bill").style.display = "none";

            }
        }

        function checkDischarge() {
            if (document.getElementById("dischargeCheckBox").checked) {
                document.getElementById("discharge-bill").style.display = "block";
            } else {
                document.getElementById("discharge-bill").style.display = "none";

            }
        }
    </script>
@endsection
