<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Contact extends Model
{
    use HasFactory;

    // 追加で birthday を fillable に入れる
    protected $fillable = [
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
        'category_id',
        'content',
        'birthday', // ← 追加
    ];

    // Categoryとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // カテゴリ検索スコープ
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
        return $query;
    }

    // キーワード検索スコープ（名前・メールアドレスも検索可能に改良）
    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                  ->orWhere('first_name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
            });
        }
        return $query;
    }

    // 生年月日を Y-m-d 形式で取得するアクセサ（表示用）
    public function getBirthdayFormattedAttribute()
    {
        return $this->birthday ? \Carbon\Carbon::parse($this->birthday)->format('Y-m-d') : null;
    }
}
