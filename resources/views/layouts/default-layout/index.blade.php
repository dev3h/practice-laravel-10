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
    @stack('lang')
    <div class="flex gap-3">
        <div class='w-52 bg-blue-400'>
            <div>
                <a href="{{ route('classroom.index') }}"
                    class="inline-block w-full bg-slate-300 px-2 py-3 uppercase mt-3 hover:opacity-80 ">Classroom</a>
                <a href="{{ route('student.index') }}"
                    class="inline-block w-full bg-slate-300 px-2 py-3 uppercase mt-3 hover:opacity-80 ">Student</a>
            </div>
        </div>
        <div class='flex-1 bg-slate-100'>
            @yield('content')
        </div>
    </div>
</body>
@stack('handle-lang')


</html>
