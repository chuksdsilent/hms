@extends('partials.sadmin')
@section('title', 'Search')
@section('content')
<div class="container my-5">
    <div class="search-container">
        <div class="card" style="height: 120vh; overflow: auto;">
            <div class="card-body">
                @if (Session::has("msg"))
                <div class="alert alert-danger">{{Session::get("msg")}}</div>
                @endif
                <h4>Search</h4>
                <hr />
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="" id="search-id" class="form-control"
                            placeholder="Patient ID/Name/Phone">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="" id="start-date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="" id="end-date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" id="search-btn">Search</button>
                    </div>
                </div>
                <hr>
                <div id="loader">
                    <div class="d-flex align-item-center justify-content-center remove-display" id="loading"
                        style="width: 100%;">
                        <div class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                </div>
                <div class="total d-flex flex-row-reverse">

                    <div style="margin: .3rem 5rem; font-weight: bolder;">Total: <span id="total">N0</span></div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Referred By</th>
                        <th>Phone</th>
                        <th>Test</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
                <div id="loader">
                    <div class="d-flex align-item-center justify-content-center remove-display" id="no-result"
                        style="width: 100%;">
                        No Result Found
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection()