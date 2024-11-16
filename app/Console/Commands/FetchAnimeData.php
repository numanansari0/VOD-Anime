<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Anime;
use Illuminate\Support\Str;

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
    protected $description = 'Fetch top anime data from Jikan API and store it in the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = 'https://api.jikan.moe/v4/top/anime';
        $this->info('Fetching data from Jikan API...');

        try {
            $response = Http::retry(5, 1000) // Retry up to 5 times with 1-second delay
                ->get($url);

            if ($response->successful()) {
                $animeList = $response->json()['data'];

                foreach ($animeList as $anime) {
                    $slug = Str::slug($anime['title']);
                    
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
                            'synopsis' => $anime['synopsis'] ?? 'No synopsis available.',
                            'image_url' => $anime['images']['jpg']['image_url'] ?? null,
                        ]
                    );
                }

                $this->info('Anime data imported successfully.');
            } else {
                // Handle unexpected response status codes
                $this->error('Failed to fetch data. API responded with: ' . $response->status());
            }
        } catch (\Exception $e) {
            // Catch network errors or JSON parsing errors
            $this->error('An error occurred while fetching data: ' . $e->getMessage());
        }
    }
}
