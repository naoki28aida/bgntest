<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        if ($user) {
            // ユーザーを自動的にログイン
            Auth::login($user);

            // 登録後にトップページにリダイレクト
            return redirect()->route('home')->with('success', 'ユーザーが正常に登録されました');
        } else {
            return back()->with('error', 'ユーザーの登録中にエラーが発生しました');
        }
    }
}
