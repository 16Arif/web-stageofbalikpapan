<?php

namespace App\Http\Controllers;

use App\Models\GempaKalimantan;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GempaController extends Controller
{
    public function index(): View
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

        return view('pages.gempabumi.terkini', compact('latestEarthquake'));
    }

    public function kalimantan(): View
    {
        $listGempa = Cache::remember(GempaKalimantan::CACHE_KEY, 300, function () {
            return GempaKalimantan::query()
                ->active()
                ->latestEvent()
                ->take(5)
                ->get();
        });

        $gempaTerkini = $listGempa->first();

        return view('pages.gempabumi.kalimantan', compact('gempaTerkini', 'listGempa'));
    }

    public function dirasakan(): View
    {
        $listGempaDirasakan = Cache::remember('gempa_dirasakan', 300, function (): array {
            try {
                $response = Http::timeout(5)->get('https://data.bmkg.go.id/DataMKG/TEWS/gempadirasakan.json');

                if (! $response->successful()) {
                    return [];
                }

                $gempaData = data_get($response->json(), 'Infogempa.gempa');

                if (! is_array($gempaData)) {
                    return [];
                }

                return array_map(function ($item): array {
                    $shakemap = null;
                    if (! empty($item['Shakemap'])) {
                        $shakemap = 'https://data.bmkg.go.id/DataMKG/TEWS/'.$item['Shakemap'];
                    } elseif (! empty($item['DateTime'])) {
                        try {
                            $datetimeWib = \Carbon\Carbon::parse($item['DateTime'])->setTimezone('Asia/Jakarta');
                            $shakemap = 'https://data.bmkg.go.id/DataMKG/TEWS/'.$datetimeWib->format('YmdHis').'.mmi.jpg';
                        } catch (\Throwable $e) {
                            $shakemap = null;
                        }
                    }

                    return [
                        'date' => $item['Tanggal'] ?? null,
                        'time' => $item['Jam'] ?? null,
                        'datetime' => $item['DateTime'] ?? null,
                        'coordinates' => $item['Coordinates'] ?? null,
                        'lintang' => $item['Lintang'] ?? null,
                        'bujur' => $item['Bujur'] ?? null,
                        'magnitude' => $item['Magnitude'] ?? null,
                        'depth' => $item['Kedalaman'] ?? null,
                        'region' => $item['Wilayah'] ?? null,
                        'felt' => $item['Dirasakan'] ?? null,
                        'shakemap' => $shakemap,
                    ];
                }, $gempaData);
            } catch (\Throwable $exception) {
                return [];
            }
        });

        $gempaTerkiniDirasakan = $listGempaDirasakan[0] ?? null;

        return view('pages.gempabumi.dirasakan', compact('gempaTerkiniDirasakan', 'listGempaDirasakan'));
    }
}
