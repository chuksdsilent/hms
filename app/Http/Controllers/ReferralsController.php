<?php

namespace App\Http\Controllers;

use App\Referrals;
use Illuminate\Http\Request;
use App\Departments;
class ReferralsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view("admin.referrals")->with("referrals", Referrals::orderBy('created_at', 'DESC')->get());
    }

    public function department(){
        return view("admin.departments")->with("department", Departments::all());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.newreferral");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Name is required'
        ]);
        if (Referrals::where("name", $request->get("name"))->exists())
            return redirect()->back()->withInput()->with("msg", "Referral Exists Already.");
        Referrals::create($request->except("_token"));
        return redirect()->to("admin/referrals")->with("msg", "Submitted Successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view("admin.editReferral")->with("referral", Referrals::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Referrals::where("id", $id)->update(['name' => request()->get("name")]);
        return redirect()->to("admin/referrals")->with("msg", "Update Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Referrals::destroy($id);
        return redirect()->back()->withInput()->with("msg", "Deleted Successfully.");
    }
}
