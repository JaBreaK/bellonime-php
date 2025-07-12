@extends('layouts.app')

@section('title', 'Daftar Genre')

@section('content')
    <div class="my-8">
        <h1 class="text-4xl font-bold font-display text-white mb-8">Daftar Genre</h1>

        {{-- Grid untuk menampilkan semua genre --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            {{-- Lakukan perulangan untuk setiap genre --}}
            @foreach ($genreList as $genre)
                <a 
                    href="{{ url('/genres/' . $genre['genreId']) }}" 
                    class="block text-center bg-gray-800 hover:bg-pink-500 hover:text-white font-semibold p-4 rounded-lg transition-colors shadow-lg"
                >
                    {{ $genre['title'] }}
                </a>
            @endforeach
        </div>
    </div>
@endsection