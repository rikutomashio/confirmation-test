<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Carbon\Carbon;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'content',
        'birthday',
    ];


    // Categoryとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // カテゴリ検索スコープ
    public function scopeCategorySearch($query, $category_id)
    {
        if ($category_id) {
            $query->where('category_id', $category_id);
        }
        return $query;
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                  ->orWhere('first_name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
            });
        }
        return $query;
    }

    protected $casts = [
    'birthday' => 'date',
    ];

    public function getBirthdayFormattedAttribute()
    {
    return $this->birthday?->format('Y-m-d');
    }

}