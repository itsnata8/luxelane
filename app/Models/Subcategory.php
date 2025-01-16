<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_by',
        'status',
        'is_delete',
    ];

    public function getAllSubcategories()
    {
        return Subcategory::where('is_delete', 0)->where('status', 1)->orderBy('id', 'desc')->paginate(10);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'sub_category_id');
    }
}
