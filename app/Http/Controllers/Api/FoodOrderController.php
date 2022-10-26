<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;
use App\Models\FoodOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class FoodOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $foodOrders = FoodOrder::all();
        return $foodOrders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return FoodOrder
     */
    public function store(Request $request)
    {
        $foodOrder = new FoodOrder();
        $foodOrder->order_id = $request->input('order_id');
        $foodOrder->food_id = $request->input('food_id');
        $foodOrder->quantity = (int)$request->input('quantity');
        $foodOrder->save();

        $customer_order = new CustomerOrder();
        $customer_order->customer_id = Order::find($foodOrder->order_id)->customer_id;
        $customer_order->order_id = $foodOrder->order_id;
        $customer_order->food_id = $foodOrder->food_id;
        $customer_order->save();

        return $foodOrder;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FoodOrder  $foodOrder
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $foodOrder = FoodOrder::find($id);
        return $foodOrder;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FoodOrder  $foodOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodOrder $foodOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FoodOrder  $foodOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodOrder $foodOrder)
    {
        //
    }
}
