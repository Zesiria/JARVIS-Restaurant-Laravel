<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Table;
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
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {
        $table = new Table();
        if($request->has('customer_id') and $request->input('customer_id') != null) {
            $table->customer_id = $request->input('customer_id');
            $table->status = 0;
        }
        else
            $table->customer_id = null;
        if($request->has('size'))
            $table->size = (int)$request->input('size');
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Table $table
     * @return string
     * @throws \Exception
     */
    public function update(Request $request, int $id)
    {
        $table = Table::find($id);

        if($request->input('property') == "check-out"){
            $table->customer_id = null;
            $table->status = 1;
            $table->save();
            return $table;
        }

        if($request->input('property') == "check-in"){
            if(!$table->status)
                return "Table is not available";
//            if(!$request->has('customer_id'))
//                return "Please insert customer";
            if($table->size < (int)$request->input('number_people'))
                return "Number of customer are more than table size !!";
            $customer = new Customer();
            $customer->number_people = (int)$request->input('number_people');
            $customer->code = fake()->lexify("??????");
            $customer->save();

            $table->customer_id = $customer->id;
            $table->status = 0;
            $table->save();
            return $table;
        }

        if($request->has('size'))
            $table->size = (int)$request->input('size');

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
