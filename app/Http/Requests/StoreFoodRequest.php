<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreFoodRequest extends FormRequest
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
            'name' => ['required'],
            'type' => ['required'],
            'quantity' => ['required'],
            'img_path' => ['required']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success'   => false,
                'message'   => 'Food saved failed',
                'data'      => $validator->errors()
            ], Response::HTTP_BAD_REQUEST));
    }


    public function messages()
    {
        return [
            'name.required' => 'name is not provided',
            'type.required' => 'type is not provided',
            'quantity.required' => 'quantity is not provided',
            'img_path' => 'img_path is not provided'
        ];
    }
}
