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
        $anime = Anime::where('slug', $slug)->first();

        if (!$anime) {
            return response()->json(['error' => 'Anime not found'], 404);
        }

        return response()->json($anime);
    }

}