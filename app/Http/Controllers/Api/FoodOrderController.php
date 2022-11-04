<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;
use App\Models\FoodOrder;
use App\Models\Order;
use App\Models\Table;
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
        $foodOrder->setOrderId($request->input('order_id'));
        $foodOrder->setFoodId($request->input('food_id'));
        $foodOrder->setQuantity((int)$request->input('quantity'));
        $foodOrder->save();

        $customer_order = new CustomerOrder();
        $customer_order->customer_id = Order::findOrderById($foodOrder->getOrderId())->getCustomerId();

        $table = Table::findTableByCustomerId($customer_order->customer_id);
        if($table)
            $customer_order->table_id = $table->getId();
        $customer_order->order_id = $foodOrder->getOrderId();
        $customer_order->food_id = $foodOrder->getFoodId();
        $customer_order->quantity = $foodOrder->getQuantity();
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
