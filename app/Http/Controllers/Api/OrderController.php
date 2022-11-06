<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\Food;
use App\Models\FoodOrder;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpParser\Node\Expr\Array_;
use Ramsey\Collection\Collection;

class OrderController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (auth('api')->check()){
            $this->middleware('auth:api');
        }
        else {
            $this->middleware('auth:customer');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        return OrderResource::collection(Order::getAllOrder())->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(StoreOrderRequest $request)
    {
        $request->validated();
        $customer = Customer::findCustomerById($request->get('customer_id'));
        if(!$customer){
            throw new HttpResponseException(
                response()->json([
                    'success'   => false,
                    'message'   => "can't find customer id " . $request->get('customer_id')
                ], Response::HTTP_BAD_REQUEST));
        }


        $order = new Order();
        $order->setCustomerId($request->get('customer_id'));
        $order->save();
        $foodOrders = ($request->get('foodOrders'));
        foreach ($foodOrders as $foodOrder){
            $foodOrder_new = new FoodOrder();
            $foodOrder_new->order_id = $order->getId();
            $foodOrder_new->food_id = $foodOrder['food_id'];
            $foodOrder_new->quantity = (int)$foodOrder['orderQuantity'];

            $food = Food::findFoodById($foodOrder_new->food_id);
            $food->reduceQuantityFood($foodOrder_new->quantity);
            $food->save();
            $foodOrder_new->save();

            $customer_order = new CustomerOrder();
            $customer_order->customer_id = Order::findOrderById($foodOrder_new->getOrderId())->getCustomerId();
            $table = Table::findTableByCustomerId($customer_order->customer_id);
            if($table)
                $customer_order->table_id = $table->getId();
            $customer_order->order_id = $foodOrder_new->getOrderId();
            $customer_order->food_id = $foodOrder_new->getFoodId();
            $customer_order->quantity = $foodOrder_new->getQuantity();
            $customer_order->save();
        }



        return response()->json([
            'success' => true,
            'message' => 'Order saved successfully with id ' . $order->getId(),
            'order_id' => $order->getId()
        ], Response::HTTP_CREATED);

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
    public function update(UpdateOrderRequest $request, int $id)
    {
        $request->validated();
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        return response()->json([
            "success" => false,
            "message" => "can't delete order"
        ], Response::HTTP_BAD_REQUEST);
    }

    public function order_from(int $customer_id){
        $orders = Order::getOrderFromCustomer($customer_id);
        $ordersReturn = array();
        foreach ($orders as $order){
            $food_orders = FoodOrder::all()->where('order_id', $order->getId());
            $arr = array();
            foreach ($food_orders as $item){
                $arr[] = \response()->json([
                    'food' => Food::findFoodById($item->getFoodId()),
                    'quantity' => $item->getQuantity()
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
