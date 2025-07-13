// resources/js/Pages/Genres/Index.jsx
import React from 'react';
import { Head, Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';

export default function Index({ genreList }) {
    return (
        <MainLayout>
            <Head title="Daftar Genre" />
            <div className="container mx-auto px-4 py-8">
                <h1 className="text-4xl font-bold font-display text-white mb-8">Daftar Genre</h1>
                <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    {genreList.map((genre) => (
                        <Link
                            href={`/genres/${genre.genreId}`}
                            key={genre.genreId}
                            className="block text-center bg-gray-800 hover:bg-pink-500 hover:text-white font-semibold p-4 rounded-lg transition-colors shadow-lg"
                        >
                            {genre.title}
                        </Link>
                    ))}
                </div>
            </div>
        </MainLayout>
    );
}