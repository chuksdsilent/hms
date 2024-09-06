<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>
    <style>
        .printer-style {
            border: 2px solid #000;
            width: 302.36220472px;
            height: 450px;
        }

        @media print {
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }

        }

        .patient-info {
            padding: 1em 0px;
        }

        span {
            padding-bottom: .5em;
            text-align: right;
            font-weight: bolder;
        }

        ul {
            margin: 0px;
            padding: 0px;
        }

        li {
            margin-bottom: .5em;
            list-style-type: none;
        }

        .d-flex {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .d-fle {
            display: flex;
            margin-left: 1em;
            margin-right: 2em
        }

        .from-me {
            margin-left: 2em;
        }

        .medical-details {
            border: 2px solid #000;
            margin: 0rem 1rem;
            height: 100%;
        }

        table td,
        table th,
        table tr {
            border: .5px solid #000000;
            padding: .3em;
            font-size: 12px;

        }

        h4 {
            padding: 0.2em 1em;
            margin: 0em;
            font-size: 14px;
        }

        .headings>.office>p {
            padding: 0px;

            margin: 0px;
            font-size: 12px;
            padding-left: 1.5em;
        }

        .office {
            font-size: 12px;
        }

        @media print {
            .controls {
                display: none !important;
            }
        }

        .controls {
            margin-top: 2em;
        }

        .headings>.office>p {
            padding-left: 1rem;
        }
    </style>
</head>

<body>
    <div class="d">

        <div class="printer-style">
            <div class="headings">
                <h4 style="color: blue;">NICE DIAGNOSTIC CLINICS</h4>
                <div class="office">
                    <p><span class="mr-1">Nsukka Office</span> No. 48 Ogurugu Road, Nsukka, Enugu State</p>
                    <p><span class="mr-1">Ozalla office</span> Beside Obe agro allied filling station along ozalla obe
                        Road
                        Nkanu west Enugu State</p>
                          <p><span class="mr-1">Enugu office</span> Anichukwu close ind. Layout off Nkpokiti along IMT(Campus 3) Rd.</p>
                    <p><span class="mr-1">Enugu Ezike Office</span> No. 57 Umuida Road Ogurute Enugu Ezike, Enugu State
                    </p>
                    <p><span class="mr-1">Phone</span> 08035043954, 08063565955,09025773885</p>

                    <hr>

                    <div class="patient-info">
                        <div class="d-fle">
                            <ul class="">
                                <li> <span>Patient ID: </span>{{$pat_data->pat_id}} </li>
                                <li> <span>Name: </span>{{$pat_data->first_name}} {{$pat_data->last_name}}</li>
                            </ul>
                            <ul class="" style="margin-left: 2em;">
                                <li> <span>Phone: </span> {{$pat_data->phone}} </li>
                                <li> <span>Date: </span> {{ \Carbon\Carbon::now()->format("d M, Y")}} </li>

                            </ul>

                        </div>
                        <div class="d-fle">
                            <ul class="">
                                <li> <span>Referred By: </span> <br>
                                
                                    {{\App\PatientReferral::where("patients_id", $pat_data->id)->whereDate("created_at", \Carbon\Carbon::now())->value("referred_by")}}
                                </li>
                            </ul>
                            <ul style="margin-left: 3em;">
                                <li><span>Transsaction ID:</span> <br> {{$trx_id}}</li>
                            </ul>

                        </div>
                        <div class="d-fle">


                        </div>

                    </div>
                    <div class="medical-details">
                        <table class="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <td>Test</td>
                                    <td>Price</td>
                                    {{-- <td>Date</td> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; ?>
                                @foreach ($med_data as $item)
                                <tr>
                                    <td>{{$item->tests->name}}</td>
                                    <td>N{{$item->tests->price}}</td>
                                    {{-- <td>{{\Carbon\Carbon::parse($item->created_at)->format("d M, Y")}}</td> --}}
                                </tr>
                                <?php $total += $item->tests->price; ?>
                                @endforeach
                                <tr>
                                    <td>
                                        Discount
                                    </td>
                                    <td>
                                        {{ !is_null(\App\Discounts::where("trx_id", $trx_id)->value("discount")) ? App\Discounts::where("trx_id", $trx_id)->value("discount") : 0 }}%
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Total
                                    </td>
                                    <td>
                                        <?php $total = $total - ($total*(\App\Discounts::where("trx_id", $trx_id)->value("discount"))/100) ?>
                                        N{{  $total}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Amount Paid
                                    </td>
                                    <td>
                                       N{{ $amountpaid }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Balance
                                    </td>
                                    <td>
                                     N{{$total - $amountpaid }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 1rem; font-size: 12px;">
                    {{\App\Branches::where('id', Session::get('branch'))->value('name')}}/
                    {{ \Carbon\Carbon::now()->format("d M")}}/{{\App\Branches::where('id', Session::get('branch'))->count()}}
                </div>
            </div>
        </div>
        <div class="controls">
            <a href="#" onclick="window.print()"
                style="background: blue; color:white; margin:.5em;padding: .5em 1em; border-radius: 2%; text-decoration: none;">Print</a>
            <a href="{{url("staff/patient/create")}}" style="background: blue; color:white; margin:.5em;padding: .5em 1em; border-radius: 2%; text-decoration:
        none;">Create
                New
                Patient</a>
        </div>
    </div>
</body>

</html>