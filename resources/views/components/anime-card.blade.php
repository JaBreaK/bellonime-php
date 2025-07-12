{{-- Kita akan gunakan variabel $anime yang sudah dikirim dari "otak"-nya --}}
<a href="{{ url('/anime/' . $anime['animeId']) }}" class="block group">
    <div class="relative aspect-[2/3] w-full bg-gray-800 rounded-lg overflow-hidden shadow-lg">
        <img 
            src="{{ $anime['poster'] }}" 
            alt="{{ $anime['title'] }}" 
            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
        >
    </div>
    <div class="p-2">
        <h3 class="font-semibold text-sm text-gray-200 truncate group-hover:text-pink-500 transition-colors">
            {{ $anime['title'] }}
        </h3>
    </div>
</a>