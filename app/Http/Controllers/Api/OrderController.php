<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\FoodOrder;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $orders = Order::all();
        return $orders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {
        $customer = Customer::find($request->input('customer_id'));
        if(!$customer)
            return "can't find customer id " . (string)$request->input('customer_id');

        $order = new Order();
        $order->customer_id = $request->input('customer_id');
        if($order->save()){
            if($request->has('foodOrders')){
                $foodOrders = ($request->input('foodOrders'));
                foreach ($foodOrders as $foodOrder){
                    $foodOrder_new = new FoodOrder();
                    $foodOrder_new->order_id = $order->id;
                    $foodOrder_new->food_id = $foodOrder['food_id'];
                    $foodOrder_new->quantity = (int)$foodOrder['orderQuantity'];
                    $foodOrder_new->save();
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Order saved successfully with id ' . $order->id,
                'order_id' => $order->id
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'success' => false,
            'message' => 'Order saved failed'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return string
     */
    public function show(int $id)
    {
        $order = Order::find($id);
//        $order_list = FoodOrder::get()->where('order_id', $order->id);
        return $order;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function order_from(int $id){
        $customer_order = CustomerOrder::all()->where("customer_id", $id);
        return $customer_order;
    }
}
