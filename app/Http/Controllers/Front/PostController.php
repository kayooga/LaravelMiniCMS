<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Models\Tag;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * 一覧画面
     * @param string $tagSlug
     * @return \Illuminate\Controllers\View\View
     */
    public function index(string $tagSlug = null)
    {
        //公開・新しい順に表示
        //ModelからDBデータをもってくる
        $posts = Post::publicList($tagSlug);
        $tags = Tag::all();
        
        return view('front.posts.index', compact('posts','tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 詳細画面
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        $post = Post::publicFindById($id);
        return view('front.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
