<?php
namespace App\Http\Controllers;

use App\Http\Services\AlbionGameApiService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfGenerationController extends Controller
{
  public function generatePDF(Request $request, AlbionGameApiService $service, $id)
  {
    $server = $request->query('server');

    if($id && $server){
      $cache = $service->getPlayerById($id, $server);
      $pdf = Pdf::loadView('pdf.player', [
        'player' => $cache,
      ]);

      // return $pdf->download('player.pdf');
      return $pdf->stream('player.pdf');
    } else {
      return view('pdf.pdf-not-found');
    }
  }
}