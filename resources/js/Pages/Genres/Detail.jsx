// resources/js/Pages/Genres/Detail.jsx
import React from 'react';
import { Head } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import AnimeCard from '@/Components/AnimeCard';
import Pagination from '@/Components/Pagination';

export default function Detail({ genreTitle, genreId, animeList, pagination }) {
    return (
        <MainLayout>
            <Head title={`Genre: ${genreTitle}`} />
            <div className="container mx-auto px-4 py-8">
                <h1 className="text-4xl font-bold font-display text-white mb-8">
                    Genre: <span className="text-pink-500">{genreTitle}</span>
                </h1>
                <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    {animeList.map((anime) => (
                        <AnimeCard key={anime.animeId} anime={anime} />
                    ))}
                </div>
                <Pagination pagination={pagination} baseUrl={`/genres/${genreId}`} />
            </div>
        </MainLayout>
    );
}