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
<span class='font-bold'>my custom sum helper{{ sumHelper(1, 2) }}</span>

<hr>
@php
    use Illuminate\Support\Facades\DB;
    $users = DB::select('select * from users where name like ?', ['%es%']);
@endphp
<h2 class='font-bold'>DB:</h2>
<ul>
    @foreach ($users as $user)
        <li>name: {{ $user->name }} - email: {{ $user->email }} </li>
    @endforeach

</ul>
<h2 class='font-bold'>transaction</h2>
@php
    DB::transaction(function () {
        DB::update('update classrooms set name = ? where name = ?', ['C1', 'C7']);
        DB::delete('delete from classrooms where name = ?', ['F1']);
    });
    DB::beginTransaction();
@endphp
<hr>
<h2 class='font-bold'>Khóa học</h2>

@php
    use App\Models\Course;
    $courses = Course::paginate(10);
    // $courses = Course::where('name', 'LIKE', '%Erik%')
    //     ->take(10)
    //     ->get();
    
    // $course = Course::where('name', 'Erik Jacobs')->firstOrFail();
    // $course->name = 'hello';
    // $course->refresh();
    
    // $courses = Course::chunk(200, function ($courses) {
    //     foreach ($courses as $course) {
    //         $course->name = 'hi';
    //     }
    // });
@endphp
<ul>
    @foreach ($courses as $course)
        <li>{{ $course->name }}</li>
    @endforeach
</ul>
{{-- <span>{{$course->name}}</span> --}}
<hr>
<h2 class='font-bold'>Soft delete</h2>
<h3 class='font-bold'>hiển thị soft delete của student</h3>
@php
    use App\Models\Student;
    $studentSofts = Student::onlyTrashed()->get();
@endphp
<ul>
    @foreach ($studentSofts as $student)
        <li>{{ $student->name }}</li>
    @endforeach
</ul>
<hr>
<h2 class='font-bold'>Eloquence collection</h2>
@php
    $studentSofts->append('isSoft', true);
    
    // dd($studentSofts->contains(1));
    // dd($studentSofts->diff(Student::all()));
    // dd($studentSofts->except([1]));
    // dd($studentSofts->intersect([$studentSofts]));
    // dd($studentSofts->modelKeys());
    // $studentSofts->makeVisible('name');
    // $studentSofts->makeHidden('name');
    $studentSofts->only([1]);
@endphp
<hr>
<h2 class='font-bold'>Queries builder</h2>
@php
    // use Illuminate\Support\Facades\DB;
    $student = DB::table('classrooms')->where('id',1)->value('created_at');
    // dd($student);
@endphp
