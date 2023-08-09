<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body class="flex justify-center items-center min-h-screen">
    <form action="" method='post' class="border p-6">
        @csrf

        @error('email')
            @foreach ($errors->get('email') as $error)
                <p class="text-red-500">{{ $error }}</p>
            @endforeach

        @enderror
        <h2 class="font-bold">Nhập mật khẩu để reset password</h2>
        {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}
        {{-- <div>
            <label for="">
                Email
                <input type="text" name="email" class="border" placeholder="nhập email" value="{{request()->get('email')}}">
            </label>
        </div> --}}
        <div>
            <label for="">
                password
                <input type="text" name="password" class="border" placeholder="nhập password">
                @error('password')
                    @foreach ($errors->get('password') as $error)
                        <p class="text-red-500">{{ $error }}</p>
                    @endforeach

                @enderror
            </label>
        </div>
        <div>
            <label for="">
                password_confirmation
                <input type="text" name="password_confirmation" class="border"
                    placeholder="nhập password_confirmation">
                @error('password_confirmation')
                    @foreach ($errors->get('password_confirmation') as $error)
                        <p class="text-red-500">{{ $error }}</p>
                    @endforeach
                @enderror
            </label>
        </div>
        <input type="submit" class="border px-2 bg-red-500 cursor-pointer hover:opacity-90" value="Gửi">
    </form>
</body>

</html>
