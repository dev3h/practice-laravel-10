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
            <h2 class="uppercase mb-3 text-center">Form đăng ký</h2>
            <form action="{{ route('auth.checkRegister') }}" method='post' class="flex flex-col">
                @csrf
                <div>
                    <label for="">Name</label><br>
                    <input type="text" name='name' class="border w-full"><br>
                </div>
                <div>
                    <label for="">Email</label><br>
                    <input type="email" name='email' class="border w-full"><br>
                </div>
                <div>
                    <label for="">Password</label><br>
                    <input type="password" name='password' class="border w-full"><br>
                </div>
                <input type="submit" value="register"
                    class="border px-3 mt-5 cursor-pointer bg-orange-600 hover:opacity-80">
            </form>
            <a href="{{ route('auth.login') }}" class='underline cursor-pointer hover:text-blue-500'>Login</a>
        </div>
    </div>
</body>

</html>
