<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $data = [

            'recipient_name' => 'required|string',
            'recipient_phone' => 'required|numeric|min_digits:11|max_digits:11',
            'recipient_S_phone' => 'numeric|min_digits:11|max_digits:11',
            'r_city_id' => 'required',
            'recipient_email' => 'required|email',
            
            'package_weight' => 'required|numeric',
            'package_type' => 'required|string',
            'shipping_option' => 'required|string',
            'collected_price' => 'numeric',
        ];
        if(!Auth::user()){
            $data = $data+ [
                'sender_name' => 'required |string',
                'sender_phone' => 'required|numeric|min_digits:11|max_digits:11',
                'sender_S_phone' =>'numeric|min_digits:11|max_digits:11',
                'city_id' => 'required',
                'sender_email' => 'required|email',
            ];

        }
        return $data;
    }
}
