<?php
namespace App\Http\Controllers;

use App\Traits\InteractsWithRedisCache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class SearchPlayerController extends Controller
{
    use InteractsWithRedisCache;

    // public function getPlayersCache($limit){
        
    //     return $this->getLatestCacheByPrefix(config('cache.albion_player_prefix'), 5)
    // }

    public function show()
    {
        $lastSearched = config('cache.albion.prefix.players.last_searched');
        $playersFromCache = $this->getLatestCacheByPrefix($lastSearched, 5);

        // Ścieżka do pliku (zakładamy storage/app/dane.json)
        // $path = storage_path('app/public/assets/morePlayerInfo.json');

        // if (!File::exists($path)) {
        //     abort(404, 'Plik JSON nie istnieje.');
        // }

        // $data = json_decode(File::get($path), true);

        return view('pages.albion.search-player', [
            'playersFromCache' => $playersFromCache,
        ]);
    }

}