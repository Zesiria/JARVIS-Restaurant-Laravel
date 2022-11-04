<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $foods = Food::all();
        foreach ($foods as $food){
            $food->img_path = url($food->img_path);
        }
        return $foods;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $food = new Food();
        $this->setFood($food, $request);
        if($food->save()){
            return response()->json([
                'success' => true,
                'message' => 'Food saved successfully with id ' . $food->getId(),
                'food_id' => $food->getId()
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'success' => false,
            'message' => 'Food saved failed'
        ], Response::HTTP_BAD_REQUEST);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $food = Food::findFoodById($id);
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
        $food = Food::findFoodById($id);
        $this->setFood($food, $request);
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

    public function setFood(Food $food, Request $request){
        if($request->has('name'))
            $food->setName($request->input('name'));
        if($request->has('type'))
            $food->setType($request->input('type'));
        if($request->has('quantity'))
            $food->setQuantity((int)$request->input('quantity'));
        if($request->has('price'))
            $food->setPrice((double)$request->input('price'));
        if($request->has('img_path'))
            $food->setImagePath("/storage/".$request->input('img_path'));
    }
}
