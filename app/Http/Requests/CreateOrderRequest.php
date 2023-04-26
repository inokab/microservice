<?php

namespace App\Http\Requests;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrderRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'shipping_method' => [
                'required',
                'string',
                Rule::in([Order::SHIPPING_METHOD_PICKUP, Order::SHIPPING_METHOD_HOME_DELIVERY]),
            ],
            'billing_address_id' => [
                'required',
                'integer',
                Rule::exists(Address::class, 'id'),
            ],
            'shipping_address_id' => [
                'required',
                'integer',
                Rule::exists(Address::class, 'id'),
            ],
            'products.*.id' => [
                'required',
                'integer',
                Rule::exists(Product::class, 'id')
            ],
            'products.*.quantity' => 'required|integer',
        ];
    }
}
