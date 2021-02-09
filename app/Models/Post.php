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
}