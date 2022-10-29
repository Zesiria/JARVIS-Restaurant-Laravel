<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\Food;
use App\Models\FoodOrder;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Collection\Collection;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $order = Order::find($id);
        $order_list = FoodOrder::get()->where('order_id', $order->id);
        $arr = array();

        foreach ($order_list as $item){
            $arr[] = \response()->json([
                'food_id' => $item->food_id,
                'quantity' => $item->quantity
            ])->original;
        }
        return \response()->json([
            'order_id' => $order->id,
            'customer_id' => $order->customer_id,
            'table_id' => Table::all()->where('customer_id', $order->customer_id)->first()->id,
            'status' => $order->status,
            'food_list' => $arr
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        if($request->input('status') == 'accept'){
            $order = Order::find($id);
            $order->status = 'IN PROCESS';
            $order->save();
        }elseif($request->input('status' == 'serve')){
            $order = Order::find($id);
            $order->status = 'COMPLETED';
            $order->save();
        }
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
        $orders = Order::all()->where("customer_id", $id);
        $ordersReturn = array();
        foreach ($orders as $order){
            $food_orders = FoodOrder::all()->where('order_id', $order->id);
            $arr = array();
            foreach ($food_orders as $item){
                $arr[] = \response()->json([
                    'food' => Food::all()->where('id', $item->food_id),
                    'quantity' => $item->quantity
                ])->original;
            }
            $ordersReturn[] = \response()->json([
                'order_id' => $order->id,
                'customer' => $order->customer_id,
                'status' => $order->status,
                'food_list' => $arr
            ])->original;
        }

        return $ordersReturn;



    }

    public function pending_order(): array
    {
        $orders = Order::all()->where('status', 'PENDING')
            ->where('created_at', '>=', now()->startOfDay())
            ->where('created_at', '<=', now()->endOfDay());
        $arr = array();
        foreach ($orders as $order){
            $arr[] = response()->json([
                'order_id' => $order->id,
               'table_id' => Table::all()->where('customer_id', $order->customer_id)->first()->id,
               'quantity' => FoodOrder::all()->where('order_id', $order->id)->count(),
                'date' => $order->created_at
            ])->original;
        }

        return $arr;
    }
}
