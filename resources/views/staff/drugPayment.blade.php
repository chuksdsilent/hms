@extends('partials.client')
@section('title', 'Drug Payment')
@section('content')
    <form action="{{ url('patient/bill-payment') }}" method="post">
        <div class="card" style="margin: 0 auto; width: 50%;">
            <div class="card-body">
                <h4>Drug Payments</h4>
                <hr />
                <div class="bill-content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12 col-xs-12">
                            <section class="mb-3">
                                <div class="form-group mb-2">
                                    <label for="Patient ID" class="mb-2">Patient ID</label>
                                    <input type="text" placeholder="Enter Patient ID" class="form-control">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                        value="option1">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Hospital Patient
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                        value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        NHIS Patient
                                    </label>
                                </div>
                            </section>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection
