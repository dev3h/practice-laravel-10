<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    @if ($errors->any())
        <ul class="bg-slate-500 max-w-xl mx-auto mt-4 p-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @if (session('status'))
        <ul class="bg-slate-500 max-w-xl mx-auto mt-4 p-3">
            <li> {{ session('status') }}</li>
        </ul>
    @endif
    <div class='flex justify-center items-center min-h-screen'>
        <div class='max-w-2xl flex-1 shadow-md p-6 '>
            <h2 class="uppercase mb-3 text-center">Form đăng nhập</h2>
            <form  method='post' class="flex flex-col">
                @csrf
                <div>
                    <label for="">Email</label><br>
                    <input type="email" name='email' class="border w-full" value="{{$_COOKIE['email'] ?? ''}}"><br>
                </div>
                <div>
                    <label for="">Password</label><br>
                    <input type="password" name='password' class="border w-full" value="{{$_COOKIE['password'] ?? ''}}"><br>
                </div>
                <input type="submit" value="Login"
                    class="border px-3 mt-5 cursor-pointer bg-orange-600 hover:opacity-80">
                <div>
                    <input type="checkbox" @if (isset($_COOKIE['email']))
                        checked
                    @endif name="remember"><label for="">Remember</label>
                </div>
            </form>
            <div class="flex gap-3">
                <a href="{{ route('auth.register') }}" class='underline cursor-pointer hover:text-blue-500'>Register</a>
                <a href="{{ route('password.request') }}" class='underline cursor-pointer hover:text-blue-500'>Forgot
                    password?</a>
                <a href="{{ route('login.redirectToProvider', 'github') }}"
                    class='underline cursor-pointer hover:text-blue-500'>Login github</a>
            </div>
        </div>
    </div>
</body>

</html>
