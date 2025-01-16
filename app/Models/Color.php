<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'created_by',
        'status',
        'is_delete',
    ];

    public function getAllColors()
    {
        return Color::where('is_delete', 0)->where('status', 1)->paginate(10);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
