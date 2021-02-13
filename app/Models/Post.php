<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    protected static function boot()
    {
        //親モデル(Illuminate\Database\Eloquent\Model)のbootメソッド(同名メソッド)を呼び出す
        parent::boot();

        //保存時user_idをログインユーザーに設定
        //self::saving このイベント発生時にしたい処理
        //\Auth:id その時ログインしているユーザー
        self::saving(function($post) {
                $post->user_id = \Auth::id();
        });
    }

    //リレーションの設定
    //blengsTo 1対多
    //users_tableに所属しますよ～
    //カラム名がリレーション先の(モデル_id)でない場合は第二引数に指定する
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //belongsToMany 多対多
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //公開のみ表示
    public function scopePublic(Builder $query)
    {
        return $query->where('is_public', true);
    }

    //公開記事一覧取得
    public function scopePublicList(Builder $query, string $tagSlug = null)
    {
        //whereHas タグを絞って検索する
        if($tagSlug) {
            $query->whereHas('tags',function($query) use($tagSlug) {
                $query->where('slug',$tagSlug);
            });
        }
        return $query
            ->with('tags')
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
