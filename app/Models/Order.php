<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\OrderItem;

class Order extends Model
{
    //
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable=[
        'transaction_ref',
        'customer_name',
        'customer_phone',
        'customer_address',
        'total_amount',
        'status',
        'payment_status'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
