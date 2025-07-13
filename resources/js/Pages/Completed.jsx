// resources/js/Pages/Completed.jsx
import React from 'react';
import { Head } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import AnimeCard from '@/Components/AnimeCard';
import Pagination from '@/Components/Pagination';

export default function Completed({ animeList, pagination }) {
  return (
    <MainLayout>
      <Head title="Anime Completed" />
      <div className="container mx-auto px-4 py-8">
        <h1 className="text-4xl font-bold font-display text-white mb-8">Anime Tamat</h1>
        <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
          {animeList.map((anime) => (
            <AnimeCard key={anime.animeId} anime={anime} />
          ))}
        </div>
        <Pagination pagination={pagination} baseUrl="/completed" />
      </div>
    </MainLayout>
  );
}