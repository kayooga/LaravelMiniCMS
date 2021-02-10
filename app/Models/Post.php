<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // fillable 更新できるプロパティを設定
    protected $fillable = [
        'title', 'body', 'is_public', 'published_at'
    ];

    // casts どのような型を扱うか設定
    protected $casts = [
        'is_public' => 'bool',
        'published_at' => 'datetime'
    ];

    //公開のみ表示
    public function scopePublic(Builder $query)
    {
        return $quey->where('is_public', true);
    }

    //公開記事一覧取得
    public function scopePublicList(Builder $query)
    {
        return $query
            ->public()
            ->latest('published_at')
            ->paginate(10);
    }

    //公開記事をIDで取得
    public function scopePublicFindById(Builder $query, int $id)
    {
        return $query->public()->findOrFail($id);
    }

    //公開日を年月日で表示(Viewで使う)
    //get●●●Attribute
    public function getPublishedFormatAttribute()
    {
        return $this->published_at->format('Y年m月d日');
    }

}
