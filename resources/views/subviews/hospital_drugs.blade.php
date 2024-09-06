<section class="col-md-12 col-sm-12 col-12 col-xs-12 hide" id="drug-area">
    <button class="btn btn-success mb-4 w-100" id="add-hospital-drug">Add Drug</button>
    <div id="drug-title">
        <div class="row">
            <h5 class="col-md-6 mb-3">Drug Name</h5>
            <h5 class="col-md-6 mb-3">Price</h5>
        </div>
    </div>
    <div id="drug-wrapper" class="drug-wrapper">
        <div class="row field-wrapper" id="drug-contents">
            <div class="col-md-6 mb-3">
                <select name="drug[]" class="drug_select" id="add-hospital-drug">
                    <option value="">Select Drug</option>
                    @foreach ($hospital_drugs as $drug)
                        <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                    @endforeach
    
                </select>
            </div>
            <div class="col-md-4" style="font-size: 20px;">
                <div id="price" class="price"></div>
            </div>
            <div class="col-md-2">
                <div class="close">
                    <img src="{{ asset('images/remove.png') }}" alt="Remove Drug"
                        class="remove-drug img-fluid">
                </div>
            </div>
        </div>
        
        
        <div class="drug-container" id="drug-container"></div>

        <div class="row">
            <div class="col-md-6 col-6 col-xs-6 col-sm-6">Total</div>
            <div class="col-md-6 col-6 col-xs-6 col-sm-6" id="total"></div>
        </div>

    </div>
</section>