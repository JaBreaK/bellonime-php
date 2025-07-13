// resources/js/Pages/Ongoing.jsx
import React from 'react';
import { Head } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import AnimeCard from '@/Components/AnimeCard';
import Pagination from '@/Components/Pagination';

export default function Ongoing({ animeList, pagination }) {
  return (
    <MainLayout>
      <Head title="Anime Ongoing" />
      <div className="container mx-auto px-4 py-8">
        <h1 className="text-4xl font-bold font-display text-white mb-8">Anime Sedang Tayang</h1>
        <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
          {animeList.map((anime) => (
            <AnimeCard key={anime.animeId} anime={anime} />
          ))}
        </div>
        <Pagination pagination={pagination} baseUrl="/ongoing" />
      </div>
    </MainLayout>
  );
}