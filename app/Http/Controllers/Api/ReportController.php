<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Food;
use App\Models\FoodOrder;
use App\Models\Report;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ReportController extends Controller
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

        return response()->json([
            'table' => $table->id,
            'number_people' => $customer->getNumberPeople(),
            'buffet_price' => $customer->getBuffetPrice(),
            'beverage_price' => $customer->getTotalBeveragePrice(),
            'service_charge_price' =>  $customer->getServiceChargePrice(),
            'total_price' => $customer->getTotalPrice(),
        ]);
    }

    public function getFoodSale(): array
    {
        $output = array();
        for ($i = 1; $i <= 7; $i++) {
            $arr = array();
            $foods = Food::all();
            foreach ($foods as $food){
                $arr[] = response()->json([
                    "food_name" => $food->getName(),
                    "sale_quantity" => FoodOrder::all()
                        ->where('created_at', '>=' ,now()->shiftTimezone('UTC')->copy()->subDays($i)->startOfDay())
                        ->where('created_at', '<=' ,now()->shiftTimezone('UTC')->copy()->subDays($i)->endOfDay())
                        ->where('food_id', $food->getId())
                        ->sum('quantity')
                ])->original;
            }
            $output[] = response()->json([
                "date" => now()->shiftTimezone('UTC')->subDays($i)->startOfDay()->format("d-m-Y"),
                "data" => $arr
            ])->original;
        }
        return $output;
    }

//    public function  getFoodSaleToday(): array
//    {
//        $foods = Food::all('id', 'name');
//        $food_list = array();
//        foreach ($foods as $food){
//            $food_list[] = response()->json([
//                'id' => $food->id,
//                'name' => $food->name,
//                'quantity' => FoodOrder::all()
//                    ->where('created_at', '>=', now()->startOfDay())
//                    ->where('created_at', '<=', now()->endOfDay())
//                    ->where('food_id', $food->id)
//                    ->sum('quantity')
//            ])->original;
//        }
//        return $food_list;
//    }

//    public function getSaleFoodOneWeekAgo(){
//        $foods = Food::all('id', 'name');
//        $food_list = array();
//        foreach ($foods as $food){
//            $food_list[] = response()->json([
//                'id' => $food->id,
//                'name' => $food->name,
//                'quantity' => FoodOrder::all()
//                    ->where('created_at', '>=', now()->subDays(7)->startOfDay())
//                    ->where('created_at', '<=', now()->endOfDay())
//                    ->where('food_id', $food->id)
//                    ->sum('quantity')
//            ])->original;
//        }
//        return $food_list;
//    }
//
//    public function getFoodSaleAllTime(){
//        $foods = Food::all('id', 'name');
//        $food_list = array();
//        foreach ($foods as $food){
//            $food_list[] = response()->json([
//                'id' => $food->id,
//                'name' => $food->name,
//                'quantity' => FoodOrder::all()
//                    ->where('food_id', $food->id)
//                    ->sum('quantity')
//            ])->original;
//        }
//        return $food_list;
//    }

    public function  getIncomeToday()
    {
        $days = array();
        $day = now()->shiftTimezone("UTC")->startOfDay();
        $days[] = response()->json([
            'date' => $day->format("d-m-Y"),
            'income' => Customer::all()
                ->where('created_at', '>=', $day)
                ->where('created_at', '<=', $day->copy()->endOfDay())
                ->sum('price')
        ])->original;

        for($i = 1;$i < 7;$i++){
            $day = now()->subDays($i)->startOfDay();
            $days[] = response()->json([
                'date' => $day->format("d-m-Y"),
                'income' => Customer::all()
                    ->where('created_at', '>=', $day)
                    ->where('created_at', '<=', $day->copy()->endOfDay())
                    ->sum('price')
            ])->original;
        }

        return array_reverse($days);
    }

    public function  getIncomeWeek()
    {
        $days = array();
        $day = now()->startOfDay();
        $days[] = response()->json([
            'date' => $day,
            'income' => Customer::all()
                ->where('created_at', '>=', $day)
                ->where('created_at', '<=', $day->copy()->endOfDay())
                ->sum('price')
        ])->original;
        for($i = 1;$i < 7;$i++){
            $day = now()->subDays($i)->startOfDay();
            $days[] = response()->json([
                'date' => $day,
                'income' => Customer::all()
                    ->where('created_at', '>=', $day)
                    ->where('created_at', '<=', $day->copy()->endOfDay())
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
                "sale_all_time" => FoodOrder::all()
                    ->where('food_id', $food->getId())
                    ->sum('quantity')
            ])->original;
        }

        return $arr;
    }
}
