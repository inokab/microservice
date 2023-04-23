<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->enum('shipping_method', [Order::SHIPPING_METHOD_PICKUP, Order::SHIPPING_METHOD_HOME_DELIVERY]);
            $table->enum('status', [Order::STATUS_NEW, Order::STATUS_COMPLETED])->default(Order::STATUS_NEW);
            $table->foreignId('billing_address_id')->nullable();
            $table->foreignId('shipping_address_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
