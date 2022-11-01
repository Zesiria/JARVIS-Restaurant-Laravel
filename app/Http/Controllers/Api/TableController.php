<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Table;
use Exception;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $tables = Table::all();
        return $tables;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function store(Request $request)
    {
        $table = new Table();
        if($request->has('customer_id') and $request->input('customer_id') != null) {
            $table->setCustomerId((int)$request->input('customer_id'));
            $table->setStatus(false);
        }

        if($request->has('size'))
            $table->setSize((int)$request->input('size'));
        else
            return "Please insert table size";
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
        $table = Table::find($id);
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
    public function update(Request $request, int $id)
    {
        $table = Table::findTableById($id);

        if($request->input('property') == "check-out"){
            $table->checkOut();
            $table->save();
            return $table;
        }

        if($request->input('property') == "check-in"){
            if(!$table->getStatus())
                return "Table is not available";
            if($table->getSize() < (int)$request->input('number_people'))
                return "Number of customer are more than table size !!";
            $customer = new Customer();
            $customer->setNumberPeople((int)$request->input('number_people'));
            $customer->setCode();
            $customer->save();

            $table->checkIn($customer->id);
            $table->save();
            return $table;
        }

        if($request->has('size'))
            $table->setSize((int)$request->input('size'));

        $table->save();
        return $table;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        //
    }
}
