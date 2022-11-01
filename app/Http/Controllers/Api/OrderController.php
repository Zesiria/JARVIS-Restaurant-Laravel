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
use PhpParser\Node\Expr\Array_;
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
        $customer = Customer::findCustomerById($request->input('customer_id'));
        if(!$customer)
            return "can't find customer id " . (string)$request->input('customer_id');

        $order = new Order();
        $order->setCustomerId($request->input('customer_id'));
        if($order->save()){
            if($request->has('foodOrders')){
                $foodOrders = ($request->input('foodOrders'));
                foreach ($foodOrders as $foodOrder){
                    $foodOrder_new = new FoodOrder();
                    $foodOrder_new->order_id = $order->getId();
                    $foodOrder_new->food_id = $foodOrder['food_id'];
                    $foodOrder_new->quantity = (int)$foodOrder['orderQuantity'];
                    $foodOrder_new->save();
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Order saved successfully with id ' . $order->getId(),
                'order_id' => $order->getId()
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
        $order = Order::findOrderById($id);
        $order_list = FoodOrder::get()->where('order_id', $order->getId());
        $arr = array();

        foreach ($order_list as $item){
            $arr[] = \response()->json([
                'food_id' => $item->food_id,
                'quantity' => $item->quantity
            ])->original;
        }
        return \response()->json([
            'order_id' => $order->getId(),
            'customer_id' => $order->getCustomerId(),
            'table_id' => Table::findTableByCustomerId($order->getCustomerId())->getId(),
            'status' => $order->getStatus(),
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
        $order = Order::findOrderById($id);
        if($request->input('status') == 'accept'){
            $order->accept();
            $order->save();
        }elseif($request->input('status') == 'serve'){
            $order->serve();
            $order->save();
        }return $order;
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

    public function order_from(int $customer_id){
        $orders = Order::getOrderFromCustomer($customer_id);
        $ordersReturn = array();
        foreach ($orders as $order){
            $food_orders = FoodOrder::all()->where('order_id', $order->getId());
            $arr = array();
            foreach ($food_orders as $item){
                $arr[] = \response()->json([
                    'food' => Food::where('id', $item->food_id)->first(),
                    'quantity' => $item->quantity
                ])->original;
            }
            $ordersReturn[] = \response()->json([
                'order_id' => $order->getId(),
                'customer' => $order->getCustomerId(),
                'status' => $order->getStatus(),
                'food_list' => $arr,
                'order_created_at' => $order->getCreatedDate()
            ])->original;
        }
        return $ordersReturn;
    }

    public function pending_order(): array
    {
        $orders = Order::getPendingOrder();
        $arr = array();
        foreach ($orders as $order){
            $arr[] = response()->json([
                'order_id' => $order->getId(),
                'table_id' => Table::findTableByCustomerId($order->getCustomerId())->getId(),
                'quantity' => FoodOrder::all()->where('order_id', $order->getId())->count(),
                'status' => $order->getStatus(),
                'date' => $order->getCreatedDate()
            ])->original;
        }

        return $arr;
    }
}
