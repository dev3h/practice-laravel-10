@extends('layouts.default-layout.index')

@section('content')
    @push('lang')
        @php
            $langs = [(object) ['en' => 'en'], (object) ['vi' => 'vi']];
        @endphp
        <form action="{{ route('change_lang') }}" method='post' id='change-lang'>
            @csrf
            <select name="lang" class='border mt-3 ml-2' id='select-lang'>
                <option value="en" @if (session()->get('lang') == 'en') selected @endif>en</option>
                <option value="vi" @if (session()->get('lang') == 'vi') selected @endif>vi</option>
            </select>
        </form>
    @endpush
    <div class="p-3">
        <div class='flex gap-2'>
            <div class='flex-1'>
                {!! $title !!}
                <a href="{{ route('classroom.create') }}"
                    class="text-white border px-3 rounded-md bg-red-500 inline-block mb-2 hover:opacity-80">{{ __('action.ADD') }}
                </a>
                <table class='w-full'>
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classrooms as $classroom)
                            <tr>
                                <td>{{ $classroom->id }}</td>
                                <td>{{ $classroom->name }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('classroom.show', $classroom->id) }}"
                                            class='px-3 py-1 bg-blue-300 text-white hover:opacity-80'>{{ __('action.VIEW') }}</a>
                                        <a href="{{ route('classroom.edit', $classroom->id) }}"
                                            class="px-3 py-1 bg-yellow-300 text-white hover:opacity-80">{{ __('action.EDIT') }}</a>
                                        <form action="{{ route('classroom.destroy', $classroom->id) }}" method='post'>
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" value="{{ __('action.DELETE') }}"
                                                class="px-3 py-1 bg-red-700 text-white hover:opacity-80">
                                        </form>
                                    </div class="flex gap-2">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$classrooms->links()}}
            </div>
            <div class="flex-1">
                @includeIf('classroom.test', ['name' => Auth::user()->name ?? '', 'email' => Auth::user()->email ?? ''])
            </div>
        </div>
    </div>
    @push('handle-lang')
        <script>
            var select = document.getElementById('select-lang');
            select.addEventListener('change', function() {
                this.form.submit();
            }, false);
        </script>
    @endpush
@endsection
