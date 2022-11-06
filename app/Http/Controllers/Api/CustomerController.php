<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
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
        return CustomerResource::collection(Customer::getAllCustomer())->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCustomerRequest $request)
    {
        $request->validated();
        $customer = new Customer();
        $customer->setNumberPeople((int)$request->get('number_people'));
        $customer->setCode();
        $customer->calculatePrice();
        $customer->save();
        return response()->json([
            'success' => true,
            'message' => 'Customer saved successfully with id ' . $customer->getId(),
            'customer_id' => $customer->getId()
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $customer = Customer::findCustomerById($id);
        if(!$customer)
            return response()->json(null,Response::HTTP_NOT_FOUND);
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCustomerRequest $request, int $id)
    {
        $request->validated();
        $customer = Customer::findCustomerById($id);
        $customer->setNumberPeople($request->get('number_people'));
        $customer->save();
        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        return response()->json([
            "success" => false,
            "message" => "can't delete food"
        ], Response::HTTP_BAD_REQUEST);
    }
}
