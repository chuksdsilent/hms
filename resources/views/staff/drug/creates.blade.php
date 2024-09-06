@extends('partials.layout')
@section('title', 'Drug Payment')
@section('content')
    <form action="{{ url('staff/patient/drug/save') }}" method="post">
        @csrf
        <div class="card" style="margin: 0 auto; width: 50%;">
            <div class="card-body">
                <h4>Drug Payments</h4>
                <hr />
                <div class="bill-content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12 col-xs-12">
                            <section class="mb-3">
                                @include('subviews.patient_details')
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="drug_radio" value="1" value="H"
                                        id="hospital_drugs">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Hospital Patient
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="drug_radio" value="2" value="N"
                                        id="nhis_drugs">
                                    <label class="form-check-label" for="exampleRadios2">
                                        NHIS Patient
                                    </label>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="hide" id="hide">
                        <div class="row my-3">
                            <div class="col-md-12">
                                <h6>Total</h6>
                                <input type="text" name="total" class="form-control">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-12">
                                <h6>Amount Paid</h6>
                                <input type="text" name="amount_paid" class="form-control">
                                @if ($errors->has('amount_paid'))
                                    <span class="error">{{ $errors->first('amount_paid') }}</span>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                                    <label for="" class="mb-3">Select Payment Type</label>
                                    <select name="payment_type" id="" class="form-select">
                                        <option value="cash">Cash</option>
                                        <option value="pos">POS</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                    </select>
                                </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </div>
            </div>
        </div>
    </form>
    @push('scripts')
        <script>
            const hospital_drugs = $("#hospital_drugs");
            const nhis_drugs = $("#nhis_drugs");
            hospital_drugs.click(function() {
                if (hospital_drugs.checked || nhis_drugs) {
                    $("#hide").removeClass("hide");
                }
            })
            nhis_drugs.click(function() {
                if (hospital_drugs.checked || nhis_drugs) {
                    $("#hide").removeClass("hide");
                }
            })
        </script>
    @endpush
@endsection
