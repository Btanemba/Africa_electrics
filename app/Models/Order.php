<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use CrudTrait;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'notes',
        'status',
        'assigned_to',
        'total_amount',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public static function generateOrderNumber(): string
    {
        do {
            $number = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        } while (self::where('order_number', $number)->exists());

        return $number;
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getDeliveryAddressShort(): string
    {
        return collect([$this->address, $this->city, $this->state])->filter()->implode(', ');
    }

    public function getItemsHtml(): string
    {
        $rows = $this->items->map(function ($item) {
            $subtotal = number_format($item->unit_price * $item->quantity, 2);
            return "<tr><td style='padding:6px 12px;border-bottom:1px solid #e5e7eb;'>{$item->product_name}</td><td style='padding:6px 12px;border-bottom:1px solid #e5e7eb;text-align:center;'>{$item->quantity}</td><td style='padding:6px 12px;border-bottom:1px solid #e5e7eb;text-align:right;'>\${$item->unit_price}</td><td style='padding:6px 12px;border-bottom:1px solid #e5e7eb;text-align:right;'>\${$subtotal}</td></tr>";
        })->implode('');

        return "<table style='width:100%;border-collapse:collapse;'><thead><tr style='background:#f3f4f6;'><th style='padding:8px 12px;text-align:left;'>Product</th><th style='padding:8px 12px;text-align:center;'>Qty</th><th style='padding:8px 12px;text-align:right;'>Unit Price</th><th style='padding:8px 12px;text-align:right;'>Subtotal</th></tr></thead><tbody>{$rows}</tbody></table>";
    }
}
