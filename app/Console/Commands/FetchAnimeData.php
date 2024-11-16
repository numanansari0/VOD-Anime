<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Anime;

class FetchAnimeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-anime-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://api.jikan.moe/v4/top/anime');
        if ($response->successful()) {
            $animeList = $response->json()['data'];

            foreach ($animeList as $anime) {
                $slug = \Str::slug($anime['title']);
            
                // Check for duplicate slug
                $existingSlugCount = Anime::where('slug', $slug)->count();
                if ($existingSlugCount > 0) {
                    // Make slug unique by appending mal_id
                    $slug .= '-' . $anime['mal_id'];
                }
            
                Anime::updateOrCreate(
                    ['mal_id' => $anime['mal_id']],
                    [
                        'slug' => $slug,
                        'title' => $anime['title'],
                        'synopsis' => $anime['synopsis'],
                        'image_url' => $anime['images']['jpg']['image_url'],
                    ]
                );
            }
        
            $this->info('Anime data imported successfully.');
        } else {
            $this->error('Failed to fetch anime data.');
        }
    }
}
