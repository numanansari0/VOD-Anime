<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

class AnimeUIController extends Controller
{
    public function index()
    {
        $animeList = Anime::all();
        return view('anime.index', compact('animeList'));
    }
}
