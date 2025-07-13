// resources/js/Pages/Anime/List.jsx
import React from 'react';
import { Head, Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';

export default function List({ animeGroups }) {
    return (
        <MainLayout>
            <Head title="Daftar Semua Anime" />
            <div className="container mx-auto px-4 py-8">
                <h1 className="text-4xl font-bold font-display text-white mb-8">Daftar Semua Anime</h1>

                <div className="space-y-8">
                    {animeGroups.map((group) => (
                        <section key={group.startWith} id={group.startWith}>
                            <h2 className="text-3xl font-bold text-pink-500 border-b-2 border-gray-700 pb-2 mb-4">
                                {group.startWith}
                            </h2>
                            <ul className="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-x-6">
                                {group.animeList.map((anime) => (
                                    <li key={anime.animeId} className="mb-2">
                                        <Link href={`/anime/${anime.animeId}`} className="text-gray-300 hover:text-pink-500 transition-colors text-sm">
                                            {anime.title}
                                        </Link>
                                    </li>
                                ))}
                            </ul>
                        </section>
                    ))}
                </div>
            </div>
        </MainLayout>
    );
}