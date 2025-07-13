// resources/js/Pages/Anime/Detail.jsx
import React from 'react';
import { Head, Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout'; // Panggil layout utama kita

export default function Detail({ anime }) { // Menerima props 'anime' dari controller
    return (
        <MainLayout>
            <Head title={anime.title} />

            <div className="container mx-auto px-4 py-8">
                <div className="flex flex-col md:flex-row gap-8 lg:gap-12">
                    {/* Kolom Kiri: Poster */}
                    <div className="w-full md:w-1/3 lg:w-1/4 flex-shrink-0">
                        <img 
                            src={anime.poster} 
                            alt={anime.title} 
                            className="w-full h-auto object-cover rounded-xl shadow-lg"
                        />
                    </div>

                    {/* Kolom Kanan: Detail Info */}
                    <div className="w-full md:w-2/3 lg:w-3/4 space-y-6">
                        <h1 className="text-3xl md:text-4xl lg:text-5xl font-bold font-display text-white">
                            {anime.title}
                        </h1>

                        <div className="flex flex-wrap gap-2">
                            {anime.genreList.map((genre) => (
                                <span key={genre.genreId} className="bg-gray-700 text-gray-200 text-xs font-semibold px-3 py-1.5 rounded-full">
                                    {genre.title}
                                </span>
                            ))}
                        </div>

                        <div>
                            <h2 className="text-2xl font-semibold border-b-2 border-gray-700 pb-2 mb-4">Sinopsis</h2>
                            <p className="text-gray-300 leading-relaxed whitespace-pre-wrap">
                                {anime.synopsis.paragraphs.join("\n\n")}
                            </p>
                        </div>

                        <div>
                            <h2 className="text-2xl font-semibold border-b-2 border-gray-700 pb-2 mb-4">Daftar Episode</h2>
                            <div className="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-2.5 mt-4">
                                {anime.episodeList.map((episode) => (
                                    <Link 
                                        href={`/watch/${episode.episodeId}`} 
                                        key={episode.episodeId}
                                        className="bg-gray-800 text-gray-200 font-medium border-2 border-gray-700 hover:border-pink-500 hover:bg-pink-500 hover:text-white transition-colors duration-200 text-center p-2.5 rounded-lg text-sm"
                                    >
                                        {episode.title}
                                    </Link>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </MainLayout>
    );
}