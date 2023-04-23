<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $products = Product::factory(10)->create();

        Order::factory(2)
            ->create()
            ->each(function (Order $order) use ($products) {
                $order->products()->attach($products->random(2), ['quantity' => 1]);
                $billingAddress = Address::factory()->create(['type' => Address::TYPE_BILLING_ADDRESS]);
                $shippingAddress = Address::factory()->create(['type' => Address::TYPE_SHIPPING_ADDRESS]);
                $order->billing_address_id = $billingAddress->id;
                $order->shipping_address_id = $shippingAddress->id;
                $order->save();
            });
    }
}
