<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimeRequest;
use App\Http\Requests\UpdateAnimeRequest;
use App\Models\Anime;

class AnimeController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // Attempt to find the anime by slug
        $anime = Anime::where('slug', $slug)->first();

        // If the anime is not found, return a 404 error
        if (!$anime) {
            return response()->json([
                'error' => 'Anime not found',
            ], 404);
        }

        // If found, return the anime details
        return response()->json([
            'title' => $anime->title,
            'synopsis' => $anime->synopsis,
            'image_url' => $anime->image_url,
            'slug' => $anime->slug,
            'mal_id' => $anime->mal_id,
        ], 200);
    }

}