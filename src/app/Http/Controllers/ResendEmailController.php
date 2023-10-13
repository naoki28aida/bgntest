<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SimpleVerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class ResendEmailController extends Controller
{
    public function resend(Request $request)
    {
        $userId = Session::get('last_registered_user_id');

        if (!$userId) {
            return back()->with('status', 'ユーザー情報が見つかりません。');
        }

        $user = User::find($userId);
        if (!$user) {
            return back()->with('status', 'ユーザー情報が見つかりません。');
        }

        $url = route('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]);
        Mail::to($user->email)->send(new SimpleVerificationMail($url));

        return back()->with('status', '確認メールが再送されました。');
    }
}
