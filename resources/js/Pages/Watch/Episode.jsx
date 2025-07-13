// resources/js/Pages/Watch/Episode.jsx
import React, { useState, useEffect } from 'react';
import { Head, Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';

export default function Episode({ episode }) {
    const [currentStreamUrl, setCurrentStreamUrl] = useState(episode.defaultStreamingUrl);
    const [isLoading, setIsLoading] = useState(false);

    // Reset URL setiap kali pindah episode
    useEffect(() => {
        setCurrentStreamUrl(episode.defaultStreamingUrl);
    }, [episode.defaultStreamingUrl]);

    const handleServerChange = async (event) => {
        const serverId = event.target.value;
        if (!serverId) return;

        setIsLoading(true);
        try {
            const response = await fetch(`/api/server/${serverId}`);
            if (!response.ok) throw new Error('Gagal fetch server');
            const data = await response.json();
            if (data.url) {
                setCurrentStreamUrl(data.url);
            }
        } catch (error) {
            console.error("Gagal ganti server:", error);
            alert("Gagal mengambil link dari server ini.");
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <MainLayout>
            <Head title={episode.title} />

            <div className="container mx-auto px-4 py-8">
                <div className="max-w-4xl mx-auto space-y-4">
                    <h1 className="text-2xl md:text-3xl font-bold font-display text-white">
                        {episode.title}
                    </h1>

                    {/* Dropdown Ganti Server */}
                    <select onChange={handleServerChange} className="block w-full p-3 bg-gray-700 border-gray-600 text-white text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500">
                        <option value={episode.defaultStreamingUrl}>Pilih Server Lain...</option>
                        {episode.server.qualities.map(quality => (
                            <optgroup key={quality.title} label={quality.title}>
                                {quality.serverList.map(server => (
                                    <option key={server.serverId} value={server.serverId}>{server.title}</option>
                                ))}
                            </optgroup>
                        ))}
                    </select>

                    {/* Video Player */}
                    <div className={`aspect-video bg-black rounded-lg shadow-lg transition-opacity duration-300 ${isLoading ? 'opacity-50' : 'opacity-100'}`}>
                        <iframe
                            key={currentStreamUrl} // Penting untuk me-remount iframe
                            src={currentStreamUrl}
                            frameBorder="0"
                            allowFullScreen
                            className="w-full h-full rounded-lg"
                        ></iframe>
                    </div>

                    {/* Navigasi Episode */}
                    <div className="flex justify-between items-center gap-4 pt-4">
                        {episode.prevEpisode ? (
                            <Link href={`/watch/${episode.prevEpisode.episodeId}`} className="bg-gray-700 hover:bg-pink-500 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                &laquo; Episode Sebelumnya
                            </Link>
                        ) : <div />}

                        {episode.nextEpisode && (
                            <Link href={`/watch/${episode.nextEpisode.episodeId}`} className="bg-gray-700 hover:bg-pink-500 text-white font-medium py-2 px-4 rounded-lg transition-colors ml-auto">
                                Episode Selanjutnya &raquo;
                            </Link>
                        )}
                    </div>
                </div>
            </div>
        </MainLayout>
    );
}