<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::orderBy('created_at', 'DESC')->get();
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
        $newOrder = new Order();
        $newOrder->status = $request->order["status"];
        $newOrder->ticket_number = $request->order["ticket_number"];
        $newOrder->customer_id = $request->order["customer_id"];
        $newOrder->total_price = $request->order["total_price"];
        $newOrder->total_paid = $request->order["total_paid"];
        $newOrder->total_paid_with_points = $request->order["total_paid_with_points"];
        $newOrder->points_gained = $request->order["points_gained"];
        $newOrder->points_used_to_pay = $request->order["points_used_to_pay"];
        $newOrder->payment_type = $request->order["payment_type"];
        $newOrder->payment_reference = $request->order["payment_reference"];
        $newOrder->date = $request->order["date"];
        $newOrder->delivered_by = $request->order["delivered_by"];

        $newOrder->save();

        return $newOrder;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
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
        /****MODIFICAR VALOR****/
        $existingOrder = Order::find( $id );

        //VERIFICAMOS SE O PRODUTO EXISTE E MODAMOS O VALOR DO PRECO
        //EXISTE
        if( $existingOrder ){
            $existingOrder->status = $request->product['status'];
            //carbon set the date and time
            $existingOrder->updated_at = Carbon::now();
            $existingOrder->save();
            return $existingOrder;
        }
        //NAO EXISTE
        return "Order not found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingOrder = Order::find( $id );
        if($existingOrder){
            $existingOrder->delete();
            return "Order successfully deleted";
        }
        return "Order not found";
    }
}
