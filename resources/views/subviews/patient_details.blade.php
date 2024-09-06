<div class="form-group mb-2">
    <label for="Patient ID" class="mb-2">Patient ID</label>
    <input type="text" name="patientid" id="patientid" placeholder="Enter Patient ID" class="form-control">
</div>
<span id="loadings" class="hide mt-3 mb-3">loading patient details...</span>
<div id="patient-details" class="hide">
    <div class="row mb-3 mt-3">
        <div class="col-md-6">
            <h6>First Name</h6>
            <span id="first_name"></span>
        </div>
        <div class="col-md-6">
            <h6>last Name</h6>
            <span id="last_name"></span>
        </div>
    </div>
</div>

@if ($errors->has('patientid'))
<span class="error">{{ $errors->first('patientid') }}</span>
@endif