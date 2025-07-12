@extends('layouts.app')

@section('title', 'Homepage - Bellonime v.PHP')

@section('content')
    <div class="my-8">
        <h2 class="text-2xl font-bold text-pink-500 mb-4">Rilisan Terbaru</h2>

        {{-- Grid untuk menampilkan kartu anime --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            {{-- Lakukan perulangan untuk setiap anime di variabel $ongoingAnime --}}
            @foreach ($ongoingAnime as $anime)
    {{-- Panggil komponen kita yang baru --}}
    <x-anime-card :anime="$anime" />
@endforeach
        </div>
    </div>
@endsection