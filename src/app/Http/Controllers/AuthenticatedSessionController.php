<?php

namespace App\Http\Controllers;

use App\Models\WorkTimes;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function store(UserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // ログインに成功した場合
            return redirect()->route('home');
        } else {
            // ログインに失敗した場合
            return back()->withErrors([
                'login' => 'メールアドレスまたはパスワードが正しくありません。'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
