<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListOrderRequest;
use App\Http\Resources\ListOrderResource;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ListOrderRequest $request): AnonymousResourceCollection
    {
        $orders = Order::with('products')
            ->when($request->validated('id'), function (Builder $query) use ($request) {
                $query->where('id', $request->validated('id'));
            })
            ->when($request->validated('status'), function (Builder $query) use ($request) {
                $query->where('status', $request->validated('status'));
            })
            ->when($request->validated('start_date'), function (Builder $query) use ($request) {
                $query->where('created_at', '>=', $request->validated('start_date'));
            })
            ->when($request->validated('end_date'), function (Builder $query) use ($request) {
                $query->where('created_at', '<=', $request->validated('end_date'));
            }, function (Builder $query) {
                $query->where('created_at', '<=', now());
            })
            ->get();

        return ListOrderResource::collection($orders);
    }
}
