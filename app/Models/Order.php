<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total', 'status','shipping_address','comprobante','comments'];

    public static function getStatuses()
    {
        return ['pending', 'processing', 'shipped', 'delivered', 'completed', 'cancelled'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
