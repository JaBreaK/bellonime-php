@extends('layouts.app')

@section('title', $episode['title'] . ' - Nonton di Bellonime')

@section('content')
    <div class="my-8">
        <div class="max-w-4xl mx-auto space-y-4">

            <h1 class="text-3xl font-bold font-display text-white">
                {{ $episode['title'] }}
            </h1>

            <select id="server-select" class="block w-full p-3 bg-gray-700 border-gray-600 text-white text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500">
                <option value="{{ $episode['defaultStreamingUrl'] }}" selected>Pilih Server Lain...</option>
                @foreach ($episode['server']['qualities'] as $quality)
                    @if (!empty($quality['serverList']))
                        <optgroup label="{{ $quality['title'] }}">
                            @foreach ($quality['serverList'] as $server)
                                <option value="{{ $server['serverId'] }}">{{ $server['title'] }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                @endforeach
            </select>

            <div class="aspect-video bg-black rounded-lg shadow-lg">
                <iframe 
                    id="video-player" {{-- Kita kasih ID biar bisa ditarget oleh JavaScript --}}
                    src="{{ $episode['defaultStreamingUrl'] }}" 
                    frameborder="0" 
                    allowfullscreen 
                    class="w-full h-full rounded-lg"
                ></iframe>
            </div>

            </div>
    </div>

    {{-- SCRIPT UNTUK GANTI SERVER --}}
<script>
    // Ambil elemen select dan iframe
    const serverSelect = document.getElementById('server-select');
    const videoPlayer = document.getElementById('video-player');

    // MATA-MATA #1: Pastikan elemennya ketemu
    console.log('Player & Selector siap:', { serverSelect, videoPlayer });

    // Tambahkan event listener
    serverSelect.addEventListener('change', async (event) => {
        const selectedValue = event.target.value;

        // MATA-MATA #2: Lihat nilai yang dipilih
        console.log('Server diganti, nilainya:', selectedValue);

        videoPlayer.style.opacity = '0.5';

        if (selectedValue.startsWith('http')) {
            videoPlayer.src = selectedValue;
            videoPlayer.style.opacity = '1';
            return;
        }
        
        try {
            const response = await fetch(`/api/server/${selectedValue}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            });

            if (!response.ok) {
                throw new Error(`Server merespon dengan error: ${response.status}`);
            }

            const data = await response.json();

            // MATA-MATA #3: Lihat data yang diterima dari API
            console.log('Data dari API:', data);

            if (data.url) {
                // MATA-MATA #4: Konfirmasi sebelum ganti URL
                console.log('Mengganti URL iframe menjadi:', data.url);
                videoPlayer.src = data.url;
            } else {
                console.error('Data URL tidak ditemukan di dalam respons API.');
                alert('Format data URL dari server salah.');
            }
        } catch (error) {
            console.error('Gagal ganti server:', error);
            alert('Gagal mengambil link video dari server ini.');
        } finally {
            videoPlayer.style.opacity = '1';
        }
    });
</script>
@endsection