<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::latest('id')->paginate(20);
        return view('back.users.index',compact('users'));
    }

    /**
     * 登録画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('back.users.create');
    }

    /**
     * 登録処理
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());

        if($user) {
            return redirect()
                ->route('back.users.edit', $user)
                ->withSuccess('データを登録しました');
        } else {
            return redirect()
                ->route('back.users.create')
                ->withSuccess('データの登録に失敗しました');
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
     * @param User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return view('back.users.edit',compact('user'));
    }

    /**
     * 更新処理
     *
     * @param  UserRequest $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        if ($user->update($request->all())) {
            $flash = ['success' => 'データを更新しました'];
        } else {
            $flash = ['error' => 'データの更新に失敗しました'];
        }

        return redirect()
            ->route('back.users.edit', $user)
            ->with($flash);
    }

    /**
     * 削除機能
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            $flash = ['success' => 'データを削除しました'];
        } else {
            $flash = ['error' => 'データの削除に失敗しました'];
        }

        return redirect()
            ->route('back.users.index')
            ->with($flash);
    }
}
