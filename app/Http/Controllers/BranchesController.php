<?php

namespace App\Http\Controllers;

use App\Branches;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    public function index()
    {

        return view("admin.branches")->with("branches", Branches::all());
    }

    public function show()
    {
        return view("admin.newbranch");
    }

    public function store()
    {
        request()->validate([
            'name' => 'required'
        ], [
            'name.required' => "Name is required"
        ]);
        Branches::create(['name' => request()->get('name')]);
        return redirect()->to("admin/branches")->with("msg", "Branch Created Successfully.");
    }

    public function edit($id)
    {
        return view('admin.editbranch')->with('branch', Branches::find($id));
    }
    public function update($id)
    {
        Branches::where('id', $id)->update(['name' => request()->get('name')]);
        return redirect()->back()->with("msg", "Branch Updated Successfully.");
    }

    public function destroy($id)
    {
        Branches::where('id', $id)->delete();
        return redirect()->back()->with("msg", "Branch Deleted Successfully.");
    }
}
