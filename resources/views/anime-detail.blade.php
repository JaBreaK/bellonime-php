@extends('layouts.app')

{{-- Gunakan judul anime sebagai judul halaman --}}
@section('title', $anime['title'] . ' - Bellonime')

@section('content')
    <div class="my-8">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="w-full md:w-1/3 lg:w-1/4 flex-shrink-0">
                <img src="{{ $anime['poster'] }}" alt="{{ $anime['title'] }}" class="w-full h-auto object-cover rounded-xl shadow-lg">
            </div>

            <div class="w-full md:w-2/3 lg:w-3/4 space-y-4">
                <h1 class="text-4xl font-bold font-display text-white">{{ $anime['title'] }}</h1>

                <div class="flex flex-wrap gap-2">
                    @foreach ($anime['genreList'] as $genre)
                        <span class="bg-gray-700 text-gray-200 text-xs font-semibold px-3 py-1 rounded-full">
                            {{ $genre['title'] }}
                        </span>
                    @endforeach
                </div>

                <div class="pt-4">
                    <h2 class="text-2xl font-semibold border-b-2 border-gray-700 pb-2 mb-4">Sinopsis</h2>
                    <p class="text-gray-300 leading-relaxed whitespace-pre-wrap">
                        {{-- Kita gabungkan paragraf sinopsisnya --}}
                        {{ implode("\n\n", $anime['synopsis']['paragraphs']) }}
                    </p>
                </div>

                {{-- === BAGIAN BARU: DAFTAR EPISODE === --}}
                <div class="pt-4">
                    <h2 class="text-2xl font-semibold border-b-2 border-gray-700 pb-2 mb-4">Daftar Episode</h2>
                    <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-2 mt-4">
                        {{-- Lakukan perulangan untuk setiap episode --}}
                        @foreach ($anime['episodeList'] as $episode)
                            <a 
                                href="{{ url('/watch/' . $episode['episodeId']) }}" 
                                class="bg-gray-800 text-gray-200 font-medium border-2 border-gray-700 hover:border-pink-500 hover:bg-pink-500 hover:text-white transition-colors duration-200 text-center p-2.5 rounded-lg text-sm"
                            >
                                {{ $episode['title'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
                {{-- =================================== --}}
            </div>
        </div>
    </div>
@endsection