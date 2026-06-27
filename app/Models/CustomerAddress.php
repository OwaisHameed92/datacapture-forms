<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'type',
        'line1',
        'line2',
        'line3',
        'city',
        'state',
        'postcode',
        'country',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
