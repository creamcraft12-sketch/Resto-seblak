<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id','order_code','channel','items','total','address','table_code','midtrans_order_id','qrcode_path','payment_expires_at','status'
    ];

    protected $casts = [
        'payment_expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
