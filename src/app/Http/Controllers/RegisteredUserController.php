<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Mail\SimpleVerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

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
            Session::put('last_registered_user_id', $user->id);
        }

        if ($user) {
            event(new Registered($user));


            $url = URL::signedRoute('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]);
            Mail::to($user->email)->send(new SimpleVerificationMail($url));

            return redirect()->route('thanks');
        }
    }
}
