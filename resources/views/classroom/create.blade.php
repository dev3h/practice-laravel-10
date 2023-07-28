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
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('classroom.store') }}" method="post" enctype="multipart/form-data" class="p-12 shadow-md max-w-md">
        <h2 class="uppercase mb-5">Form create</h2>
        @csrf
        <label class="block">
            <span class="block">Name</span>
            <input type="text" name="name" value="{{ old('name') }}" class="border px-3"
                placeholder="enter classroom name">
        </label>
        {{-- <label class="block">
            <span class="block">test</span>
            <input type="text" name="test" value="{{ old('name') }}" class="border px-3"
                placeholder="enter classroom name">
        </label> --}}
        {{-- <label class="block">
                <span class="block">Photo</span>
                <input type="file" name="photo" class="border px-3" placeholder="enter classroom name">
            </label> --}}
        <input type="checkbox" name="cme">
        <input type="submit" value="create" class="border px-3 mt-5">
    </form>
@endsection
@endsection
