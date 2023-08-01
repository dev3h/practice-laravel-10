@php
    $active = true;
@endphp
<div class="flex items-center gap-5">
    <span @class([
        'font-bold' => $active,
    ])>
        Xin chao
    </span>
    <div class="flex items-center gap-3">
        <span @style(['font-size: 25px' => $active])>{{ $name ?? '' }}</span>
        <a class='underline cursor-pointer hover:text-blue-400' href='{{ route('auth.logout') }}'>Logout</a>
    </div>
</div>
{{-- <div @style(['font-size: 25px' => $active])>email: {{ $email ?? '' }}</div> --}}
<input type="checkbox" name="checkbox" @checked(old('active', $active))>
<x-circle :size=4 class='shadow-lg w-4 h-4 bg-blue-200 rounded-full'></x-circle>


