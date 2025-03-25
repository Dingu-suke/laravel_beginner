<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('login.create');
    }
    
    public function store(Request $request)
    {
        // フォームから送られてきたメールアドレスとパスワードにバリデーションをかける
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // バリデーションが通ったらAuth::attemptでメールアドレスとパスワードがあっているかを確認
        // あっている場合、処理はif文の中に移る
        if (Auth::attempt($credentials)) {
            // ユーザーのセッションを再生成してログイン状態とする
            // ログイン情報はsessionに保存される
            // 今後はAuthファサードを使用してログイン情報を扱う
            $request->session()->regenerate();

            return redirect()->intended('top')->with('success', 'ログインしました');
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::logout();        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('top.index');
    }
}