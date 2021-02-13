<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tags = Tag::latest('id')->paginate(20);
        return view('back.tags.index',compact('tags'));
    }

    /**
     * 登録画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('back.tags.create');
    }

    /**
     * 登録処理
     *
     * @param  Tagrequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TagRequest $request)
    {
        $tag = Tag::create($request->all());

        if ($tag) {
            return redirect()
                ->route('back.tags.edit', $tag)
                ->withSuccess('データを登録しました');
        } else {
            return redirect()
                ->route('back.tags.create')
                ->withSuccess('データの登録に失敗しました');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(tag $tag)
    {
        //
    }

    /**
     * 編集画面
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(tag $tag)
    {
        return view('back.tags.edit',compact('tag'));
    }

    /**
     * 更新処理
     *
     * @param  TagRequest  $request
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, tag $tag)
    {
        if ($tag->update($request->all())) {
            $flash = ['success' => 'データを更新しました'];
        } else {
            $flash = ['error' => 'データの更新に失敗しました'];
        }

        return redirect()
            ->route('back.tags.edit', $tag)
            ->with($flash);
    }

    /**
     * 削除処理
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        $tag->posts()->detach();
        
        if ($tag->delete()) {
            $flash = ['success' => 'データを削除しました'];
        } else {
            $flash = ['error' => 'データの削除に失敗しました'];
        }

        return redirect()
            ->route('back.tags.index')
            ->with($flash);
    }
}
