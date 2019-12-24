<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomersModel;
use DB;
class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = CustomersModel::latest()->get();
   

        return view('customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = CustomersModel::all();
        return view('customers.create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customers = new CustomersModel;

        $request->validate([
          'customerid' => 'required',
          'customerFirstName' => 'required',
          'customerLastName' => 'required',
          'customerphone'=>'required',
          'customeraddress' => 'required'
        ]);
        $customers->customerid = $request->customerFirstName;
        $customers->customerFirstName = $request->customerFirstName;
        $customers->customerLastName = $request->customerLastName;
        $customers->customerphone = $request->customerphone;
        $customers->customeraddress = $request->customeraddress;
        $customers->save();

        return redirect()->route('customers.index')
                        ->with('success','Customer created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customers = CustomersModel::find($id);
        return view('customers.show',compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = CustomersModel::find($id);

        return view("customers.edit",compact('customers'));
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
        $customers = CustomersModel::find($id);

        $request->validate([
            'customerid' =>'required',
            'customerFirstName' => 'required',
            'customerLastName' => 'required',
            'customerphone'=>'required',
            'customeraddress' => 'required'
          ]);

          
          $customers->customerid = $request->customerid;
          $customers->customerFirstName = $request->customerFirstName;
          $customers->customerLastName = $request->customerLastName;
          $customers->customerphone = $request->customerphone;
          $customers->customeraddress = $request->customeraddress;
        $customers->update();

        return redirect()->route('customers.index')
                        ->with('success','Customer update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($customerid)
    {
        $customers = CustomersModel::find($customerid);

        $customers->delete();
        return redirect()->route('customers.index')
                        ->with('success','Customer delete successfully.');
    }
}
