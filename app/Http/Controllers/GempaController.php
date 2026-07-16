<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GempaController extends Controller
{
    public function index()
    {
        $latestEarthquake = Cache::remember('gempa_terkini', 300, function () {
            try {
                $response = Http::timeout(5)->get('https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json');

                if (! $response->successful()) {
                    return null;
                }

                $earthquake = data_get($response->json(), 'Infogempa.gempa');

                if (! is_array($earthquake)) {
                    return null;
                }

                return [
                    'date' => $earthquake['Tanggal'] ?? null,
                    'time' => $earthquake['Jam'] ?? null,
                    'magnitude' => $earthquake['Magnitude'] ?? null,
                    'depth' => $earthquake['Kedalaman'] ?? null,
                    'region' => $earthquake['Wilayah'] ?? null,
                    'coordinates' => $earthquake['Coordinates'] ?? null,
                    'shakemap' => isset($earthquake['Shakemap'])
                        ? 'https://data.bmkg.go.id/DataMKG/TEWS/'.$earthquake['Shakemap']
                        : null,
                ];
            } catch (\Throwable $exception) {
                return null;
            }
        });

        return view('pages.borneo-earthquakes', compact('latestEarthquake'));
    }
}
