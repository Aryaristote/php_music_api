<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    // Search request
    public function fetchExternalData(Request $request) {
        try {
            $request->validate([
                'keyword' => 'required|string',
            ]);

            $keyword = $request->input('keyword');

            // Make HTTPS GET request to Last.fm API for track search
            $trackResponse = Http::get("https://ws.audioscrobbler.com/2.0/", [
                'method' => 'track.search',
                'track' => $keyword,
                'api_key' => 'd95feab4173d2c15be4db62bb6835004',
                'format' => 'json',
            ]);

            // Make HTTPS GET request to Last.fm API for artist search
            $artistResponse = Http::get("https://ws.audioscrobbler.com/2.0/", [
                'method' => 'artist.search',
                'artist' => $keyword,
                'api_key' => 'd95feab4173d2c15be4db62bb6835004',
                'format' => 'json',
            ]);

            // Check if the requests were successful (status code 2xx)
            if ($trackResponse->successful() && $artistResponse->successful()) {
                $trackData = $trackResponse->json();
                $artistData = $artistResponse->json();

                // Return both track and artist data
                return response()->json([
                    'trackData' => $trackData,
                    'artistData' => $artistData,
                ]);
            } else {
                return response()->json(['error' => 'Failed to fetch data from external API'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Retrieve favorite songs from the 'music' table
    public function getFavorites(Request $request)
    {
        $favorites = Music::all();
        return response()->json($favorites, 200);
    }

    // Validate request data if necessary
    public function addToFavorites(Request $request) {

        $music = new Music();
        $music->name = $request->input('name');
        // Assign other fields as necessary
        $music->save();

        return response()->json(['message' => 'Item added to favorites'], 200);
    }

    // Validate request data if necessary
    public function removeFromFavorites(Request $request) {

        Music::where('name', $request->input('name'))->delete();

        return response()->json(['message' => 'Item removed from favorites'], 200);
    }
}
