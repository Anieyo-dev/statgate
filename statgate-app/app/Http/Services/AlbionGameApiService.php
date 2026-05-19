<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

/**
 * Class AlbionGameApiService
 * * Handles communication with the official Albion Online Game API.
 * Provides abstraction for regional endpoints and implements caching via Redis.
 */
class AlbionGameApiService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.albion_api.eu.url');
    }

    /**
     * Resolves the correct API Base URL based on the selected region.
     * @param string $server The region code ('eu', 'na', or 'asia')
     * @return string The resolved API endpoint URL
     * @throws \InvalidArgumentException If the provided server region is unsupported
     */
    public function getUrlByServer(string $server)
    {
        return match ($server) {
            'eu'   => config('services.albion_api.eu.url'),
            'na'   => config('services.albion_api.na.url'),
            'asia' => config('services.albion_api.asia.url'),

        default => throw new \InvalidArgumentException("Server is not avaible: {$server}"),
    };

    }

    /**
     * Fetches query with automated caching.
     * @param string $queryType Searched element - guild / player
     * @param string $nickname The in-game player name
     * @param string $server The region to query
     * @return array An associative array containing 'data' and 'debug' information
     */
    public function getSearchedElement(string $queryType,string $nickname, string $server, bool $debug = false)
    {
        if($nickname){
            $nickname = strtolower($nickname);
        }
        $cacheKey = "albion_{$queryType}_{$server}_{$nickname}";
        $this->baseUrl = $this->getUrlByServer($server);
        $source = 'cache'; // Domyślnie zakładamy cache

        // 1. Próbujemy pobrać z Cache
        $data = Cache::get($cacheKey);

        // 2. Jeśli nie ma w Cache, uderzamy do API
        if ($data === null) {
            $source = 'api'; // Zmieniamy flagę na api
            
            $response = Http::get("{$this->baseUrl}search?q={$nickname}");
            
            if ($response->successful()) {
                $data = $response->json();
                
                // Zapisujemy do cache na godzinę (3600s) tylko jeśli sukces
                Cache::put($cacheKey, $data, 7200);

                $index = Cache::get('albion_'. $queryType .'_last_searched', []);

                $index[] = $cacheKey;

                $index = array_values(array_unique($index));
                $index = array_slice($index, -50);

                Cache::put('albion_'. $queryType .'_last_searched', $index, 7200);
            }
        }

        if($debug){
            return [
                'data' => $data,
                'debug' => [
                    'source' => $source, // Tu masz informację: 'cache' lub 'api'
                    'cache_key' => $cacheKey,
                    'status' => $data ? 'Success' : 'Not Found/Error',
                ]
            ];
        } else {
            return [
                'data' => $data,
            ];
        }
    }
}