<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    private $beveragePrice = 39.0;
    private $pricePerPerson = 219.0;
    private $serviceCharge = 10.0;

    /**
     * @return mixed
     */
    public function getNumberPeople()
    {
        return $this->number_people;
    }

    /**
     * @param mixed $number_people
     */
    public function setNumberPeople($number_people): void
    {
        $this->number_people = $number_people;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode(): void
    {
        $this->code = fake()->lexify("??????");
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'code'
    ];

    public function table(){
        return $this->belongsTo(Table::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $hidden = [
        'remember_token',
    ];

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function getAllCustomer(){
        return Customer::all();
    }

    public static function findCustomerById($id){
        return Customer::find($id);
    }

    public function getId(){
        return $this->id;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function getTotalPrice(){
        return $this->price;
    }

    public function calculatePrice(){
        $totalPrice = 0.0;
        $beveragePrice = $this->beveragePrice * $this->number_people;
        $totalPrice += $this->number_people * $this->pricePerPerson + $beveragePrice;
        $totalPrice += $totalPrice * $this->serviceCharge/100.0;
        $this->setPrice($totalPrice);
    }

    /**
     * @return int
     */
    public function getBeveragePrice(): int
    {
        return $this->beveragePrice;
    }

    /**
     * @param int $beveragePrice
     */
    public function setBeveragePrice(int $beveragePrice): void
    {
        $this->beveragePrice = $beveragePrice;
    }

    /**
     * @return int
     */
    public function getPricePerPerson(): int
    {
        return $this->pricePerPerson;
    }

    /**
     * @param int $pricePerPerson
     */
    public function setPricePerPerson(int $pricePerPerson): void
    {
        $this->pricePerPerson = $pricePerPerson;
    }

    public function getTotalBeveragePrice(){
        return $this->beveragePrice * $this->getNumberPeople();
    }

    public function getBuffetPrice(){
        return $this->pricePerPerson * $this->getNumberPeople();
    }

    public function getServiceChargePrice(){
        return ($this->pricePerPerson * $this->getNumberPeople() + $this->getTotalBeveragePrice()) * $this->serviceCharge/100.0;
    }
}
