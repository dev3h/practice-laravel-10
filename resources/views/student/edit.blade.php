@extends('layouts.default-layout.index')
@section('content')
    @extends('components.form.card-form')
@section('card-content')
    <form action="{{ route('student.update', $student->id) }}" method="post" class="p-12 shadow-md max-w-md"
        enctype="multipart/form-data">
        <h2 class="uppercase mb-5">Form edit</h2>
        @csrf
        @method('PUT')
        <label class="block">
            <span class="block">Name</span>
            <input type="text" name="name" class="border px-3" value="{{ old('name') ?? $student->name }}"
                placeholder="enter student name">
            @error('name')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </label>
        <label class="block">
            <input type="file" name="photo" class="border px-3" />
            @error('photo')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
            @if (empty($student->photo))
                <p>Anh cũ</p>
                <img src="{{ asset('storage/photo/' . $student->photo) }}" height="50px" alt="">
            @endif
        </label>
        <label class="block">
            <span class="block">Classroom</span>
            <select name="classroom_id" class="border">
                @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" @if ($student->classroom_id == $classroom->id) selected @endif>
                        {{ $classroom->name }}</option>
                @endforeach
                @error('classroom_id')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </select>
        </label>
        <input type="submit" value="update" class="border px-3 mt-5">
    </form>
@endsection
@endsection
