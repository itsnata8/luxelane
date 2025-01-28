<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;

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
    public function authRegister(Request $request)
    {
        $checkEmail = User::where('email', $request->email)->first();
        if (empty($checkEmail)) {
            $save = new User;
            $save->name = trim($request->name);
            $save->email = trim($request->email);
            $save->password = Hash::make($request->password);
            $save->save();

            Mail::to($save->email)->send(new RegisterMail($save));

            $json = [
                'status' => true,
                'message' => 'Your account successfully created. Please verify your email address.'
            ];
        } else {
            $json = [
                'status' => false,
                'message' => 'This email already register please choose another.'
            ];
        }
        echo json_encode($json);
    }
    public function activate_email($id)
    {
        $id = base64_decode($id);
        $user = User::find($id);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect(url(''))->with('success', 'Email successfully verified');
    }
}
