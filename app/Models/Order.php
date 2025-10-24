<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'uttt_order';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'note',
        'status',
        'user_id', // ⚠️ phải có dòng này

    ];
    public function orderDetails()
{
    return $this->hasMany(OrderDetail::class);
}

}
