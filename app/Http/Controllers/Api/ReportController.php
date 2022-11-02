<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Food;
use App\Models\FoodOrder;
use App\Models\Report;
use App\Models\Table;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }

    public function getBill(int $table_id): \Illuminate\Http\JsonResponse
    {
        $table = Table::all()->find($table_id);
        $customer = Customer::all()->find($table->customer_id);
        $pricePerPerson = 219.0;
        $beveragePrice = 39.0;
        $serviceCharge = 10.0;
        $priceBeforeCharge = Report::calculatePrice($customer->id, $pricePerPerson, $beveragePrice);
        $totalPrice = $priceBeforeCharge + $serviceCharge/100 * $priceBeforeCharge;
        $customer->price = $totalPrice;
        $customer->save();

        return response()->json([
            'table' => $table->id,
            'number_people' => $customer->number_people,
            'buffet_price' => $pricePerPerson * $customer->number_people,
            'beverage_price' => $beveragePrice * $customer->number_people,
            'add_food' => json_encode([

            ]),
            'service_charge_price' =>  $serviceCharge/100 * $priceBeforeCharge,
            'total_price' => $totalPrice,
        ]);
    }

//    public function getFoodSale(Request $request): array
//    {
//        $start_date = $request->input('start_date');
//        $end_date = $request->input('end_date');
//        $foods = Food::all('id', 'name');
//        $food_list = array();
//        foreach ($foods as $food){
//            $food_list[] = response()->json([
//                'id' => $food->id,
//                'name' => $food->name,
//                'quantity' => FoodOrder::all()
//                    ->where('created_at', '>=', $start_date->startOfDay())
//                    ->where('created_at', '<=', $end_date->endOfDay())
//                    ->where('food_id', $food->id)
//                    ->sum('quantity')
//            ])->original;
//        }
//        return $food_list;
//    }

    public function  getFoodSaleToday(): array
    {
        $foods = Food::all('id', 'name');
        $food_list = array();
        foreach ($foods as $food){
            $food_list[] = response()->json([
                'id' => $food->id,
                'name' => $food->name,
                'quantity' => FoodOrder::all()
                    ->where('created_at', '>=', now()->startOfDay())
                    ->where('created_at', '<=', now()->endOfDay())
                    ->where('food_id', $food->id)
                    ->sum('quantity')
            ])->original;
        }
        return $food_list;
    }

    public function getSaleFoodOneWeekAgo(){
        $foods = Food::all('id', 'name');
        $food_list = array();
        foreach ($foods as $food){
            $food_list[] = response()->json([
                'id' => $food->id,
                'name' => $food->name,
                'quantity' => FoodOrder::all()
                    ->where('created_at', '>=', now()->subDays(7)->startOfDay())
                    ->where('created_at', '<=', now()->endOfDay())
                    ->where('food_id', $food->id)
                    ->sum('quantity')
            ])->original;
        }
        return $food_list;
    }

    public function getFoodSaleAllTime(){
        $foods = Food::all('id', 'name');
        $food_list = array();
        foreach ($foods as $food){
            $food_list[] = response()->json([
                'id' => $food->id,
                'name' => $food->name,
                'quantity' => FoodOrder::all()
                    ->where('food_id', $food->id)
                    ->sum('quantity')
            ])->original;
        }
        return $food_list;
    }

    public function  getIncomeToday()
    {
        $days = array();
        $day = now()->startOfDay();
        $days[] = response()->json([
            'date' => $day,
            'income' => Customer::all()
                ->where('created_at', '>=', $day)
                ->where('created_at', '<=', $day->endOfDay())
                ->sum('price')
        ])->original;
        for($i = 1;$i < 1;$i++){
            $day = now()->subDays($i)->startOfDay();
            $days[] = response()->json([
                'date' => $day,
                'income' => Customer::all()
                    ->where('created_at', '>=', $day)
                    ->where('created_at', '<=', $day->endOfDay())
                    ->sum('price')
            ])->original;
        }

        return $days;
    }

    public function  getIncomeWeek()
    {
        $days = array();
        $day = now()->startOfDay();
        $days[] = response()->json([
            'date' => $day,
            'income' => Customer::all()
                ->where('created_at', '>=', $day)
                ->where('created_at', '<=', $day->endOfDay())
                ->sum('price')
        ])->original;
        for($i = 1;$i < 7;$i++){
            $day = now()->subDays($i)->startOfDay();
            $days[] = response()->json([
                'date' => $day,
                'income' => Customer::all()
                    ->where('created_at', '>=', $day)
                    ->where('created_at', '<=', $day->endOfDay())
                    ->sum('price')
            ])->original;
        }

        return $days;
    }

    public function getReport(){
        $arr = array();
        $foods = Food::all();
        foreach ($foods as $food){
            $arr[] = response()->json([
                "food_name" => $food->getName(),
                "sale_in_a_day" => FoodOrder::all()
                    ->where('created_at', '>=' ,now()->subDays(1)->startOfDay())
                    ->where('created_at', '<=' ,now()->subDays(1)->endOfDay())
                    ->where('food_id', $food->getId())
                    ->sum('quantity'),
                "sale_in_a_week" => FoodOrder::all()
                    ->where('created_at', '>=' ,now()->subDays(7)->startOfDay())
                    ->where('created_at', '<=' ,now()->subDays(1)->endOfDay())
                    ->where('food_id', $food->getId())
                    ->sum('quantity'),
                "sail_all_time" => FoodOrder::all()
                    ->where('food_id', $food->getId())
                    ->sum('quantity')
            ])->original;
        }

        return $arr;
    }
}