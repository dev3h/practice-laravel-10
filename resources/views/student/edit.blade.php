@extends('layouts.default-layout.index')
@section('content')
    @extends('components.form.card-form')
@section('card-content')
    <form action="{{ route('student.update', $student->id) }}" method="post" class="p-12 shadow-md max-w-md">
        <h2 class="uppercase mb-5">Form edit</h2>
        @csrf
        @method('PUT')
        <label class="block">
            <span class="block">Name</span>
            <input type="text" name="name" class="border px-3" value="{{ $student->name ?? '' }}"
                placeholder="enter student name">
        </label>
         <label class="block">
            <span class="block">Classroom</span>
            <select name="classroom_id" class="border">
                @foreach ($classrooms as $classroom)
                    <option value="{{$classroom->id}}" @if ($student->classroom_id == $classroom->id)
                        selected
                    @endif >{{$classroom->name}}</option>
                @endforeach
            </select>
        </label>
        <input type="submit" value="update" class="border px-3 mt-5">
    </form>
@endsection
@endsection
