@extends('partials.layout')
@section('title', 'Create Test')
@section('content')
    <style>
        .remove_test {
            height: 40px;
            cursor: pointer;
        }

    </style>
    <div class="show">
        <div class="test-container hide mb-4" id="test-container">
            <div class="row">
                <div class="col-md-5">
                    <select name="tests[]" id="test-name" class="test_name select_test">
                        <option value="test">Select Test</option>
                        @foreach ($tests as $test)
                            <option value="{{ $test->id }}">{{ $test->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="hidden" value="test_price" class="test_price">
                    <div class="test_price"></div>
                </div>
                <div class="col-md-2">
                    <img src="{{ asset('images/remove.png') }}" class="img-fluid remove_test" alt="Remove Test">
                </div>
            </div>

        </div>
    </div>

    <form action="{{ url('staff/patient/test/save') }}" method="post">
        @csrf
        <div class="custom my-4">
            <div class="tests">
                <div class="card">
                    <div class="card-body">
                        @if (Session::has('msg'))
                            <div class="alert alert-success">
                                <h6>{{ Session::get('msg') }}</h6>
                            </div>
                        @endif
                        <h3 class="my-auto">Upload New Test</h3>
                        <hr />
                        @include('subviews.patient_details')

                        <button class="btn btn-danger w-100 my-3" id="add-test">Add New Test</button>
                        <div id="wrapper">
                            <div id="test-content"></div>
                            <div class="row mb-4">
                                <div class="col-md-5">Total</div>
                                <div class="col-md-6" id="total"></div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group">
                                    <label for="" class="mb-3">Select Payment Type</label>
                                    <select name="payment_type" id="" class="form-select">
                                        <option value="cash">Cash</option>
                                        <option value="pos">POS</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-4"><label for="Amount Paid" class="mb-2">Amount
                                        Paid</label>
                                    <input type="text" class="form-control" name="amount_paid">
                                    @if ($errors->has('amount_paid'))
                                        <span class="error">{{ $errors->first('amount_paid') }}</span>
                                    @endif
                                </div>

                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @push('scripts')
        <script>
            const wrapper = $("#wrapper");
            const test_container = $("#test-container");
            const test_content = $("#test-content");

            $("#add-test").click(function(e) {
                e.preventDefault();
                test_container.clone().appendTo(test_content);
                $("#test-content > #test-container").removeClass("hide");
            })

            $(wrapper).on("click", ".remove_test", function(e) {
                e.preventDefault();
                console.log("clicked..")
                $(this).closest("div#test-container").remove();
                getTotalPrice();
            })
            $(wrapper).on("change", ".select_test", function(e) {
                e.preventDefault();
                const test_id = $(this).val();
                console.log(test_id);
                test = $(this);

                axios.get('/api/v1/get-test-price/' + test_id)
                    .then(function(response) {
                        console.log("NHIS CALLED");

                        test.closest("div#test-container").find("div.test_price").html(response.data.price);
                        test.closest("div#test-container").find("div.test_price").val(response.data.price);
                        getTotalPrice();

                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    })
            })

            function getTotalPrice() {
                var total = 0;
                $(".test_price").each(function() { // or $(".total_price") if given a class
                    var val = $(this).val();
                    console.log(val);
                    total += isNaN(val) || $.trim(val) == "" ? 0 : parseFloat(val); // or parseInt(val,10);
                });
                $("#total").text(total.toFixed(2)); // or (total) if an int
            }
        </script>
    @endpush
@endsection
