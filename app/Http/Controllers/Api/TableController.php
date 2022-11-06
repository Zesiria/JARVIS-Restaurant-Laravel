<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Http\Resources\TableResource;
use App\Models\Customer;
use App\Models\Table;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        return TableResource::collection(Table::getAllTable())->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function store(StoreTableRequest $request)
    {
        $request->validated();
        $table = new Table();
        $table->setSize($request->get('size'));
        $table->save();
        return $table;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $table = Table::findTableById($id);
        if(!$table){
            return response()->json(null,Response::HTTP_NOT_FOUND);
        }
        return $table;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\Table $table
     * @return string
     * @throws Exception
     */
    public function update(UpdateTableRequest $request, int $id)
    {
        $request->validated();
        $table = Table::findTableById($id);

        if($request->get('property') == "check-out"){
            $customer = Customer::findCustomerById($table->getCustomerId());
            $customer->code = null;
            $customer->save();
            $table->checkOut();
            $table->save();
            return $table;
        }

        if($request->get('property') == "check-in"){
            if(!$request->has('number_people')){
                throw new HttpResponseException(
                    response()->json([
                        'success'   => false,
                        'message'   => 'Please enter number_people',
                    ], Response::HTTP_BAD_REQUEST));
            }

            if((int)$request->get('number_people') > $table->getSize()){
                throw new HttpResponseException(
                    response()->json([
                        'success'   => false,
                        'message'   => 'number_people must be less than table size',
                    ], Response::HTTP_BAD_REQUEST));
            }
        }

        $customer = new Customer();
        $customer->setNumberPeople((int)$request->get('number_people'));
        $customer->setCode();
        $customer->calculatePrice();
        $customer->save();
        $table->checkIn($customer->getId());
        $table->save();
        return $table;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Table $table)
    {
        return response()->json([
            "success" => false,
            "message" => "can't delete table"
        ], Response::HTTP_BAD_REQUEST);
    }
}
