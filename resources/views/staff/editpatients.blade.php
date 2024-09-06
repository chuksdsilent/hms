@extends('partials.admin')
@section('title', 'New Patient Test')
@section('content')
<div class="custom my-4">
    <div class="card">
        <div class="card-body">
            @if (Session::has("msg"))
            <div class="alert alert-success">
                <h6>{{Session::get("msg")}}</h6>
            </div>
            @endif
            <h3>Edit Patient Test</h3>
            <hr />


            <form action="{{url('staff/patient/edit/'. $id) }}" id="edit" method="POST">

                <input type="hidden" name="patient_id" id="patient_id" value="{{$id }}">
                <input type="hidden" name="medical_id" id="medical_id" value="{{$pat_data->medicals[0]->id }}">
                <input type="hidden" name="referral_id" id="referral_id"
                    value="{{$pat_data->patient_referral[0]->id }}">
                {{-- <input type="hidden" name="deposit_id" id="deposit" value="{{$pat_data->deposits[0]->id }}"> --}}
                <input type="hidden" id="uniqueid" value="{{Illuminate\Support\Str::random(10) }}">
                @csrf
                @method("PATCH")
                <div class="my-3">
                    <label for="" class="form-label">Full Name</label><input type="text" name="patient_name"
                        class="form-control" disabled value="{{$pat_data->patient_name}}">
                    @if ($errors->first("name"))
                    <span>{{$errors->first("name")}}</span>
                    @endif
                </div>
                <div class="my-3">
                    <label for="" class="form-label">Referred By</label><input type="text" name="referred_by"
                        class="form-control" disabled value="{{$pat_data->patient_referral[0]->referred_by}}">
                    @if ($errors->first("name"))
                    <span>{{$errors->first("name")}}</span>
                    @endif
                </div>

                <div class="my-3">
                    {{-- <label for="" class="form-label">Referred By</label><input type="text" name="patient_name"
                        class="form-control" value="{{$pat_data->patient_referral[0]->referred_by}}"> --}}
                    @if ($errors->first("name"))
                    <span>{{$errors->first("name")}}</span>
                    @endif
                </div>
                <div class="my-3">
                    <label for="" class="form-label">Phone</label><input type="number" disabled name="phone"
                        class="form-control" value="{{$pat_data->phone}}">
                    @if ($errors->first("deposit"))
                    <span>{{$errors->first("deposit")}}</span>
                    @endif
                </div>
                {{-- <div class="my-3">
                    <label for="" class="form-label">Deposit</label><input type="number" name="deposit"
                        class="form-control" value="{{ $pat_data->deposits[0]->deposit}}">
                @if ($errors->first("deposit"))
                <span>{{$errors->first("deposit")}}</span>
                @endif
        </div> --}}
        <div class="my-3">
            <label for="" class="form-label">Date of Birth</label><input value="{{$pat_data->age}}" disabled type="date"
                name="age" class="form-control">
            @if ($errors->first("age"))
            <span>{{$errors->first("age")}}</span>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6">
                Patient Tests
            </div>
            <div class="col-md-6">
                Prices
            </div>
        </div>
        <?php $i=1; $total = 0;?>


        @foreach ($med_test as $items)
        <input type="hidden" value="{{$items->id}}" name="med_id[]">
        <?php $i++; ?>
        <div id="testdone">
            <div class="row my-4">
                <div class="col-md-6">
                    <select name="tests_id[]" class="form-control select-test" id="select-test{{$i}}">
                        <option value="">Select Patient Test</option>

                        @foreach ($tests as $item)
                        <option value="{{$item->id}}" {{$items->tests_id == $item->id ? "selected" : ""}}>
                            {{$item->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->first("referred_by"))
                    <span>{{$errors->first("referred_by")}}</span>
                    @endif
                </div>
                <div class="col-md-6 test-price">
                    <div class="price-value" id="price-value{{$i}}">
                        N{{\App\Tests::where("id", $items->tests_id)->value("price")}}</div>
                </div>
            </div>
        </div>

        <?php $total +=  \App\Tests::where("id", $items->tests_id)->value("price"); ?>
        @endforeach
        <div id="appendcontainer"></div>

        <div class="my-3">
            <div class="row">
                <div class="col-md-6">
                    Total
                </div>
                <div class="col-md-6">
                    <div id="total">N{{$total}}
                    </div>
                </div>
            </div>
        </div>

        <div class="my-3">
            <input type="submit" value="Update" class="btn btn-primary">
        </div>

        </form>
    </div>
</div>
</div>
@endsection