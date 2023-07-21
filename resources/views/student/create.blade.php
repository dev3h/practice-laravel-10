@extends('layouts.default-layout.index')
@section('content')
    @if ($errors->any())
        <ul class="bg-slate-500 max-w-xl mx-auto mt-4 p-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @extends('components.form.card-form')
@section('card-content')
    <form action="{{ route('student.store') }}" method="post" enctype="multipart/form-data" class="p-12 shadow-md max-w-md">
        <h2 class="uppercase mb-5">Form create</h2>
        @csrf
        <label class="block">
            <span class="block">Name</span>
            <input type="text" name="name" class="border px-3" placeholder="enter student name">
        </label>
        <label class="block">
            <span class="block">Classroom</span>
            <select name="classroom_id">
                @foreach ($classrooms as $classroom)
                    <option value="{{$classroom->id}}">{{$classroom->name}}</option>
                @endforeach
            </select>
        </label>
        <input type="submit" value="create" class="border px-3 mt-5">
    </form>
@endsection
@endsection
