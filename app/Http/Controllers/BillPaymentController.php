<?php

namespace App\Http\Controllers;

use App\Bills;
use App\Cards;
use App\DrugPatientBills;
use App\Drugs;
use App\DrugTransactions;
use App\Patients;
use App\PatientTransactions;
use App\ServiceCharges;
use App\Surgeries;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\PatientBills;
use App\Payments;
use Illuminate\Support\Facades\Auth;

class BillPaymentController extends Controller
{
    public function deleteBill($id)
    {
        PatientTransactions::where("id", $id)->delete();
        return Redirect::back()->with("msg", "Bill Deleted Successfully..");
    }
    /**
     * display create drug form
     */
    public function createDrugPayment()
    {
        return view("staff.drug.creates")
            ->with("hospital_drugs", Drugs::where("type", "H")->get())
            ->with("nhis_drugs", Drugs::where("type", "H")->get());
    }

    public function deleteDrug($id)
    {
        PatientTransactions::where("id", $id)->delete();

        return Redirect::back()->with("msg", "Drug Deleted successfully..");
    }

    /**
     * display create other bill form
     */
    public function createOtherBillPayment()
    {
        return view("staff.billing.creates")
            ->with("bills", Bills::all())
            ->with("surgery", Surgeries::all())
            ->with("cards", Cards::all());
    }

    public function saveNewBill(Request $request)
    {
        $bill = new Bills();
        $bill->bill_name = $request->name;
        $bill->staff_id = Auth::user()->id;
        $bill->save();

        return redirect('admin/general-bill')->with("msg", "Bill Creaed Successfully...");
    }
    public function createNewBill()
    {
        return view("admin.createNewBill");
    }

    public function editBill(Request $request, $id)
    {

        Bills::where("id", $id)->update(["bill_name" => $request->name]);
        return redirect('admin/general-bill')->with("msg", "Bill Updated Successfully...");
    }

    public function adminGeneralBill()
    {

        return view("admin.generalBill")->with("bills", Bills::all());
    }
    public function save(Request $request)
    {
        $request->validate([
            "patientid" => "required",
            "amount_paid" => "required"
        ]);
        // return $request->all();
        $trx_id = Str::uuid();

        $total = 0;
        foreach ($request->bill_price as $key => $value) {
            $total += $value;
        }
        // return $total;
        $patient_id = Patients::where("patient_id", $request->patientid)->value("id");
        $patient_transaction = new PatientTransactions();
        $patient_transaction->total = $total;
        $patient_transaction->amount_paid = $request->amount_paid;
        $patient_transaction->patient_id = $patient_id;
        $patient_transaction->transaction_type = "general_bills";
        $patient_transaction->staff_id = Auth::user()->id;
        $patient_transaction->balance = $total - $request->amount_paid;
        $patient_transaction->payment_type = $request->payment_type;
        $patient_transaction->save();
        $trx_id =  $patient_transaction->id;

        $bill_id = $request->tests;
        foreach ($request->bill_price as $key => $value) {
            $total += $value;
            $patient_bill = new PatientBills();
            $patient_bill->trx_id = $trx_id;
            $patient_bill->bill_name = Bills::where("id", $bill_id[$key])->value("bill_name");
            $patient_bill->bill_price = $value;
            $patient_bill->patient_id = $patient_id;
            $patient_bill->staff_id = Auth::user()->id;
            $patient_bill->payment_type = $request->payment_type;
            $patient_bill->save();
        }


        $payment = new Payments();
        $payment->trx_id = $trx_id;
        $payment->patient_id = $patient_id;
        $payment->amount_paid = $request->amount_paid;
        $payment->transaction_type = "tests";
        $payment->payment_type = $request->payment_type;
        $payment->save();


        return redirect('staff/patient/receipt/bills/' . $trx_id);
    }

    public function receipt($id)
    {
        return view("receipts.bills")
            ->with("id", $id)
            ->with("patient_bill", PatientBills::where("trx_id", $id)->get())
            ->with("patient_bills", PatientTransactions::findorFail($id));
    }



    /**
     * display drug bill form
     */
    public function drugBills()
    {
        return view("staff.billing.drugBills")
            ->with("drugTransactions", PatientTransactions::with("Patient")->where("transaction_type", "drugs")->whereDate('created_at', Carbon::today())->get());
        // ->with("drugBillings", DrugPatientBills::with(["Patients", "Drugs"])->selectRaw('*,sum(total) as sum')->groupBy("trx_id")->whereDate('created_at', Carbon::today())->get());
    }
    public function todayDrugBills()
    {
        return view("admin.today.drugs")
            ->with("drugTransactions", PatientTransactions::with("Patient")->where("transaction_type", "drugs")->whereDate('created_at', Carbon::today())->get());
        // ->with("drugBillings", DrugPatientBills::with(["Patients", "Drugs"])->selectRaw('*,sum(total) as sum')->groupBy("trx_id")->whereDate('created_at', Carbon::today())->get());
    }

    public function adminDrugBills()
    {
        // dd(PatientTransactions::with("Patient")->get());

        return view("admin.patient.drugs")
            ->with("drugTransactions", PatientTransactions::with("patient")->where("transaction_type", "drugs")->get());
        // ->with("drugBillings", DrugPatientBills::with(["Patients", "Drugs"])->selectRaw('*,sum(total) as sum')->groupBy("trx_id")->whereDate('created_at', Carbon::today())->get());
    }
    public function saveOtherBillPayment(Request $request)
    {
        // return $request->all();
        $trx_id = Str::uuid();

        if (!empty($request->surgery_id)) {
            $patientBillData = new PatientBills();
            $patientBillData->patient_id = $request->patientid;
            $patientBillData->trx_id = $trx_id;
            $patientBillData->bill_name = Surgeries::where("id", $request->surgery_id)->value("name");
            $patientBillData->bill_price = Surgeries::where("id", $request->surgery_id)->value("price");
            $patientBillData->staff_id = Auth::user()->id;
            $patientBillData->save();
        }

        if (!empty($request->card_id)) {
            $patientBillData = new PatientBills();
            $patientBillData->patient_id = $request->patientid;
            $patientBillData->trx_id = $trx_id;
            $patientBillData->bill_name = Cards::where("id", $request->card_id)->value("name");
            $patientBillData->bill_price = Cards::where("id", $request->card_id)->value("price");
            $patientBillData->staff_id = Auth::user()->id;
            $patientBillData->save();
        }

        if (!empty($request->feeding_id)) {

            $patientBillData = new PatientBills();
            $patientBillData->patient_id = $request->patientid;
            $patientBillData->trx_id = $trx_id;
            $patientBillData->bill_name = ServiceCharges::where("id", $request->feeding_id)->value("name");
            $patientBillData->bill_price = ServiceCharges::where("id", $request->feeding_id)->value("price");
            $patientBillData->staff_id = Auth::user()->id;
            $patientBillData->save();
        }
        if (!empty($request->blood_transfusion_id)) {

            $patientBillData = new PatientBills();
            $patientBillData->patient_id = $request->patientid;
            $patientBillData->trx_id = $trx_id;
            $patientBillData->bill_name = ServiceCharges::where("id", $request->blood_transfusion_id)->value("name");
            $patientBillData->bill_price = ServiceCharges::where("id", $request->blood_transfusion_id)->value("price");
            $patientBillData->staff_id = Auth::user()->id;
            $patientBillData->save();
        }

        if ($request->discharge) {
            $patientBillData = new PatientBills();
            $patientBillData->patient_id = $request->patientid;
            $patientBillData->trx_id = $trx_id;
            $patientBillData->bill_name = "Discharge";
            $patientBillData->bill_price = $request->discharge_price;
            $patientBillData->staff_id = Auth::user()->id;
            $patientBillData->save();
        }


        if ($request->dressing) {
            $patientBillData = new PatientBills();
            $patientBillData->patient_id = $request->patientid;
            $patientBillData->trx_id = $trx_id;
            $patientBillData->bill_name = "Dressing";
            $patientBillData->bill_price = $request->dressing_price;
            $patientBillData->staff_id = Auth::user()->id;
            $patientBillData->save();
        }


        $total = PatientBills::where("trx_id", $trx_id)->sum("bill_price");
        $amount_paid = $request->amount_paid;
        $balance = $total - $amount_paid;


        $patientTransactionData = new PatientTransactions();
        $patientTransactionData->trx_id = $trx_id;
        $patientTransactionData->total = $total;
        $patientTransactionData->amount_paid = $amount_paid;
        $patientTransactionData->is_open = ($request->close_transaction) ? 1 : 0;
        $patientTransactionData->balance =  $balance;
        $patientTransactionData->patient_id = $request->patientid;
        $patientTransactionData->staff_id = Auth::user()->id;
        $patientTransactionData->save();


        return view("receipts.services")
            ->with("total", $total)
            ->with("surgery_id", $request->surgery_id)
            ->with("card_id", $request->card_id)
            ->with("feeding_id", $request->feeding_id)
            ->with("blood_transfusion_id", $request->blood_transfusion_id)
            ->with("discharge", $request->discharge_price)
            ->with("dressing", $request->dressing_price)
            ->with("amount_paid", $request->amount_paid)
            ->with("patient_id", $request->patientid);
    }
    /**
     * display other bill form
     */

    public function OtherBills()
    {
        return view("staff.billing.otherBill")
            ->with("patientTransactions", PatientTransactions::with("Patient")->whereDate("created_at", Carbon::now())->orderBy("created_at", "DESC")->where("transaction_type", "general_bills")->get());
    }
    public function todayGeneral()
    {
        return view("admin.today.general")
            ->with("patientTransactions", PatientTransactions::with("Patient")->whereDate("created_at", Carbon::now())->orderBy("created_at", "DESC")->where("transaction_type", "general_bills")->get());
    }
    public function general()
    {
        return view("admin.patient.general")
            ->with("patientTransactions", PatientTransactions::with("Patient")->orderBy("created_at", "DESC")->where("transaction_type", "general_bills")->get());
    }

    public function generalBill($id)
    {
        return view("staff.billing.generalbill")
            ->with("patient_details", PatientTransactions::findorFail($id))
            ->with("patient_bills", PatientBills::where("trx_id", $id)->get());
    }

    public function showPatientBill($id)
    {
        return view("admin.patient.bills")
            ->with("patient_details", PatientTransactions::findorFail($id))
            ->with("patient_bills", PatientBills::where("trx_id", $id)->get());
    }
}
