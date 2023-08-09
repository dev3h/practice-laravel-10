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
        @if (session('status'))
            <p class="text-red-500">{{ session('status') }}</p>
        @endif
        <h2 class="font-bold">Nhập mật khẩu để reset password</h2>
        <label for="">
            Email
            <input type="text" name="email" class="border" placeholder="nhập email">
            @error('email')
                @foreach ($errors->get('email') as $error)
                    <p class="text-red-500">{{ $error }}</p>
                @endforeach
            @enderror
        </label>
        <input type="submit" class="border px-2 bg-red-500 cursor-pointer hover:opacity-90" value="Gửi">
    </form>
</body>

</html>
