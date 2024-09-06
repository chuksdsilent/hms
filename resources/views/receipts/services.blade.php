<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

</head>

<body>
    <div class="receipt">
        <div class="header">
            <h3>All Saints Medical Centre</h3>
        </div>

        <div class="room">
            <div>Patient ID:  {{ \App\Patients::where('id', $patient_id)->value('patient_id') }}</div>
            <div>Full Name: {{ \App\Patients::where('id', $patient_id)->value('first_name') }}
                {{ \App\Patients::where('id', $patient_id)->value('last_name') }}</div>
            <div>Date: {{ \Carbon\Carbon::now()->format('d M, Y') }}</div>
        </div>

        <div class="receipt-container">
            <table class="table">
                <thead>
                    <th>Services</th>
                    <th>Price</th>
                </thead>
                <tbody>
                    @if ($surgery_id)
                        <tr>
                            <td >{{ \App\Surgeries::where("id", $surgery_id)->value("name")}}</td>
                            <td >{{ \App\Surgeries::where("id", $surgery_id)->value("price")}}</td>
                        </tr>
                    @endif
                    @if ($card_id)
                        <tr>
                            <td >{{ \App\Cards::where("id", $card_id)->value("name")}}</td>
                            <td >{{ \App\Cards::where("id", $card_id)->value("price")}}</td>
                        </tr>
                    @endif
                    @if ($feeding_id)
                        <tr>
                            <td >{{ \App\ServiceCharges::where("id", $feeding_id)->value("name")}}</td>
                            <td >{{ \App\ServiceCharges::where("id", $feeding_id)->value("price")}}</td>
                        </tr>
                    @endif
                    @if ($blood_transfusion_id)
                        <tr>
                            <td >{{ \App\ServiceCharges::where("id", $blood_transfusion_id)->value("name")}}</td>
                            <td >{{ \App\ServiceCharges::where("id", $blood_transfusion_id)->value("price")}}</td>
                        </tr>
                    @endif
                    @if ($discharge)
                        <tr>
                            <td >Discharge</td>
                            <td >{{$discharge}}</td>
                        </tr>
                    @endif
                    @if ($dressing)
                        <tr>
                            <td >Dressing</td>
                            <td >{{$dressing}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="1">Total</td>
                        <td>
                            {{$total}}
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
    <div class="no-print">
        <a href="{{ url('/staff/other-bill-payment') }}">New Patient Bill</a>
        <button onclick="window.print()">Print</button>
    </div>

</body>

</html>
