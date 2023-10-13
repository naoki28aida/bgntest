<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function success()
    {
        return view('success');
    }

    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        if ($user) {
            event(new Registered($user));  // 追加: ユーザー登録イベントを発火
            Auth::login($user);

            // 変更: ホームページではなくサンクスページにリダイレクト
            return redirect()->route('thanks')->with('success', 'ユーザーが正常に登録されました');
        } else {
            return back()->with('error', 'ユーザーの登録中にエラーが発生しました');
        }
    }
}
