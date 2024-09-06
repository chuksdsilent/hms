<?php

namespace App\Http\Controllers;

use App\Medicals;
use App\PatientReferral;
use App\Patients;
use App\SelectedTest;
use App\Tests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\DrugTransactions;
use App\PatientTransactions;
use App\Payments;
use App\Expenses;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PatientsController extends Controller
{
    public function allPayments(Request $request)
    {
       
        // return $request->all();
        $request->validate([
            "patient_id" => "required"
        ]);
        $id = Patients::where("patient_id", $request->patient_id)->value("id");
        $data = Payments::where("patient_id", $id)->orderBy("created_at", "DESC")->get();
        return view("staff.debts.allPayment")
            ->with("patient", Patients::findorFail($id))
            ->with("payments", $data);
    }
    public function payments()
    {
        return view("staff.debts.payments");
    }
    public function paymentSuccessful()
    {
        return view("staff.debts.paymentsuccessfull");
    }
    public function newPayment($id)
    {

        $data = PatientTransactions::findorFail($id);
        return view("staff.debts.newpayment")
            ->with("data", $data);
    }

    public function getChartData()
    {
        $amount_paid = PatientTransactions::select(DB::raw("(sum(amount_paid)) as total_amount_paid"), DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as transaction_date"))
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
            ->latest()
            ->limit(30)
            ->get();
       
        $total_amount_paid = [];
        foreach($amount_paid as $key => $amount){
            array_push($total_amount_paid, $amount->total_amount_paid);
        }
        $transaction_date = [];
        foreach($amount_paid as $key => $amount){
            array_push($transaction_date, Carbon::parse($amount->transaction_date)->format("d M, Y"));
        }
        
        return response()->json(["total_amount_paid" => $total_amount_paid, "transaction_date" => $transaction_date ], 200);
    }
    public function makePayment(Request $request)
    {
        // return $request->all();
        $request->validate([
            "patient_id" => "required",
            "trx_id" => "required",
            "amount_paid" => "required"
        ]);
        $balance = PatientTransactions::where("id", $request->trx_id)->value("balance");
        $amount_paid = PatientTransactions::where("id", $request->trx_id)->value("amount_paid");
        $balance = $balance - $request->amount_paid;
        $new_amount = $request->amount_paid +  $amount_paid;
        PatientTransactions::where("id", $request->trx_id)->update(["balance" => $balance, "amount_paid" => $new_amount]);

        $payment = new Payments();
        $payment->trx_id = $request->trx_id;
        $payment->patient_id = $request->patient_id;
        $payment->amount_paid = $request->amount_paid;
        $payment->save();

        $trx_id = $request->trx_id;

        $transaction_type = PatientTransactions::where("id", $trx_id)->value("transaction_type");
        if ($transaction_type == "general_bills") {
            return redirect('staff/patient/receipt/bills/' . $request->trx_id);
        } elseif ($transaction_type == "tests") {
            return redirect('staff/test/receipt/' . $trx_id);
        } else {
            return redirect('staff/receipt/drug/' . $trx_id);
        }
    }
    public function searchDebts(Request $request)
    {


        $request->validate([
            "patient_id" => "required"
        ]);
        return view("staff.debts.debts")
            ->with("patient", Patients::findorFail(Patients::where("patient_id", $request->patient_id)->value("id")))
            ->with("patient_id", $request->patient_id)
            ->with("debts", PatientTransactions::where("patient_id", Patients::where("patient_id", $request->patient_id)->value("id"))->where("balance", ">", 0)->get());
    }
    public function debts()
    {
        return view("staff.debts.patient");
    }

    /**
     * Api that gets users detail push to the frontend.
     */
    public function getPatientDetails($year, $month, $ids)
    {
        $id = $year . "/" . $month . "/" . $ids;
        return response()->json(Patients::where("patient_id", $id)->get(["first_name", "last_name"]), 200);
    }

    /**
     * Stores patient drug transactions and bill
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function savePatientDrugBill(Request $request)
    {
        
        $request->validate([
            "patientid" => "required",
            "amount_paid" => "required"
        ]);

        $patient_id = Patients::where("patient_id", $request->patientid)->value("id");
        $total = $request->total;
        $balance = $total - $request->amount_paid;

        $patient_transaction = new PatientTransactions();
        $patient_transaction->total = $total;
        $patient_transaction->amount_paid = $request->amount_paid;
        $patient_transaction->patient_id = $patient_id;
        $patient_transaction->payment_type = $request->payment_type;
        $patient_transaction->transaction_type = "drugs";
        $patient_transaction->staff_id = Auth::user()->id;
        $patient_transaction->balance = $total - $request->amount_paid;
        $patient_transaction->save();
        $trx_id =  $patient_transaction->id;

        $drugTransactions = new DrugTransactions();
        $drugTransactions->patient_id = $patient_id;
        $drugTransactions->total = $total;
        $drugTransactions->trx_id = $trx_id;
        $drugTransactions->amount_paid = $request->amount_paid;
        $drugTransactions->balance  = $balance;
        if ($request->drug_radio == 1) {
            $drugTransactions->type  = "H";
        } else {
            $drugTransactions->type = "N";
        }
        $drugTransactions->payment_type = $request->payment_type;
        $drugTransactions->staff_id = Auth::user()->id;
        $drugTransactions->save();


        $payment = new Payments();
        $payment->trx_id = $trx_id;
        $payment->patient_id = $patient_id;
        $payment->amount_paid = $request->amount_paid;
        $payment->payment_type = $request->payment_type;
        $payment->transaction_type = "drugs";
        $payment->save();

        return redirect('staff/receipt/drug/' . $trx_id);;
    }

    public function showDrugReceipt($id)
    {
        return view("receipts.drugs")
            ->with("id", $id)
            ->with("drugTransaction", PatientTransactions::findorFail($id));
    }
    public function updatePatient($id)
    {
        Patients::where("edit_id", $id)->update(request()->except("_token"));
        return redirect()->back()->with("msg", "Updated Successfully.");
    }
    public function editPatient($id)
    {
        return view("admin.editPat")->with("pat", Patients::where('edit_id', $id)->firstOrFail());
    }


    /**
     * Display a listing of patients from database.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view("staff.patient.allpatients")->with("patients", Patients::orderBy("created_at", "desc")->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("staff.patient.creates");
    }

    /**
     * 
     * Show the detail of the patient
     * 
     * @params {String}  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function patientDetails(Request $request, $id)
    {
        return view("staff.patient.patientProfiles")->with("patient", Patients::findorFail($id));
    }

    /**
     * Store a newly created patient in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required'
        ], [
            'first_name.required' => "First Name is required",
            'last_name.required' => "Last Name is required",
            'phone.required' => "Phone is required",
            'dob.required' => "Date of Birth is required",
            'gender.required' => "Gender is required"
        ]);
        
        $currentYear = date('Y');
        $currentMonth = date('m');

        
        $last_record = DB::table('patient_count_table')->where('id', 1)->value("count");
        
        $patient_id = $last_record == 0 ? $currentYear . "/". $currentMonth . "/". "GOUNITH" .  $this->formatID(1) : $currentYear . "/". $currentMonth . "/". "GOUNITH" . $this->formatID($last_record + 1) ;
        $request->request->add(["staff_id" =>  Auth::user()->id]);
        $request->request->add(["patient_id" =>  $patient_id]);
        $patientData = Patients::create($request->except("_token"));
        DB::table('patient_count_table')->where('id', 1)->update(["count" => $last_record + 1]);
        return redirect('staff/patient/' . $patientData->id);
    }

    public function formatID($id){
        
       if($id < 10){
          return  $id = "00" . $id;
        }else if($id > 9 && $id <= 99){
           return  $id = "0" . $id;
        }else if($id > 99){
            return $id;
        }
    }
    /**
     * Display the specified resource.`
     *
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function show(Patients $patients)
    {
        return view("client.test")->with("tests", Patients::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function edit(Patients $patients, $id)
    {

        $pat_data = Patients::find($id);

        return view("client.editpatients")
            ->with('id', $id)
            ->with("med_test", Medicals::where("patients_id", $id)->whereDate("created_at", request()->get("thedate"))->get())
            ->with("pat_data", $pat_data)
            ->with('tests', Tests::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patients $patients)
    {

        $request->validate([], []);
        $tests = $request->input("tests_id");

        $price = $request->input("price");
        $medical_id = $request->input("medical_id");
        $referral_id = $request->input("referral_id");
        $deposit_id = $request->input("deposit_id");
        $patients_id = $request->input("patient_id");

        $id =   Patients::where('id', $patients_id)->update($request->except(
            "med_id",
            "_method",
            "patients_id",
            "medical_id",
            "referral_id",
            "deposit_id",
            "patient_id",
            "trx_id",
            "_token",
            "price",
            "tests_id",
            "referred_by",
            "deposit",
            "test_id"
        ));
        $request->request->add(["patients_id" => $id]);

        $id = PatientReferral::where('id', $referral_id)->update($request->except(
            "med_id",

            "patients_id",
            "_method",
            "medical_id",
            "referral_id",
            "deposit_id",
            "patient_id",
            "pat_id",
            "phone",
            "_token",
            "price",
            "patient_name",
            "age",
            "tests_id",
            "_token",
            "price",
            "test_id",
            "deposit",
            "test_id"
        ));
        // Deposits::where('id', $deposit_id)->update($request->except(
        //     "med_id",

        //     "patients_id",
        //     "_method",
        //     "medical_id",
        //     "referral_id",
        //     "deposit_id",
        //     "patient_id",
        //     "pat_id",
        //     "phone",
        //     "_token",
        //     "price",
        //     "patient_name",
        //     "referred_by",
        //     "age",
        //     "tests_id",
        //     "_token",
        //     "price",
        //     "test_id",
        //     "test_id"
        // ));

        $med_ids = $request->get("med_id");
        // dd($med_id);

        // echo $med_id[1];
        if (count($tests) > 0) {
            foreach ($tests as $key => $value) {
                if (!is_null($value)) {
                    $request->request->add(["tests_id" => $value]);;
                    $med_id = Medicals::where("tests_id", $value)->value("id");


                    Medicals::where('id', $med_ids[$key])->update($request->except(
                        "med_id",

                        "_method",
                        "patients_id",
                        "medical_id",
                        "referral_id",
                        "deposit_id",
                        "patient_id",
                        "pat_id",
                        "deposit",
                        "_token",
                        "phone",
                        "price",
                        "patient_name",
                        "age",
                        "test_id",
                        "referred_by"
                    ));
                }
            }
        }

        SelectedTest::truncate();

        return redirect()->back()->with("msg", " Patient Updated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patients $patients)
    {
        //
    }

    public function getPrice($id)
    {
        $price = Tests::find($id)->price;

        return response()->json(["price" => $price]);
    }

    public function getEdtPrice($id)
    {


        $price = Tests::find($id)->price;
        $selectid = request()->get("selectid");
        $pat_id = request()->get("pat_id");

        $testuniqueid = request()->get("uniqueid");


        if (SelectedTest::where("test_id", $selectid)->where("uniqueid", $testuniqueid)->exists()) {
            SelectedTest::where("test_id", $selectid)->where("uniqueid", $testuniqueid)->update(['price' => $price]);
        } else {
            SelectedTest::create(["uniqueid" => $testuniqueid, "test_id" => $selectid, "price" => $price]);
        }


        $pat_total = Medicals::where("patients_id", $pat_id)->get();


        $total = 0;
        foreach ($pat_total as $item) {
            $total += Tests::where("id", $item->tests_id)->value("price");
        }

        $selected_total = SelectedTest::where("uniqueid", $testuniqueid)->sum("price");

        $sumtotal = $selected_total + $total;


        return response()->json(["price" => $price, "total" => $sumtotal]);
    }

    public function expenses()
    {
        return view("staff.expenses.index")->with("expenses", Expenses::orderBy("created_at", "DESC")->get());
    }
    public function createExpenses()
    {
        return view("staff.expenses.create");
    }
    public function storeExpenses(Request $request)
    {
        $request->validate([
            "title" => "required",
            "amount" => "required"
        ]);
        $request->request->add(["staff_id" => Auth::user()->id]);
        
        Expenses::create($request->except("_token"));
        return redirect()->back()->with("msg", "Expenses Created...");
    }
}
