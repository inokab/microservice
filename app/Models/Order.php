<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    const SHIPPING_METHOD_PICKUP = 'pickup';

    const SHIPPING_METHOD_HOME_DELIVERY = 'home_delivery';

    const STATUS_NEW = 'new';

    const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'name',
        'email',
        'shipping_method',
        'status',
        'billing_address_id',
        'shipping_address_id',
    ];

    public function billingAddress(): HasOne
    {
        return $this->hasOne(Address::class, 'id', 'billing_address_id')
            ->whereType(Address::TYPE_BILLING_ADDRESS);
    }

    public function shippingAddress(): HasOne
    {
        return $this->hasOne(Address::class, 'id', 'shipping_address_id')
            ->whereType(Address::TYPE_SHIPPING_ADDRESS);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function getTotalPriceAttribute(): float|int
    {
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $totalPrice+= $product->price * $product->pivot->quantity;
        }

        return $totalPrice;
    }
}
