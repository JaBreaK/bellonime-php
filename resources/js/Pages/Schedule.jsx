// resources/js/Pages/Schedule.jsx
import React from 'react';
import { Head, Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';

export default function Schedule({ scheduleDays }) {
  return (
    <MainLayout>
      <Head title="Jadwal Rilis Anime" />
      <div className="container mx-auto px-4 py-8">
        <h1 className="text-4xl font-bold font-display text-white mb-8">Jadwal Rilis Mingguan</h1>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {/* Lakukan perulangan untuk setiap HARI */}
          {scheduleDays.map((day) => (
            <div key={day.day} className="bg-gray-800/50 border border-gray-700 rounded-lg shadow-lg">
              <div className="p-4 border-b border-gray-700">
                <h2 className="text-2xl font-bold text-pink-500">{day.day}</h2>
              </div>

              <ul className="p-4 space-y-3">
                {/* Lakukan perulangan untuk setiap ANIME di hari itu */}
                {day.animeList.map((anime) => (
                  <li key={anime.animeId}>
                    <Link href={`/anime/${anime.animeId}`} className="text-gray-300 hover:text-pink-500 transition-colors">
                      {anime.title}
                    </Link>
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </div>
      </div>
    </MainLayout>
  );
}