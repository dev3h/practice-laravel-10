@extends('default-view.index')
@section('content')
    @extends('components.form.card-form')
@section('card-content')
    <form action="{{ route('classroom.update', $classroom->id) }}" method="post" class="p-12 shadow-md max-w-md">
        <h2 class="uppercase mb-5">Form edit</h2>
        @csrf
        @method('PUT')
        <label class="block">
            <span class="block">Name</span>
            <input type="text" name="name" class="border px-3" value="{{ $classroom->name ?? '' }}"
                placeholder="enter classroom name">
        </label>
        <input type="submit" value="update" class="border px-3 mt-5">
        @include('classroom.stack')
        @stack('circle')
    </form>
@endsection
@endsection
