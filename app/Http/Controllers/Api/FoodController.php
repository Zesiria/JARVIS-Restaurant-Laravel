<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use Illuminate\Http\Response;
use Illuminate\Http\Request;


class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        $foods = Food::getAllFood();
        foreach ($foods as $food){
            $food->setImgPath(url($food->getImgPath()));
        }
        return FoodResource::collection($foods)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreFoodRequest $request)
    {
        $request->validated();
        $food = new Food();
        $food->setName($request->get('name'));
        $food->setType($request->get('type'));
        $food->setQuantity((int)$request->get('quantity'));
        $food->setImgPath($request->get('img_path'));
        $food->save();
        return response()->json([
            'success' => true,
            'message' => 'Food saved successfully with id ' . $food->getId(),
            'food_id' => $food->getId()
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function show($id)
    {
        $food = Food::findFoodById($id);
        if(!$food){
            return response()->json(null,Response::HTTP_NOT_FOUND);
        }
        return $food;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFoodRequest $request, int $id)
    {
        $request->validated();
        $food = Food::findFoodById($id);
        $food->setName($request->get('name'));
        $food->setType($request->get('type'));
        $food->setQuantity((int)$request->get('quantity'));
        $food->setImgPath($request->get('img_path'));
        $food->save();
        return $food;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return response()->json([
            "success" => false,
            "message" => "can't delete food"
        ], Response::HTTP_BAD_REQUEST);
    }
}
