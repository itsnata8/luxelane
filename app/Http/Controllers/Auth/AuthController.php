<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\RegisterMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

        return redirect()->route('');
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
    public function authLogin(Request $request)
    {
        $remember = !empty($request->is_remember) ? true : false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 0, 'is_delete' => 0], $remember)) {
            if (!empty(Auth::user()->email_verified_at)) {
                $json['status'] = true;
                $json['message'] = 'success';
            } else {
                $save = User::find(Auth::user()->id);
                Mail::to($save->email)->send(new RegisterMail($save));
                Auth::logout();

                $json['status'] = false;
                $json['message'] = 'Your account email not verified. Please check your inbox and verified.';
            }
        } else {
            $json['status'] = false;
            $json['message'] = 'Please enter correct email and password';
        }

        echo json_encode($json);
    }
    public function activate_email($id)
    {
        $id = base64_decode($id);
        $user = User::find($id);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect(url('/'))->with('success', 'Email successfully verified');
    }
    public function forgotPassword(Request $request)
    {
        $data['meta_title'] = 'Forgot Password';

        return view('auth.forgot', $data);
    }
    public function authForgotPassword(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();
        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', 'Please check your email and reset your password.');
        } else {
            return redirect()->back()->with('error', 'Email not found.');
        }
    }
    public function reset($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            $data['user'] = $user;
            $data['meta_title'] = 'Reset Password';

            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }
    public function authReset($token, Request $request)
    {
        if ($request->password == $request->cpassword) {
            $user = User::where('remember_token', '=', $token)->first();
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();

            return redirect(url('/'))->with('success', 'Password successfully reset.');
        } else {
            return redirect()->back()->with('error', 'Password not match.');
        }
    }
}
