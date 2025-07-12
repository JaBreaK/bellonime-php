@extends('layouts.app')

@section('title', 'Jadwal Rilis Anime')

@section('content')
    <div class="my-8">
        <h1 class="text-4xl font-bold font-display text-white mb-8">Jadwal Rilis Mingguan</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Lakukan perulangan untuk setiap HARI dalam jadwal --}}
            @foreach ($scheduleDays as $day)
                <div class="bg-gray-800/50 border border-gray-700 rounded-lg shadow-lg">
                    <div class="p-4 border-b border-gray-700">
                        <h2 class="text-2xl font-bold text-pink-500">{{ $day['day'] }}</h2>
                    </div>
                    
                    <ul class="p-4 space-y-3">
                        {{-- Lakukan perulangan untuk setiap ANIME di hari itu --}}
                        @foreach ($day['animeList'] as $anime)
                            <li>
                                <a href="{{ url('/anime/' . $anime['animeId']) }}" class="text-gray-300 hover:text-pink-500 transition-colors">
                                    {{ $anime['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection