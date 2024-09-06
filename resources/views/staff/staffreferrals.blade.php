@extends('partials.client')
@section('title', 'New Referral')
@section('content')
<div class="custo
 mt-5">
    <div class="card">
        <div class="card-body">
            @if (Session::has("msg"))
            <div class="alert alert-success">{{Session::get("msg")}}. Click <a
                    href="{{url('admin/new-referral')}}">here</a> to create a new
                referral </div>
            @endif

            <div class="d-flex align-items-stretch mb-3">
                <div class="flex-grow-1">
                    <h4>Referred by {{\App\Referrals::where("id", $referred_by)->value("name")}}</h4>
                </div>
                

            </div>
                <form action="{{url('staff/calculate-staff-referral')}}" method="post">
                @csrf
            <div class="row">
                    <input type="hidden" name="refid" value="{{$referred_by}}">
                    <div class="col-md-3">
                        <input type="date" name="startdate" id="start-date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="enddate" id="end-date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" id="search-btn">Calculate</button>
                    </div></div>
                
                </form>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Test</th>
                    <th>Price</th>
                    <th>Payment Type</th>

                    <th>Date</th>
                   
                </thead>
                <tbody>
                    
                    @foreach ($referrals as $key => $item)
                   
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{\App\Patients::where("id", $item->patients_id)->value("first_name")}}</td>
                        <td>{{\App\Patients::where("id", $item->patients_id)->value("last_name")}}</td>
                        <td>{{\App\Tests::where("id",$item->tests_id)->value("name")}}</td>
                        <td>{{$item->price}}</td>
                          
                        <td>
                            {{$item->paymentType}}
                        </td>
                        <td>
                            {{\Carbon\Carbon::parse($item->created_at)->format("d M, Y")}}
                        </td>
                        
                    </tr>
                    @endforeach
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$total}}</td>
                        <td>
                           
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection