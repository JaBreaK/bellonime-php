@extends('layouts.app')

@section('title', 'Anime Ongoing')

@section('content')
    <div class="my-8">
        <h1 class="text-4xl font-bold font-display text-white mb-8">Anime Sedang Tayang</h1>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($animeList as $anime)
                {{-- Kita pakai lagi komponen AnimeCard kita yang keren! --}}
                <x-anime-card :anime="$anime" />
            @endforeach
        </div>

        {{-- Panggil komponen pagination --}}
        <x-pagination :pagination="$pagination" baseUrl="/ongoing" />
    </div>
@endsection