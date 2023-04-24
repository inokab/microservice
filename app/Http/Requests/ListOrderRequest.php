<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListOrderRequest extends FormRequest
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
            'id' => [
                'nullable',
                'integer',
                Rule::exists(Order::class, 'id')
            ],
            'status' => [
                'nullable',
                'integer',
                Rule::in([Order::STATUS_NEW, Order::STATUS_COMPLETED])
            ],
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ];
    }
}
