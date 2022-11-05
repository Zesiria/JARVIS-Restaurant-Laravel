<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreOrderRequest extends FormRequest
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
            'customer_id' => ['required'],
            'foodOrders' => ['required']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success'   => false,
                'message'   => 'Order saved failed',
                'data'      => $validator->errors()
            ], Response::HTTP_BAD_REQUEST));
    }


    public function messages()
    {
        return [
            'customer_id.required' => 'customer_id is not provided',
            'foodOrders.required' => 'foodOrders is not provided'
        ];
    }
}
