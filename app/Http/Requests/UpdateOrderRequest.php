<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateOrderRequest extends FormRequest
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
            'status' => ['required']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success'   => false,
                'message'   => 'Order updated failed',
                'data'      => $validator->errors()
            ], Response::HTTP_BAD_REQUEST));
    }


    public function messages()
    {
        return [
            'status.required' => 'status is not provided'
        ];
    }
}
