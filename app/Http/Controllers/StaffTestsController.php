<?php

namespace App\Http\Controllers;

use App\Patients;
use App\PatientTests;
use App\PatientTestTransactions;
use App\PatientTransactions;
use App\Payments;
use App\Tests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class StaffTestsController extends Controller
{
    public function create()
    {
        return view("staff.test.creates")->with("tests", Tests::all());
    }

    public function showPatientTestTransaction($id)
    {
        $patient_id = PatientTransactions::where("id", $id)->value("patient_id");

        return view("staff.test.patient_tests")
            ->with("id", $id)
            ->with("patient_details", Patients::findorFail($patient_id))
            ->with("patient_tests", PatientTests::with(["Patient"])->where("trx_id", $id)->whereDate("created_at", Carbon::now())->orderBy("created_at", "DESC")->get());
    }
    public function index()
    {

        // dd(PatientTests::with(["Patient", "PatientTestTransaction"])->get());
        return view("staff.test.test")->with("patient_tests", PatientTransactions::where("transaction_type",  "tests")->whereDate("created_at", Carbon::now())->orderBy("created_at", "DESC")->get());
    }

    public function save(Request $request)
    {
        
        $request->validate([
            "patientid" => "required",
            "amount_paid" => "required"
        ]);
        
        $total = 0;
        $patient_id = Patients::where("patient_id", $request->patientid)->value("id");;
        foreach ($request->tests as $key => $test) {
            $total += Tests::where("id", $test)->value("price");
        }

        
        $patientTestTransaction = new PatientTransactions();
        $patientTestTransaction->patient_id = $patient_id;
        $patientTestTransaction->total = $total;
        $patientTestTransaction->transaction_type = "tests";
        $patientTestTransaction->amount_paid = $request->amount_paid;
        $patientTestTransaction->staff_id = Auth::user()->id;
        $patientTestTransaction->balance = $total - $request->amount_paid;
        $patientTestTransaction->payment_type = $request->payment_type;
        $patientTestTransaction->save();
        $trx_id = $patientTestTransaction->id;

        foreach ($request->tests as $key => $test) {
            $patientTest = new PatientTests();
            $patientTest->name = Tests::where("id", $test)->value("name");
            $patientTest->test_price = Tests::where("id", $test)->value("price");
            $patientTest->patient_id = $patient_id;
            $patientTest->trx_id = $trx_id;
            $patientTest->payment_type = $request->payment_type;
            $patientTest->save();
        }

        $payment = new Payments();
        $payment->trx_id = $trx_id;
        $payment->patient_id = $patient_id;
        $payment->amount_paid = $request->amount_paid;
        $payment->transaction_type = "tests";
        $payment->payment_type = $request->payment_type;

        $payment->save();


        return redirect('staff/test/receipt/' . $trx_id);
    }

    public function testReceipt($id)
    {
        
         $patient_id = PatientTestTransactions::where("id", $id)->value("patient_id");
        return  view("receipts.test")
            ->with("trx_id", $id)
            ->with("patient_id", $patient_id)
            ->with("patient_test", PatientTests::where("trx_id", $id)->get())
            ->with("patient_tests",  PatientTests::where("trx_id", $id)->firstorfail());
    }
}
