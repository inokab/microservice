<?php

namespace App\Http\Requests;

use App\Models\Address;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAddressRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'zip_code' => 'required|string|max:32',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'type' => [
                'required',
                'string',
                Rule::in([Address::TYPE_BILLING_ADDRESS, Address::TYPE_SHIPPING_ADDRESS]),
            ],
        ];
    }
}
