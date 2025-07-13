// resources/js/Components/Pagination.jsx
import { Link } from '@inertiajs/react';

export default function Pagination({ pagination, baseUrl }) {
  if (!pagination || pagination.totalPages <= 1) {
    return null;
  }

  return (
    <div className="flex justify-center items-center gap-2 mt-8">
      {pagination.hasPrevPage && (
        <Link 
          href={`${baseUrl}?page=${pagination.prevPage}`} 
          className="flex items-center justify-center w-10 h-10 text-sm font-semibold rounded-md transition-colors duration-200 bg-card text-text-dim hover:bg-pink-500 hover:text-white"
        >
          &laquo;
        </Link>
      )}
      <span className="bg-pink-500 text-white flex items-center justify-center w-10 h-10 text-sm font-semibold rounded-md">
        {pagination.currentPage}
      </span>
      {pagination.hasNextPage && (
        <Link 
          href={`${baseUrl}?page=${pagination.nextPage}`} 
          className="flex items-center justify-center w-10 h-10 text-sm font-semibold rounded-md transition-colors duration-200 bg-card text-text-dim hover:bg-pink-500 hover:text-white"
        >
          &raquo;
        </Link>
      )}
    </div>
  );
}