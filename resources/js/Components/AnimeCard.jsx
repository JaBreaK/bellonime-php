// resources/js/Components/AnimeCard.jsx
import { Link } from '@inertiajs/react';

export default function AnimeCard({ anime }) {
  if (!anime || !anime.animeId) return null;

  return (
    // Kita tidak lagi pakai motion.div, tapi tag Link langsung
    <Link href={`/anime/${anime.animeId}`} className="block group">
      <div className="relative aspect-[2/3] w-full bg-gray-800 rounded-lg overflow-hidden shadow-lg">
        <img 
          src={anime.poster} 
          alt={anime.title} 
          className="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
        />
      </div>
      <div className="p-2">
        <h3 className="font-semibold text-sm text-gray-200 truncate group-hover:text-pink-500 transition-colors">
          {anime.title}
        </h3>
      </div>
    </Link>
  );
}