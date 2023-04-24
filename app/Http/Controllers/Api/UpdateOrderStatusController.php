<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\Order;
use Illuminate\Http\Response;

class UpdateOrderStatusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateOrderStatusRequest $request): Response
    {
        $order = Order::findOrFail($request->validated('id'));
        $order->status = $request->validated('status');
        $order->save();

        return response(status: 204);
    }
}
