<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'sub_category_id',
        'brand_id',
        'old_price',
        'price',
        'short_description',
        'description',
        'additional_information',
        'shipping_returns',
        'status',
        'is_delete',
        'created_by',
    ];

    public function getAllProducts()
    {
        return $this->where('is_delete', 0)->paginate(10);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(Subcategory::class, 'sub_category_id');
    }
    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'product_colors', 'product_id', 'color_id')->withTimestamps();
    }
    public function sizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
