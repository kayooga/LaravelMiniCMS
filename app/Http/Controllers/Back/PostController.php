<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    /*
    // タグの読み込み処理を共通にする
    public function __construct()
    {
        $this->middleware(function ($request, \Closure $next) {
            \View::share('tags', Tag::pluck('name', 'id')->toArray());
            return $next($request);
        })->only('create', 'edit');
    }
    */

    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        //Post::with('user') 必要な数だけクエリを発行する
        $posts = Post::with('user')->latest('id')->paginate(20);
        return view('back.posts.index', compact('posts'));
    }

    /**
     * 新規登録画面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ビューで表示しやすいようにKeyValueで取得する
        $tags = Tag::pluck('name','id')->toArray();
        return view('back.posts.create',compact('tags'));
    }

    /**
     * データの登録処理
     *
     * @param  \Illuminate\Http\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());
        //タグを追加
        $post->tags()->attach($request->input('tags'));

        if ($post) {
            return redirect()
                ->route('back.posts.edit',$post)
                ->withSuccess('データを登録しました。');
        } else {
            return redirect()
                ->route('back.posts.create')
                ->withError('データの登録に失敗しました。');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 編集画面
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::pluck('name','id')->toArray();
        return view('back.posts.edit', compact('post','tags'));
    }

    /**
     * 更新処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        //タグを更新
        $post->tags()->sync($request->input('tags'));

        if ($post->update($request->all())) {
            $flash = ['success' => 'データを更新しました。'];
        } else {
            $flash = ['error' => 'データの更新に失敗しました'];
        }

        return redirect()
            ->route('back.posts.edit', $post)
            ->with($flash);
    }

    /**
     * 削除処理
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //タグを削除
        $post->tags()->detach();
        
        if ($post->delete()) {
            $flash = ['success' => 'データを削除しました。'];
        } else {
            $flash = ['error' => 'データの削除に失敗しました。'];            
        }

        return redirect()
            ->route('back.posts.index')
            ->with($flash);
    }
}
