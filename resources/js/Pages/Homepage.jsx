// resources/js/Pages/Homepage.jsx
import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AnimeCard from '@/Components/AnimeCard'; // Pastikan path import ini benar
import MainLayout from '@/Layouts/MainLayout'; // Import layout utama

// Komponen untuk header section
function SectionHeader({ title, href }) {
    return (
        <div className="flex justify-between items-center mb-6">
            <h2 className="text-2xl font-bold font-display text-white">
                {title}
            </h2>
            <Link href={href} className="text-sm text-gray-400 hover:text-pink-500 transition-colors">
                Lihat Semua &raquo;
            </Link>
        </div>
    )
}

export default function Homepage({ ongoingAnime, completedAnime }) {
    return (
        <MainLayout>
            <Head title="Homepage" />

            <div className="container mx-auto px-4 py-8 space-y-12">
                {/* Section Rilisan Terbaru */}
                {ongoingAnime && ongoingAnime.length > 0 && (
                    <section>
                        <SectionHeader title="Rilisan Terbaru 🔥" href="/ongoing" />
                        {/* Ganti Carousel dengan Grid Biasa */}
                        <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                            {/* Tampilkan hanya 6 judul pertama */}
                            {ongoingAnime.slice(0, 20).map((anime) => (
                                <AnimeCard key={anime.animeId} anime={anime} />
                            ))}
                        </div>
                    </section>
                )}

                {/* Section Anime Tamat */}
                {completedAnime && completedAnime.length > 0 && (
                    <section>
                        <SectionHeader title="Anime Tamat" href="/completed" />
                        {/* Ganti Carousel dengan Grid Biasa */}
                        <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                            {/* Tampilkan hanya 12 judul pertama */}
                            {completedAnime.slice(0, 20).map((anime) => (
                                <AnimeCard key={anime.animeId} anime={anime} />
                            ))}
                        </div>
                    </section>
                )}
            </div>
        </MainLayout>
    );
}