<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('age', '>=', 20)
                    ->where('age', '<=', 50)
                    ->orderBy('age', 'desc')
                    ->get();

        // $users = User::all();
        $index_title = 'ユーザー一覧';
        return view(
            'users.index',
            compact('users', 'index_title')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $user->name = 'らんてくん';
        $user->age  = 20;
        $user->tel  = '09008976543';
        $user->address  = '東京都渋谷区宇田川町36-6 ワールド宇田川ビル 5階 B室';
        
        return view('users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $user = new User();
        $user->fill($data)->save();

        return redirect(route('users.show', $user))->with('success', 'ユーザーを新規登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show_title = 'ユーザー詳細';
        $user = User::find($id);
        return view('users.show', compact('user', 'show_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        $user->fill($data)->save();

        return redirect(route('users.show', $user))->with('success', 'ユーザー情報を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect(route('users.index'))->with('success', 'ユーザー情報を削除しました');
    }
}
