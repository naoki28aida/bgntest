<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;

class RegisteredUserController extends Controller
{

    public function create()
    {
        return view('register');
    }


    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::create($validatedData);
        return redirect()->route('login')->with('success', 'ユーザーが正常に作成されました');
    }
}
