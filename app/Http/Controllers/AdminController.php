<?php

namespace App\Http\Controllers;

use App\Discounts;
use App\LoggedInStaff;
use App\Medicals;
use App\Patients;
use App\StaffActivities;
use App\Tests;
use App\User;
use App\PatientReferral;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Debts;
use App\Expenses;
use App\Departments;
use App\PatientTransactions;
use App\Payments;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    public function deleteDebt($id)
    {
        PatientTransactions::where("id", $id)->update(["balance" => 0]);
        return Redirect::back()->with("msg", "Updated Successfully...");
    }
    public function generalBill($id)
    {
        return view("admin.others.generalbills")
            ->with("patient_details", PatientTransactions::findorFail($id))
            ->with("patient_bills", PatientBills::where("trx_id", $id)->get());
    }
    public function showPatientTestTransaction($id)
    {
        $patient_id = PatientTransactions::where("id", $id)->value("patient_id");

        return view("admin.others.tests")
            ->with("id", $id)
            ->with("patient_details", Patients::findorFail($patient_id))
            ->with("patient_tests", PatientTests::with(["Patient"])->where("trx_id", $id)->orderBy("created_at", "DESC")->get());
    }
    public function revenueDetails($dateTransaction)
    {
        $revenues = PatientTransactions::whereDate("created_at", $dateTransaction)->get();
        return view("admin.revenueDetails", compact("revenues"));
    }
    public function revenue()
    {
        $revenues = PatientTransactions::select("id", DB::raw("(sum(amount_paid)) as amount_paid"), DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as created_at"))
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
            ->get();

        return view("admin.revenue", compact("revenues"));
    }
    public function tests()
    {
        return view("admin.patient.tests")->with("patient_tests", PatientTransactions::with(["patient"])->where("transaction_type",  "tests")->orderBy("created_at", "DESC")->get());
    }
    public function todayTests()
    {
        return view("admin.today.tests")->with("patient_tests", PatientTransactions::where("transaction_type",  "tests")->whereDate("created_at", Carbon::now())->orderBy("created_at", "DESC")->get());
    }

    public function calculateDepartment()
    {

        $startdate = request()->get("startdate");
        $enddate = request()->get("enddate");
        $data =  Medicals::whereBetween('created_at', [$startdate, $enddate])->where("department", request()->get("refid"))->get();
        return view("admin.viewdepartment")->with("departments", $data)->with("referred_by", request()->get("refid"));
    }
    public function viewdepartment($id)
    {
        Medicals::where("department", $id)->get();
        return view("admin.viewdepartment")->with("departments", Medicals::where("department", $id)->get())->with("referred_by", $id);
    }
    public function calculateReferral()
    {
        $startdate = request()->get("startdate");
        $enddate = request()->get("enddate");
        $data =  Medicals::whereBetween('created_at', [$startdate, $enddate])->where("referred_by", request()->get("refid"))->get();
        $total = Medicals::whereBetween('created_at', [$startdate, $enddate])->where("referred_by", request()->get("refid"))->sum("price");
        return view("admin.viewreferralse")->with("referrals", $data)->with("referred_by", request()->get("refid"))->with("total", $total);
    }
    public function calculateStaffReferral()
    {

        $startdate = request()->get("startdate");
        $enddate = request()->get("enddate");
        $data =  Medicals::whereBetween('created_at', [$startdate, $enddate])->where("referred_by", request()->get("refid"))->get();
        $total = Medicals::whereBetween('created_at', [$startdate, $enddate])->where("referred_by", request()->get("refid"))->sum("price");
        return view("client.staffreferrals")->with("referrals", $data)->with("referred_by", request()->get("refid"))->with("total", $total);
    }
    public function deleteDepartment($id)
    {
        Departments::destroy($id);
        Medicals::where("department", $id)->delete();
        return redirect()->back()->with("msg", "Department Deleted");
    }
    public function createdepartment()
    {

        Departments::create(["name" => request()->get("name")]);
        return redirect()->back()->with("msg", "Department Created...");
    }
    public function newdepartment()
    {
        return view("admin.newdepartment");
    }

    public function drReferral($id)
    {

        return view("client.staffreferrals")->with("total", Medicals::where("referred_by", $id)->sum("price"))->with("referrals", Medicals::where("referred_by", $id)->get())->with("referred_by", $id);
    }
    public function showReferral($id)
    {

        return view("admin.viewreferralse")->with("total", Medicals::where("referred_by", $id)->sum("price"))->with("referrals", Medicals::where("referred_by", $id)->get())->with("referred_by", $id);
    }
    public function newBackup()
    {
    }
    public function backup()
    {
        return view("admin.backup");
    }
    public function showTest($trx_id)
    {

        return view("admin.showTest")->with("tests", Medicals::where("trx_id", $trx_id)->get())->with("trx_id", $trx_id);
    }
    public function staffActivity()
    {
        return view("admin.staffactivity")
            ->with("loggedinstaff", StaffActivities::orderBy("created_at", "DESC")->get());
    }
    public function completePay()
    {
        return $debts = PatientTransactions::latest()->where("balance", ">", 0)->get();
        return view("admin.completePay")->with("debts", $debts);
    }
    public function loggedInStaff()
    {
        return view("admin.staffloggedin")
            ->with("loggedinstaff", User::where("loggedin", 1)->orderBy("created_at", "DESC")->get());
    }
    public function receipt($id)
    {

        return view("admin.receipt")
            ->with("med_data", Medicals::where("trx_id", request()->get("trx_id"))->get())
            ->with("trx_id", request()->get("trx_id"))
            ->with("amountpaid", Debts::where("trx_id", request()->get("trx_id"))->value("amount_paid"))
            ->with("pat", Patients::where("pat_id", $id)->get());
    }
    public function debts()
    {
        $debts = PatientTransactions::with("Patient")->latest()->where("balance", ">", 0)->get();
        return view("admin.debts")->with("debts", $debts);
    }
    public function payments()
    {
        $payments = Payments::with("Patient")->latest()->get();
        return view("admin.payments")->with("payments", $payments);
    }
    public function todayTest()
    {

        return view("admin.todaytest")
            ->with("medical", Medicals::orderBy("created_at", "DESC")->groupBy("trx_id")->where("created_at", Carbon::now()->toDateString())->get());
    }
    public function overallTest()
    {

        return view("admin.overalltest")
            ->with("medical", Medicals::orderBy("created_at", "DESC")->groupBy("trx_id")->get());
    }
    public function overallPatient()
    {
        return view("admin.overallpatient")
            ->with("todaypatient", Patients::orderBy("created_at", "DESC")->get());
    }

    public function todayPatient()
    {
        return view("admin.todaypatients")
            ->with("todaypatient", Patients::where("created_at", Carbon::now()->toDateString())->get());
    }
    public function changePassword()
    {
        return view("admin.changepassword");
    }
    public function patients()
    {

        return view("admin.allpatients")->with("tests", Patients::all());
    }
    public function todayPatients()
    {

        return view("admin.today.patients")->with("tests", Patients::latest()->whereDate("created_at", Carbon::now())->get());
    }
    public function dashboard()
    {
        $amount_paid = PatientTransactions::select(DB::raw("(sum(amount_paid)) as total_amount_paid"), DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as transaction_date"))
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
            ->limit(5)
            ->get();

        $total_amount_paid = [];
        foreach ($amount_paid as $key => $amount) {
            echo $amount->amount_paid;
            array_push($total_amount_paid, $amount->total_amount_paid);
        }
        return view("admin.dashboard")
            ->with("tests", Patients::orderBy("created_at", "DESC")->get());
    }
    public function login()
    {
        // return request()->all();
        $email =  request()->get("email");
        $password = request()->get("password");
        request()->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email is required',
                'password.required' => 'Password is required'
            ]
        );
        if (Auth::attempt(['email' => $email, 'password' => $password]))
            if (Auth::user()->role == "A")
                return redirect()->to("admin/dashboard");
            else
                return redirect()->back()->with("errmsg", "Unauthorized Access");
        else
            return redirect()->back()->withInput()->with('errmsg', "Incorrect Credentials");
    }

    public function createNewTest()
    {
        return view("admin/newtest");
    }

    public function expenses()
    {
        return view("admin.expenses")->with("expenses", Expenses::orderBy("created_at", "DESC")->get());
    }
}
