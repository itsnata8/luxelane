<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        $data = Category::where('is_delete', 0)->get();
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
}
