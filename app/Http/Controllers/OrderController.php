<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = DB::select("SELECT 
                (SELECT name from users where id = orders.sitter_id) as sitterName,
                (SELECT name from users where id = orders.customer_id) as cusName,
                orders.hoursPerDay, orders.from, orders.to from orders");

        return $orders;
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

    public function ordersHistory($id){
        return Order::where('customer_id', $id)->get();
    }

    public function sittersOrderHistory($id){
        return Order::where('sitter_id', $id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $from=strtotime($request['from']);
        $from=date("Y-m-d",$from);
        $to=strtotime($request['to']);
        $to=date("Y-m-d",$to);
        
        return Order::create([
            'sitter_id' => 1,
            'customer_id' => 2,
            'from' => $from,
            'to' => $to,
            'hoursPerDay' => $request['hours'],
            'phone' => $request['phone'],
            'address' => $request['city'],
            'proposal' => $request['addition'],
        ]);
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
        return Order::find($id);
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
        return Order::find($id)->delete();
    }
}
