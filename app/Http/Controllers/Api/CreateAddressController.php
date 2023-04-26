<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAddressRequest;
use App\Http\Resources\CreateAddressResource;
use App\Models\Address;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateAddressController extends Controller
{
    public function __invoke(CreateAddressRequest $request): JsonResource
    {
        $address = Address::create($request->validated());

        return new CreateAddressResource($address);
    }
}
