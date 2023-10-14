<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\UserRequest;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/login';

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(UserRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => '指定されたメールアドレスのユーザーは存在しません。']);
        }

        return $this->resetPassword($user, $request->password);
    }

    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        $this->guard()->logout();

        return redirect($this->redirectTo)->with('success', 'パスワードが変更されました。');
    }
}
