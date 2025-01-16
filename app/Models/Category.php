<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
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

    public function getAllCategories()
    {
        $data = Category::where('is_delete', 0)->where('status', 1)->paginate(10);
        return $data;
    }
    public function getCategoryById($id)
    {
        return Category::find($id);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id')->where('subcategories.status', '=', 1)->where('subcategories.is_delete', '=', 0);
    }
}
