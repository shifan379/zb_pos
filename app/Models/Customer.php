<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'province',
        'image',
        'status',
        'purchase_count',
        'purchase_total_value',
        'loyalty_points',
    ];


    public function summer()
    {
        return $this->hasMany(CustomerSheet::class, 'CustomerID', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class); // assumes your Order model is App\Models\Order
    }

}
