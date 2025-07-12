@props(['pagination', 'baseUrl' => ''])

@if ($pagination && $pagination['totalPages'] > 1)
    <div class="flex justify-center items-center gap-2 mt-8">
        {{-- Tombol Sebelumnya --}}
        @if ($pagination['hasPrevPage'])
            <a href="{{ url($baseUrl) }}?page={{ $pagination['prevPage'] }}" class="flex items-center justify-center w-10 h-10 text-sm font-semibold rounded-md transition-colors duration-200 bg-card text-text-dim hover:bg-pink-500 hover:text-white">
                «
            </a>
        @endif

        {{-- Info Halaman Saat Ini --}}
        <span class="bg-pink-500 text-white flex items-center justify-center w-10 h-10 text-sm font-semibold rounded-md">
            {{ $pagination['currentPage'] }}
        </span>

        {{-- Tombol Berikutnya --}}
        @if ($pagination['hasNextPage'])
            <a href="{{ url($baseUrl) }}?page={{ $pagination['nextPage'] }}" class="flex items-center justify-center w-10 h-10 text-sm font-semibold rounded-md transition-colors duration-200 bg-card text-text-dim hover:bg-pink-500 hover:text-white">
                »
            </a>
        @endif
    </div>
@endif