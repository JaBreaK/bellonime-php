<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Import HTTP Client bawaan Laravel
use Illuminate\View\View;
use Illuminate\Http\JsonResponse; // Import JsonResponse untuk fungsi API
use Illuminate\Support\Facades\Log; // Tambahkan ini untuk logging

class AnimeController extends Controller
{
    // Fungsi ini akan mengambil data dan mengirimkannya ke homepage
    public function homepage(): View
    {
        // Panggil API-mu menggunakan HTTP Client
        $response = Http::get('https://bellonime.vercel.app/otakudesu/home');
        $apiData = $response->json();

        // Ambil daftar anime ongoing, beri fallback array kosong jika tidak ada
        $ongoingAnime = $apiData['data']['ongoing']['animeList'] ?? [];
        $completedAnime = $apiData['data']['completed']['animeList'] ?? [];

        // Kirim data ke view 'homepage'
        return view('homepage', [
            'ongoingAnime' => $ongoingAnime,
            'completedAnime' => $completedAnime
        ]);
    }

    public function showDetail(string $animeId): View
    {
        // Panggil API detail menggunakan $animeId dari URL
        $response = Http::get('https://bellonime.vercel.app/otakudesu/anime/' . $animeId);
        $apiData = $response->json();

        // Ambil data detail animenya
        $anime = $apiData['data'] ?? null;

        // Jika anime tidak ditemukan, hentikan program dan tampilkan error 404
        if (!$anime) {
            abort(404, 'Anime tidak ditemukan.');
        }

        // Kirim data $anime ke view baru bernama 'anime-detail'
        return view('anime-detail', [
            'anime' => $anime
        ]);
    }
    public function watchEpisode(string $episodeId): View
    {
        // Panggil API episode menggunakan $episodeId dari URL
        $response = Http::get('https://bellonime.vercel.app/otakudesu/episode/' . $episodeId);
        $apiData = $response->json();

        // Ambil data detail episodenya
        $episode = $apiData['data'] ?? null;

        // Jika episode tidak ditemukan, tampilkan error 404
        if (!$episode) {
            abort(404, 'Episode tidak ditemukan.');
        }

        // Kirim data $episode ke view baru bernama 'watch'
        return view('watch', [
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
    public function showAllGenres(): View
    {
        // Panggil API untuk mendapatkan semua genre
        $response = Http::get('https://bellonime.vercel.app/otakudesu/genres');
        $apiData = $response->json();

        // Ambil list genre-nya
        $genreList = $apiData['data']['genreList'] ?? [];

        // Kirim data ke view baru bernama 'genres'
        return view('genres', ['genreList' => $genreList]);
    }

    public function showOngoing(Request $request): View
    {
        // Ambil nomor halaman dari URL (contoh: /ongoing?page=2)
        $page = $request->query('page', 1);

        // Panggil API dengan parameter halaman
        $response = Http::get("https://bellonime.vercel.app/otakudesu/ongoing?order=update&page={$page}");
        $apiData = $response->json();

        $animeList = $apiData['data']['animeList'] ?? [];
        $pagination = $apiData['pagination'] ?? null;

        // Kirim data anime dan data pagination ke view 'ongoing'
        return view('ongoing', [
            'animeList' => $animeList,
            'pagination' => $pagination
        ]);
    }
    public function showCompleted(Request $request): View
    {
        // Ambil nomor halaman dari URL (contoh: /completed?page=2)
        $page = $request->query('page', 1);

        // Panggil API dengan parameter halaman
        $response = Http::get("https://bellonime.vercel.app/otakudesu/completed?order=update&page={$page}");
        $apiData = $response->json();

        $animeList = $apiData['data']['animeList'] ?? [];
        $pagination = $apiData['pagination'] ?? null;

        // Kirim data anime dan data pagination ke view 'completed'
        return view('completed', [
            'animeList' => $animeList,
            'pagination' => $pagination
        ]);
    }
    public function showSchedule(): View
    {
        // Panggil API untuk mendapatkan jadwal rilis
        $response = Http::get('https://bellonime.vercel.app/otakudesu/schedule');
        $apiData = $response->json();

        // Ambil list jadwal per harinya
        $scheduleDays = $apiData['data']['days'] ?? [];

        // Kirim data ke view baru bernama 'schedule'
        return view('schedule', ['scheduleDays' => $scheduleDays]);
    }
    public function showAllAnime(): View
    {
        // Panggil API untuk mendapatkan semua anime yang sudah terkelompok
        $response = Http::get('https://bellonime.vercel.app/otakudesu/anime');
        $apiData = $response->json();

        // Ambil list grup abjadnya
        $animeGroups = $apiData['data']['list'] ?? [];

        // Kirim data ke view baru bernama 'anime'
        return view('anime', ['animeGroups' => $animeGroups]);
    }
}