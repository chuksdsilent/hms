@extends('partials.layout')
@section('title', 'New Patient')
@section('content')
    <style>
        .textfield {
            display: none;
        }

        #otherDepartment {
            display: none;
        }

    </style>
    <div class=" custom my-4">
        <div class="card">
            <div class="card-body">
                @if (Session::has('msg'))
                    <div class="alert alert-success">
                        <h6>{{ Session::get('msg') }}</h6>
                    </div>
                @endif
                <h3>New Expense</h3>
                <hr />
                <form action="{{ url('staff/expenses/store') }}" method="POST">
                    @csrf
                  
                    <div class="new-patient" id="new-patien">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="my-3">
                                    <label for="" class="form-label">Purpose</label><input type="text"
                                        name="title" id="title" class="form-control"
                                        value={{ old('title') }}>
                                    @if ($errors->first('title'))
                                        <span>{{ $errors->first('title') }}</span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="my-3">
                                    <label for="" class="form-label">Amount</label><input type="text"
                                        name="amount" id="amount" class="form-control"
                                        value={{ old('amount') }}>
                                    @if ($errors->first('amount'))
                                        <span>{{ $errors->first('amount') }}</span>
                                    @endif
                                </div>

                            </div>
                        </div>
                     
                    </div>
                    <div class="my-3">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>
    </div>


    <script>
        // This is an old version, for a more recent version look at
        // https://jsfiddle.net/DRSDavidSoft/zb4ft1qq/2/
        function maxLengthCheck(object) {
            if (object.value.length > object.maxLength)
                object.value = object.value.slice(0, object.maxLength)
        }
    </script>
@endsection
