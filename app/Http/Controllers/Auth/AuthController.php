<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $data = [
            'pageTitle' => 'Admin | Login'
        ];

        return view('admin.pages.auth.login', $data);
    }
    public function handleLogin(Request $request)
    {
        $creds = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|max:45'
        ]);
        $remember_me = $request->has('remember_me') ? true : false;
        if (Auth::attempt($creds, $remember_me)) {
            $request->session()->regenerate();

            // not verified email yet
            return redirect()->route('dashboard.index');
        }
        return redirect()->back()->with('error', $creds);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
