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
use Illuminate\Support\Facades\Password;
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

        // $remember = (!empty($request->remember)) ? true : false;

        // hàm attempt này nó sẽ hash cái password để so sánh với db nên trong db cũng phải lưu password được hash
        if (Auth::attempt($login)) {
            $user = User::where(["email" => $request->email])->first();
            if($request->input('remember')){
                setcookie('email', $request->email, time()+100*100*100);
                setcookie('password', $request->password, time()+100*100*100);
            } else {
                setcookie('email','', time()-100*100*100);
                setcookie('password','', time()-100*100*100);
            }
            if ($user) {
                $rememberToken = Str::random(60);
                $user->remember_token = $rememberToken;
                $user->save();
            }
            Auth::login($user);
            return redirect(route('classroom.index'));
        }
        return redirect(route('auth.login'))->with('status', 'Email hoặc password sai');
    }
    public function checkRegister(AuthRequest $request)
    {
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
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
    // FORGOT PASSWORD
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);

    }
    public function resetPassword()
    {
        
        return view('auth.reset-password');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            // 'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => 'required|min:1|confirmed',
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();
                // event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
        ? redirect(route('auth.login'))->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
    }
}
