@include('subviews.receiptsheader')
<h5 class="header-receipt text-center mt-2">
    Drug Receipt
</h5>
<div class="spacing">
    <table class="table">
        <tr>
            <td width="50%">
                Patient ID: <br />
                {{\App\Patients::where('id', $drugTransaction->patient_id)->value('patient_id')}}
            </td>
            <td>
                Full Name: <br />{{ \App\Patients::where('id', $drugTransaction->patient_id)->value('first_name') }}
                {{ \App\Patients::where('id', $drugTransaction->patient_id)->value('last_name') }}
            </td>
        </tr>
        <tr>
            <td>Date: <br /> {{ \Carbon\Carbon::now()->format('d M, Y') }}</td>
            <td>Transaction ID: <br /> {{ $drugTransaction->id }}</td>
        </tr>
        <tr>
            <td>Patient Type</td>
            <td>
                @if(\App\DrugTransactions::where('trx_id', $id)->value('type') == 'H')
                    Hospital Patient
                @else
                    NHIS Patient
                @endif

            </td>
        </tr>
    </table>


</div>
<div class="receipt-container">
    <table class="table">
        <thead>
            <th>Total</th>
            <th>Amount Paid</th>
            <th>Balance</th>
        </thead>
        <tbody>

            <tr>
                <td>{{ number_format($drugTransaction->total) }}</td>
                <td>{{ number_format($drugTransaction->amount_paid) }}</td>
                <td>{{ number_format($drugTransaction->total - $drugTransaction->amount_paid) }}</td>
            </tr>

            <tr>
                <td>Payment Method</td>
                <td colspan="2">{{\App\Payments::where("trx_id", $id)->value("payment_type")}}</td>
            </tr>
        </tbody>
    </table>
    <di>{{ $id }}</di>
    <span> Processed By {{ \App\Staff::where("user_id", \App\User::where("id", \App\DrugTransactions::where("trx_id", $id)->value("staff_id"))->value("id"))->value("first_name") . " " . \App\Staff::where("user_id", \App\User::where("id", \App\DrugTransactions::where("trx_id", $id)->value("staff_id"))->value("id"))->value("last_name")   }}</span>

</div>
</div>
<div class="no-print">

        <a href="{{ url('/staff/drug-payment/create') }}" class="btn btn-primary">New Drug</a>
    <button onclick="window.print()">Print</button>
</div>

</body>

</html>
