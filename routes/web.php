<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController; // <-- 1. Import Controller kita

// 2. Arahkan URL root ('/') ke fungsi 'homepage' di dalam 'AnimeController'
Route::get('/', [AnimeController::class, 'homepage']);
Route::get('/anime/{animeId}', [AnimeController::class, 'showDetail']);
Route::get('/watch/{episodeId}', [AnimeController::class, 'watchEpisode']);
Route::get('/api/server/{serverId}', [AnimeController::class, 'getStreamUrl']);
Route::get('/genres', [AnimeController::class, 'showAllGenres']);
Route::get('/ongoing', [AnimeController::class, 'showOngoing']);
Route::get('/completed', [AnimeController::class, 'showCompleted']);
Route::get('/schedule', [AnimeController::class, 'showSchedule']);
Route::get('/anime', [AnimeController::class, 'showAllAnime']); 