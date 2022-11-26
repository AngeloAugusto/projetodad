<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /******RECEBER CUSTOMER (GET)*****/
        return Customer::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /******CRIAR CUSTOMER (POST)*****/
        $newCustomer = new Customer();
        $newCustomer->user_id = $request->customer["user_id"];
        $newCustomer->phone = $request->customer["phone"];
        $newCustomer->points = $request->customer["points"];
        $newCustomer->nif = $request->customer["nif"];
        $newCustomer->default_payment_type = $request->customer["default_payment_type"];
        $newCustomer->default_payment_reference = $request->customer["default_payment_reference"];

        $newCustomer->save();

        return $newCustomer;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingCustomer = Customer::find( $id );
        if($existingCustomer){
            $existingCustomer->delete();
            return "Customer successfully deleted";
        }
        return "Customer not found";
    }
}
