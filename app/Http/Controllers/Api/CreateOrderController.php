<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\CreateOrderResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateOrderController extends Controller
{
    public function __invoke(CreateOrderRequest $request): JsonResource
    {
        $order = new Order();
        $order->name = $request->validated('name');
        $order->email = $request->validated('email');
        $order->shipping_method = $request->validated('shipping_method');
        $order->billing_address_id = $request->validated('billing_address_id');
        $order->shipping_address_id = $request->validated('shipping_address_id');
        $order->save();

        foreach ($request->validated('products') as $product) {
            $order->products()->attach([$product['id']], ['quantity' => $product['quantity']]);
        }

        return new CreateOrderResource($order);
    }
}
