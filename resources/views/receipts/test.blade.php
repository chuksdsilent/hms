@include('subviews.receiptsheader')
<h5 class="header-receipt text-center mt-2">
    Test Receipt
</h5>
<div class="spacing">
    <table class="table">
        <tr>
            <td width="50%">
                Patient ID: <br /> {{ \App\Patients::where('id', $patient_tests->patient_id)->value('patient_id') }}
            </td>
            <td>
                Full Name: <br />{{ \App\Patients::where('id', $patient_tests->patient_id)->value('first_name') }}
                {{ \App\Patients::where('id', $patient_tests->patient_id)->value('last_name') }}
            </td>
        </tr>
        <tr>
            <td>Date: <br /> {{ \Carbon\Carbon::now()->format('d M, Y') }}</td>
            <td>Transaction ID: <br /> {{ $patient_tests->trx_id }}</td>
        </tr>
    </table>


</div>
<div class="receipt-container">
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Price</th>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            @foreach ($patient_test as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->test_price) }}</td>
                </tr>
                <?php $total += $item->test_price; ?>
            @endforeach
            <tr>
                <td>Total</td>
                <td>{{number_format($total)}}</td>
            </tr>
            <tr>
                <td>Amount Paid</td>
                <td>{{number_format(\App\Payments::where("trx_id", $patient_tests->trx_id)->sum("amount_paid"))}}</td>
            </tr>
            <tr>
                <td>Payment Method</td>
                <td>{{\App\Payments::where("trx_id", $patient_tests->trx_id)->value("payment_type")}}</td>
            </tr>
            <tr>
                <td>Balance</td>
                <td>{{ number_format($total -  \App\Payments::where("trx_id", $patient_tests->trx_id)->sum("amount_paid"))}}</td>
            </tr>

        </tbody>
    </table>
<span> Processed By {{ \App\Staff::where("user_id", \App\User::where("id", \App\PatientTransactions::where("id", $trx_id)->value("staff_id"))->value("id"))->value("first_name") . " " . \App\Staff::where("user_id", \App\User::where("id", \App\PatientTransactions::where("id", $trx_id)->value("staff_id"))->value("id"))->value("last_name")   }}</span>
</div>
</div>
<div class="no-print">
    <a href="{{ url('/staff/tests/create') }}">New Tests</a>
    <button onclick="window.print()">Print</button>
</div>

</body>

</html>
