<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food = Food::get();
        return $food;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Food
     */
    public function store(Request $request)
    {
        $food = new Food();
        $food->name = $request->input('name');
        $food->type = $request->input('type');
        $food->quantity = (int)$request->input('quantity');
        $food->save();

        return $food;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $food = Food::find($id);
        return $food;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $food = Food::find($id);
        if($request->has('name'))
            $food->name = $request->input('name');
        if($request->has('type'))
            $food->type = $request->input('type');
        if($request->has('quantity'))
            $food->quantity = (int)$request->input('quantity');
        if($request->has('price'))
            $food->quantity = (double)$request->input('price');
        $food->save();
        return $food;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        //
    }
}
