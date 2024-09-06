<?php

namespace App\Http\Controllers;

use App\Medicals;
use App\PatientReferral;
use App\Patients;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Parent_;
use DB;

class SearchController extends Controller
{
    public function search()
    {
        return view("client.search");
    }
    public function adminSearch()
    {
        return view("admin.search");
    }
    public function searchItem()
    {

        $searchitem = request()->get("searchitem");
        $startdate = request()->get("startdate");
        $enddate = request()->get("enddate");


        if ($searchitem != "") {
            if ($startdate != "" && $enddate != "") {

                $data = Medicals::where(function ($q) use ($startdate, $enddate, $searchitem) {

                    $q->whereBetween('medicals.created_at', [$startdate, $enddate])
                        ->where("patients.pat_id", $searchitem)
                        ->orWhere("patients.first_name", "like", "%" .  $searchitem . "%")
                        ->orWhere("patients.last_name", "like", "%" .  $searchitem . "%")
                        ->orWhere("patients.phone", "like", "%" .  $searchitem . "%")
                        ->orWhere("patient_referral.referred_by", "like", "%" .  $searchitem . "%");
                })
                    ->leftJoin("patients", "medicals.patients_id", "=", "patients.id")
                    ->join("patient_referral", "medicals.trx_id", "=", "patient_referral.trx_id")
                    ->join("tests", "medicals.tests_id", "=", "tests.id")
                    ->select('medicals.*',  "first_name", "last_name",  "age", "referred_by", "phone", "name", "medicals.price", "medicals.trx_id", "medicals.created_at", "patients.id")
                    ->get()
                    ->groupBy(function (Medicals $item) {
                        return $item->trx_id;
                    });
            } else {

                $data = Medicals::where(function ($q) use ($startdate, $enddate, $searchitem) {


                    $q->where("patients.pat_id", $searchitem)
                        ->orWhere("patients.first_name", "like", "%" .  $searchitem . "%")
                        ->orWhere("patients.last_name", "like", "%" .  $searchitem . "%")
                        ->orWhere("patients.phone", "like", "%" .  $searchitem . "%")
                        ->orWhere("patient_referral.referred_by", "like", "%" .  $searchitem . "%");


                    // ->orWhere("patient_referral.referred_by", "like", "%" .  $searchitem . "%");
                })
                    ->leftJoin("patients", "medicals.patients_id", "=", "patients.id")
                    ->join("patient_referral", "medicals.trx_id", "=", "patient_referral.trx_id")
                    ->join("tests", "medicals.tests_id", "=", "tests.id")
                    ->select('medicals.*',  "first_name", "last_name", "age", "referred_by", "phone", "name", "medicals.price", "medicals.trx_id", "medicals.created_at", "patients.id")
                    ->get()
                    ->groupBy(function (Medicals $item) {
                        return $item->trx_id;
                    });
            }
        } else {


            $data = Medicals::join("patient_referral", "medicals.trx_id", "=", "patient_referral.trx_id")
                ->where(function ($q) use ($startdate, $enddate) {
                    $q->whereBetween('medicals.created_at', [$startdate, $enddate])->get();
                })
                // I select all fields from medicals table. You might want to update this later.
                ->select('medicals.*',  "first_name", "last_name", "age", "referred_by", "phone", "name", "medicals.price", "medicals.trx_id", "medicals.created_at", "patients.id")
                ->leftJoin("patients", "medicals.patients_id", "=", "patients.id")
                ->join("tests", "medicals.tests_id", "=", "tests.id")
                ->get()
                ->groupBy(function (Medicals $item) {
                    return $item->trx_id;
                });
        }
        $table = "";
        $sid = 1;
        if ($data->isNotEmpty() > 0) {
            $total = 0;
            foreach ($data as $month => $medicals) {


                foreach ($medicals as $item) {

                    $table .= "
                            <tr>

                                <td>" . $sid++ . "</td>
                                <td>" . $item->first_name . " " . $item->last_name . "</td>
                                <td>" . $item->referred_by . "</td>
                                <td>" . $item->phone . "</td>
                                <td>" . $item->name . "</td>
                                <td>N" . $item->price . "</td>
                                <td>" . Carbon::parse($item->created_at)->format("d M, Y") . "</td>
                                
                                <td>   <a href='test/edit/$item->tests_id?thedate=$item->created_at'
                                            class='btn btn-danger btn-edit'>Delete</a></td>
                            </tr>
                        ";
                    $total +=  $item->price;
                }
            }

            $table .= "
                    <tr>
                        <td colspan='5'  class='font-weight-bolder'>Total</td>
                        <td class='font-weight-bolder'>N" . $total . "</td>
                        <td></td>
                        <td></td>
                    </tr>";
        } else {
            return "noresult";
        }

        return ["table" => $table, "total" => "N" . $total];
    }

    public function searchTable($medicals, $table, $sid, $total, $item)
    {
        $table .= "
            <tr>

                <td>" . $sid++ . "</td>
                <td>" . $item->first_name . " " . $item->last_name . "</td>
                <td>" . $item->referred_by . "</td>
                <td>" . $item->phone . "</td>
                <td>" . $item->name . "</td>
                <td>N" . $item->price . "</td>
                <td>   <a href={{url('admin/test/edit/'. $item->id)}}
                            class='btn btn-success btn-edit'>Edit</a></td>
                <td>" . Carbon::parse($item->created_at)->format("d M, Y") . "</td>
            </tr>
        ";
        $total +=  $item->price;
    }

    public function getInfo($id)
    {
        $first_name = Patients::where("pat_id", $id)->orWhere("phone", $id)->value("first_name");
        $last_name = Patients::where("pat_id", $id)->orWhere("phone", $id)->value("last_name");
        $dateofbirth = Patients::where("pat_id", $id)->orWhere("phone", $id)->value("age");
        $phone = Patients::where("pat_id", $id)->orWhere("phone", $id)->value("phone");

        return response()->json(['first_name' => $first_name, 'last_name' => $last_name, 'dateofbirth' => $dateofbirth, 'phone' => $phone], 200);
    }
}
