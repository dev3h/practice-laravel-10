<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
// có sẵn
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect(route('classroom.index'));
        }
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function checkLogin(AuthRequest $request)
    {

        $login = $request->except('_token', 'remember');

        $remember = (!empty($request->remember)) ? true : false;

        // hàm attempt này nó sẽ hash cái password để so sánh với db nên trong db cũng phải lưu password được hash
        if (Auth::attempt($login)) {
            $user = User::where(["email" => $request->email])->first();

            if ($user) {
                $rememberToken = Str::random(60);
                $user->remember_token = $rememberToken;
                $user->save();
            }
            Auth::login($user, $remember);
            return redirect(route('classroom.index'));
        }
        return redirect(route('auth.login'))->with('status', 'Email hoặc password sai');
    }
    public function checkRegister(AuthRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // $user->notify(new WelcomeEmailNotification($user));
        event(new Registered($user));

        if ($user) {
            return redirect(route('auth.login'));
        }

    }
    public function logout()
    {
        Auth::logout();
        return redirect(route('auth.login'));
    }

    // VERIFY EMAIL
    public function show()
    {
        return view('auth.verify');

    }
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect(route('classroom.index'));

    }
    public function resend(Request $request)
    {
        $request->user()->SendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
