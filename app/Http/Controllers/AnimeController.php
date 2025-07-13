<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Import HTTP Client bawaan Laravel
use Illuminate\View\View;
use Illuminate\Http\JsonResponse; // Import JsonResponse untuk fungsi API
use Illuminate\Support\Facades\Log; // Tambahkan ini untuk logging
use Inertia\Response;

class AnimeController extends Controller
{
    // Fungsi ini akan mengambil data dan mengirimkannya ke homepage
    public function homepage(): Response // <-- 2. Ganti return type-nya
    {
        $response = Http::get('https://bellonime.vercel.app/otakudesu/home');
        $apiData = $response->json();

        $ongoingAnime = $apiData['data']['ongoing']['animeList'] ?? [];
        $completedAnime = $apiData['data']['completed']['animeList'] ?? [];

        // Perintah ini sekarang sudah sesuai dengan "janji"
        return \Inertia\Inertia::render('Homepage', [
            'ongoingAnime' => $ongoingAnime,
            'completedAnime' => $completedAnime
        ]);
    }

public function showDetail(string $animeId): Response // Ganti return type ke Response
    {
        $response = Http::get('https://bellonime.vercel.app/otakudesu/anime/' . $animeId);
        $apiData = $response->json();
        $anime = $apiData['data'] ?? null;

        if (!$anime) {
            abort(404, 'Anime tidak ditemukan.');
        }

        // Ganti `view()` menjadi `Inertia::render()`
        return \Inertia\Inertia::render('Anime/Detail', [
            'anime' => $anime
        ]);
    }
    
 public function watchEpisode(string $episodeId): Response
    {
        $response = Http::get('https://bellonime.vercel.app/otakudesu/episode/' . $episodeId);
        $apiData = $response->json();
        $episode = $apiData['data'] ?? null;

        if (!$episode) {
            abort(404, 'Episode tidak ditemukan.');
        }

        // Kirim data ke komponen React 'Watch/Episode.jsx'
        return \Inertia\Inertia::render('Watch/Episode', [
            'episode' => $episode
        ]);
    }

    // --- TAMBAHKAN FUNGSI BARU INI ---
    public function getStreamUrl(string $serverId): JsonResponse
    {
        $url = 'https://bellonime.vercel.app/otakudesu/server/' . $serverId;

        try {
            $response = Http::get($url);

            // Cek jika request ke API sumber gagal
            if ($response->failed()) {
                Log::error('Gagal fetch dari API Bellonime', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return response()->json(['error' => 'Server sumber tidak merespon dengan baik.'], 502);
            }

            // Cek jika respons bukan JSON valid
            $apiData = $response->json();
            if (is_null($apiData)) {
                Log::error('Respons dari API Bellonime bukan JSON valid', ['body' => $response->body()]);
                return response()->json(['error' => 'Respons dari server sumber aneh.'], 500);
            }
            
            // Cek apakah struktur data sesuai harapan
            $streamUrl = $apiData['data']['url'] ?? null;
            if (!$streamUrl) {
                Log::error('Struktur JSON tidak memiliki data.url', ['data' => $apiData]);
                return response()->json(['error' => 'Format data URL tidak ditemukan.'], 404);
            }

            return response()->json(['url' => $streamUrl]);

        } catch (\Exception $e) {
            // Menangkap semua jenis error lain yang mungkin terjadi
            Log::error('Exception di getStreamUrl', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Terjadi kesalahan internal server.'], 500);
        }
    }

    // --- TAMBAHKAN FUNGSI BARU INI ---
    public function showAllGenres(): Response
    {
        $response = Http::get('https://bellonime.vercel.app/otakudesu/genres');
        $apiData = $response->json();
        $genreList = $apiData['data']['genreList'] ?? [];

        // Ganti view() menjadi Inertia::render()
        // 'Genres/Index' akan mencari file /Pages/Genres/Index.jsx
        return \Inertia\Inertia::render('Genres/Index', [
            'genreList' => $genreList
        ]);
    }
    public function showAnimeByGenre(Request $request, string $genreId): Response
    {
        $page = $request->query('page', 1);
        $response = Http::get("https://bellonime.vercel.app/otakudesu/genres/{$genreId}?page={$page}");
        $apiData = $response->json();

        // Kita juga perlu nama genre untuk judul halaman
        $genreTitle = $apiData['data']['title'] ?? ucfirst($genreId);
        $animeList = $apiData['data']['animeList'] ?? [];
        $pagination = $apiData['pagination'] ?? null;

        return \Inertia\Inertia::render('Genres/Detail', [
            'genreTitle' => $genreTitle,
            'genreId' => $genreId,
            'animeList' => $animeList,
            'pagination' => $pagination
        ]);
    }

    public function showOngoing(Request $request): Response
    {
        $page = $request->query('page', 1);
        $response = Http::get("https://bellonime.vercel.app/otakudesu/ongoing?order=update&page={$page}");
        $apiData = $response->json();

        $animeList = $apiData['data']['animeList'] ?? [];
        $pagination = $apiData['pagination'] ?? null;

        return \Inertia\Inertia::render('Ongoing', [
            'animeList' => $animeList,
            'pagination' => $pagination
        ]);
    }
     public function showCompleted(Request $request): Response
    {
        $page = $request->query('page', 1);
        $response = Http::get("https://bellonime.vercel.app/otakudesu/completed?order=latest&page={$page}");
        $apiData = $response->json();

        $animeList = $apiData['data']['animeList'] ?? [];
        $pagination = $apiData['pagination'] ?? null;

        return \Inertia\Inertia::render('Completed', [
            'animeList' => $animeList,
            'pagination' => $pagination
        ]);
    }
    public function showSchedule(): Response
    {
        $response = Http::get('https://bellonime.vercel.app/otakudesu/schedule');
        $apiData = $response->json();
        $scheduleDays = $apiData['data']['days'] ?? [];

        // Ganti view() menjadi Inertia::render()
        return \Inertia\Inertia::render('Schedule', [
            'scheduleDays' => $scheduleDays
        ]);
    }
    public function showAllAnime(): Response
    {
        $response = Http::get('https://bellonime.vercel.app/otakudesu/anime');
        $apiData = $response->json();
        $animeGroups = $apiData['data']['list'] ?? [];

        // Ganti view() menjadi Inertia::render()
        return \Inertia\Inertia::render('Anime/List', [
            'animeGroups' => $animeGroups
        ]);
    }
}