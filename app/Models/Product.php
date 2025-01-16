<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    public function getImageSingle()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('order_by', 'asc')->first();
    }
    static public function getProductForFrontend($category_id = '', $subcategory_id = '')
    {
        $return = Product::select('products.*', 'users.name as created_by_name', 'categories.name as category_name', 'categories.slug as categories_slug', 'subcategories.name as sub_category_name', 'subcategories.slug as sub_category_slug')
            ->join('users', 'users.id', '=', 'products.created_by')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id');

        if (!empty($category_id)) {
            $return = $return->where('products.category_id', $category_id);
        }
        if (!empty($subcategory_id)) {
            $return = $return->where('products.sub_category_id', $subcategory_id);
        }
        if (!empty(Request::get('categoryFilter'))) {
            $sub_category_id = rtrim(Request::get('categoryFilter'), ',');
            $sub_category_id_array = explode(',', $sub_category_id);
            $return = $return->whereIn('products.sub_category_id', $sub_category_id_array);
        } else {
            if (!empty(Request::get('old_category_id'))) {
                $return = $return->where('products.category_id', $category_id);
            }
            if (!empty(Request::get('old_sub_category_id'))) {
                $return = $return->where('products.sub_category_id', $subcategory_id);
            }
        }
        if (!empty(Request::get('colorFilter'))) {
            $color_id = rtrim(Request::get('colorFilter'), ',');
            $color_id_array = explode(',', $color_id);
            $return = $return->join('product_colors', 'product_colors.product_id', '=', 'products.id');
            $return = $return->whereIn('product_colors.color_id',  $color_id_array)->distinct('products.id');
        }
        if (!empty(Request::get('brandFilter'))) {
            $brand_id = rtrim(Request::get('brandFilter'), ',');
            $brand_id_array = explode(',', $brand_id);
            $return = $return->whereIn('products.brand_id', $brand_id_array);
        }
        if (!empty(Request::get('startPriceFilter')) && !empty(Request::get('endPriceFilter'))) {
            $start_price = str_replace('$', '', Request::get('startPriceFilter'));
            $end_price = str_replace('$', '', Request::get('endPriceFilter'));
            $return = $return->where('products.price', '>=', $start_price);
            $return = $return->where('products.price', '<=', $end_price);
        }
        $return = $return->where('products.is_delete', '=', 0)->groupBy('products.id')->orderBy('products.id', 'desc')->paginate(30);
        return $return;
    }
    static function getBrandFilter($category_id)
    {
        $brandId = Product::where('category_id', $category_id)->pluck('brand_id')->toArray();
        return Brand::whereIn('id', $brandId)->get();
    }
}
