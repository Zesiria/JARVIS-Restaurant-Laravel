<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreFoodOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'order_id' => ['required'],
            'food_id' => ['required'],
            'quantity' => ['required']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success'   => false,
                'message'   => 'FoodOrder saved failed',
                'data'      => $validator->errors()
            ], Response::HTTP_BAD_REQUEST));
    }


    public function messages()
    {
        return [
            'order_id.required' => 'order_id is not provided',
            'food_id.required' => 'food_id is not provided',
            'quantity.required' => 'quantity is not provided',
        ];
    }
}
