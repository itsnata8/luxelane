<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'percent_amount',
        'expire_date',
        'status',
        'is_delete',
    ];
}
