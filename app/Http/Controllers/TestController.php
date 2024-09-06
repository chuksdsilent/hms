<?php

namespace App\Http\Controllers;

use App\Tests;
use Carbon\Traits\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        request()->validate([
            'name' => 'required',
            'price' => 'required'
        ], [
            'name.required' => 'Name is required',
            'price.required' => 'Price is required'
        ]);

        if (Tests::where('name', request()->get('name'))->exists())
            return redirect()->back()->with("msg", "Test Exists Successfully.");

        request()->request->add(["created_by" => "None"]);
        Tests::create(request()->all());

        return redirect("/admin/tests")->with("msg", "Test Created Successfully.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tests  $tests
     * @return \Illuminate\Http\Response
     */
    public function show(Tests $tests)
    {
        $tests = Tests::latest()->get();
        return view('admin.test')->with('tests', $tests);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tests  $tests
     * @return \Illuminate\Http\Response
     */
    public function edit(Tests $tests, $id)
    {

         $tests = Tests::findOrFail($id);
        return view("admin.editTest")->with("tests", $tests);
    }

    public function getPrice($id)
    {
        $price = Tests::where("id", $id)->value("price");

        return response()->json(["price" => $price], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tests  $tests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tests $tests, $id)
    {
        request()->request->add(["created_by" => "None"]);

        $tests = Tests::find($id);
        $tests->update($request->all());

        return redirect()->back()->with('msg', 'Test Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tests  $tests
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tests $tests, $id)
    {

        $tests = Tests::find($id);
        $tests->delete();
        return redirect()->back()->with('msg', 'Test deleted Successfully');
    }
}
