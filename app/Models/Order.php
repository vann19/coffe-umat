<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'order_type',
        'payment_method',
        'bank',
        'va_number',
        'biller_code',
        'snap_token',
        'payment_url',
        'paid_at',
    ];

    protected $casts = [
        'total_price' => 'integer',
        'created_at'  => 'datetime',
        'paid_at'     => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /** Label status untuk tampilan */
    public function statusLabel(): string
    {
        return match($this->status) {
            'paid'     => '✅ Lunas',
            'pending'  => '⏳ Menunggu Pembayaran',
            'canceled' => '❌ Dibatalkan',
            'failed'   => '⚠️ Gagal',
            default    => ucfirst($this->status),
        };
    }
}
