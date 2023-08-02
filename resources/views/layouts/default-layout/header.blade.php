<style>
    #notification:checked~.notification-box {
        display: block !important;
    }
</style>
@php
    $active = true;
@endphp
<div class="flex items-center gap-5">
    <div class="relative">
        <label for="notification">
            <input type="checkbox" id="notification" class="hidden">
            🔔
            <div class="notification-box absolute w-64 bg-red-500 min-h-fit -left-6 p-5 hidden">
                <h4>
                    Tất cả các tin
                    <ul class="max-h-40 overflow-y-auto">
                        @foreach (Auth::user()->notifications as $notification)
                            <li class="break-words bg-white cursor-pointer hover:opacity-90 mb-1">
                                đã gửi thông báo đến {{ $notification->data['email'] }}</li>
                        @endforeach
                    </ul>
                </h4>
                <div class="h-[2px] w-full bg-white my-1"></div>
                <h4>
                    Tin chưa đọc
                    <ul class="max-h-40 overflow-y-auto">
                        @foreach (Auth::user()->unreadNotifications as $notification)
                            <li class="break-words bg-white cursor-pointer mb-1 hover:opacity-90 ">
                                <a href="{{ route('readNotification', $notification->id) }}">đã gửi thông báo đến
                                    {{ $notification->data['email'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </h4>
                <div class="h-[2px] w-full bg-white my-1"></div>
                <h4>
                    Tin đã đọc
                    @php
                        // $readNotifications = Auth::user()->readNotifications;
                    @endphp
                    <ul class="max-h-40 overflow-y-auto">
                        @foreach (Auth::user()->readNotifications as $notification)
                            <div class="bg-white cursor-pointer mb-1 hover:opacity-90">
                                <li class="break-words">
                                    đã gửi thông báo đến {{ $notification->data['email'] }}
                                </li>
                                <a href="{{ route('deleteNotification', $notification->id) }}"
                                    class="bg-orange-500 w-3 ml-2 mb-2 inline-block text-center hover:opacity-90">
                                    x</a>
                            </div>
                        @endforeach
                    </ul>
                </h4>

            </div>
        </label>
    </div>

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
{{-- <input type="checkbox" name="checkbox" @checked(old('active', $active))>
<x-circle :size=4 class='shadow-lg w-4 h-4 bg-blue-200 rounded-full'></x-circle> --}}
