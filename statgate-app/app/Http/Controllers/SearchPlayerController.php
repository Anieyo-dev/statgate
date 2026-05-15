<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class SearchPlayerController extends Controller
{
    public function show()
    {
      $nickname = 'anieyoo';
      $cacheKey = "albion_player_{$nickname}";
      $playerData = Cache::get($cacheKey);
      // Ścieżka do pliku (zakładamy storage/app/dane.json)
      $path = storage_path('app/public/assets/morePlayerInfo.json');

      if (!File::exists($path)) {
          abort(404, 'Plik JSON nie istnieje.');
      }

      $data = json_decode(File::get($path), true);



      return view('pages.albion.search-player', [
          'playerFromCache' => $playerData,
          'items' => $data
      ]);
    }

}