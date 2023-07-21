@php
    $active = true;
@endphp
<span @class([
    'font-bold' => $active,
])>
    Xin chao
</span>
<div class="flex items-center gap-3">
    <span @style(['font-size: 25px' => $active])>{{ $name }}</span>
    <a class='underline cursor-pointer hover:text-blue-400' href='{{ route('auth.logout') }}'>Logout</a>
</div>
<div @style(['font-size: 25px' => $active])>email: {{ $email }}</div>
<input type="checkbox" name="checkbox" @checked(old('active', $active))>
<x-circle :size=4 class='shadow-lg w-4 h-4 bg-blue-200 rounded-full'></x-circle>
<hr>
@php
    $hashText = Hash::make('hello');
    $text = Hash::check('hello', $hashText);
@endphp
<span>{{ $hashText }}</span>
<span> compare hash: {{ $text }}</span>

<hr>
<h2>Collection</h2>
@php
    $collection = collect([1, 2, 3]);
    // $collection = collect([1, 2, 3])->chunk(1);
    // $collection = collect([1, 2, 3])->first();
    // $collection = collect([1, 2, 3])->take(2);
    $collection->push(4);
@endphp
<span>{{ $collection }}</span>
<hr>
<form action="{{ route('processOrder') }}" method='post' class="shadow-md p-3">
    @csrf
    <div>
        <label for="">Name</label>
        <input type="text" name='name' value='{{ Auth::user()->name }}' class="border">
    </div>
    <div>
        <label for="">Email</label>
        <input type="email" name='email' value='{{ Auth::user()->email }}' class="border">
    </div>
    <input type="submit" value='send order' class="border px-3 bg-orange-400 cursor-pointer hover:opacity-80">
</form>
<hr>
@php
    Storage::disk('local')->put('text/example.txt', 'Contents');
@endphp
<hr>
<form action="{{ route('storeImg') }}" method='post' enctype="multipart/form-data" class="shadow-md p-4">
    @csrf
    <div>
        <input type="file" name="photo">
    </div>
    <input type="submit" value="Lưu ảnh" class="border px-3 bg-orange-500 cursor-pointer mt-2 hover:opacity-80">
</form>
<hr>
{{-- @php
    use App\Models\Student;
    $student = new Student();
@endphp
<a href="{{ show_route($student) }}">
    {{ $student->name }}
</a> --}}
<span>my custom sum helper{{ sumHelper(1, 2) }}</span>

<hr>
@php
    use Illuminate\Support\Facades\DB;
    $users = DB::select('select * from users where name like ?', ['%es%']);
@endphp
<h2>DB:</h2>
<ul>
    @foreach ($users as $user)
        <li>name: {{ $user->name }} - email: {{ $user->email }} </li>
    @endforeach

</ul>
<h2>transaction</h2>
@php
    DB::transaction(function () {
        DB::update('update classrooms set name = ? where name = ?', ['C1','C7']);
        DB::delete('delete from classrooms where name = ?', ['F1']);
    });
    DB::beginTransaction();
@endphp
