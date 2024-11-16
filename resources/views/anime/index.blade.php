<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Top Anime') }}
        </h2>
    </x-slot>

    <!-- Container -->
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Section Title -->
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Discover Top Anime</h2>

        <!-- Anime Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($animeList as $anime)
                <!-- Card -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden hover:scale-105 hover:shadow-lg transition-transform duration-200 min-h-[24rem]">
                    <!-- Image -->
                    <img src="{{ $anime->image_url }}" alt="{{ $anime->title }}" class="w-full h-56 object-cover rounded-t-lg">
                    
                    <!-- Card Body -->
                    <div class="p-4 flex flex-col h-56">
                        <!-- Title -->
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $anime->title }}</h3>
                        
                        <!-- Synopsis -->
                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit($anime->synopsis, 100) }}
                        </p>
                
                        <!-- Button -->
                        <a href="{{ url('/api/anime/' . $anime->slug) }}" 
                           class="mt-auto inline-block text-center bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors duration-200">
                            Watch Now
                        </a>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>
</x-app-layout>
