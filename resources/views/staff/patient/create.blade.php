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
                <h3>New Patient</h3>
                <hr />
                <form action="{{ url('staff/patient/store') }}" method="POST">
                    <?php $idselect = Illuminate\Support\Str::random(10); ?>
                    <input type="hidden" value="{{ Illuminate\Support\Str::random(10) }}" id="uniqueid">
                    <input type="hidden" value="{{ $idselect }}" id="idselect">
                    @csrf
                  
                    <div class="new-patient" id="new-patien">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="my-3">
                                    <label for="" class="form-label">First Name</label><input type="text"
                                        name="first_name" id="first_name" class="form-control"
                                        value={{ old('first_name') }}>
                                    @if ($errors->first('first_name'))
                                        <span>{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="my-3">
                                    <label for="" class="form-label">Last Name</label><input type="text"
                                        name="last_name" id="last_name" class="form-control" value={{ old('last_name') }}>
                                    @if ($errors->first('last_name'))
                                        <span>{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="my-3">
                            <label for="" class="form-label">Gender</label>
                            <select name="gender" id="">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                            @if ($errors->first('gender'))
                                <span>{{ $errors->first('gender') }}</span>
                            @endif
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
