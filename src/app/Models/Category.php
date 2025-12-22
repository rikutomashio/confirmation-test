<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name'];

    public function scopeCategorySearch($query, $category_id)
    {
    if (!empty($category_id)) {
    $query->where('category_id', $category_id);
    }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
    if (!empty($keyword)) {
    $query->where('content', 'like', '%' . $keyword . '%');
    }
    return $query;
    }

    public function contacts()
    {
    return $this->hasMany(Contact::class);
    }

}