@extends('layouts.app')

@section('title', 'Daftar Semua Anime')

@section('content')
    <div class="my-8">
        <h1 class="text-4xl font-bold font-display text-white mb-8">Daftar Semua Anime</h1>

        <div class="flex flex-col md:flex-row gap-8">

            {{-- Kolom Kiri: Navigasi Abjad (Sticky & Scrollable) --}}
            <nav class="w-full md:w-20 md:sticky top-24 self-start">
                <ul class="flex flex-row md:flex-col flex-wrap gap-2 overflow-y-auto max-h-[calc(100vh-8rem)] pr-2">
                    @foreach ($animeGroups as $group)
                        <li>
                            <a href="#{{ $group['startWith'] }}" class="block w-full text-center p-2 rounded-md text-sm font-semibold bg-gray-800 border-2 border-gray-700 text-gray-300 hover:border-pink-500 hover:text-pink-500 transition-colors duration-200">
                                {{ $group['startWith'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            {{-- Kolom Kanan: Daftar Anime (Scrollable) --}}
            <div class="w-full space-y-8">
                @foreach ($animeGroups as $group)
                    <section id="{{ $group['startWith'] }}" class="scroll-mt-24">
                        <h2 class="text-3xl font-bold text-pink-500 border-b-2 border-gray-700 pb-2 mb-4">
                            {{ $group['startWith'] }}
                        </h2>
                        <ul class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-x-6">
                            @foreach ($group['animeList'] as $anime)
                                <li class="mb-2">
                                    <a href="{{ url('/anime/' . $anime['animeId']) }}" class="text-gray-300 hover:text-pink-500 transition-colors text-sm">
                                        {{ $anime['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endforeach
            </div>

        </div>
    </div>
@endsection