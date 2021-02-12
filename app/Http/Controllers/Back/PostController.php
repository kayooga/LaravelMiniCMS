<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
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
        return view('back.posts.create');
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
        return view('back.posts.edit', compact('post'));
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
