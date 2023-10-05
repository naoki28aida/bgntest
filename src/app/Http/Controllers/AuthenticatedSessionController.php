<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthenticatedSessionController extends Controller
{

    public function store()
    {
        return view('/login');
    }

    public function destroy(Request $request)
    {
        Auth::guard(config('fortify.guard', 'web'))->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
