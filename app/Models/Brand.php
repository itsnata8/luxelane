<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_by',
        'status',
        'is_delete',
    ];

    public function getAllBrands()
    {
        return Brand::where('is_delete', 0)->paginate(10);
    }
}
