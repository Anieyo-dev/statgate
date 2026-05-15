<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\AlbionGameApiService;

class AlbionProxyController extends Controller
{
    public function __construct(
        protected AlbionGameApiService $albionService
    ) {}

    public function getPlayer(string $id)
    {
        $data = $this->albionService->getTempData($id);

        if (!$data) {
            return response()->json(['error' => 'Player not found or API error'], 404);
        }

        return response()->json($data);
    }
}