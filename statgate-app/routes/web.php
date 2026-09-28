<?php

use App\Http\Controllers\PdfGenerationController;
use App\Http\Controllers\SearchPlayerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::get('/w', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::name('guest.')
    ->prefix('albion')
    ->group(function (){

        // Volt::route('/', 'guest-dashboard')->name('dashboard');
        Route::get('/', function () {
            return view('pages.albion.guest-dashboard');
        })->name('dashboard');

        // URL: /search-player | Name: guest.search-player
        Route::get('/search-player', [SearchPlayerController::class, 'show'])
            ->name('search-player');

        Route::get('/guilds', function () {
            return view('pages.albion.guilds');
        })->name('guilds');

        Route::get('/player/{id}', function ($id, Request $request){
            $server = $request->query('server', 'eu');

            return view('pages.albion.player', compact('id', 'server'));
        })->name('player');

        Route::get('/player-pdf/{id}', [PdfGenerationController::class, 'generatePDF'])
            ->name('player.pdf');
});

Route::name('profile.')
    ->middleware(['auth', 'verified'])
    ->prefix('profile')
    ->group(function (){
        Route::get('{user_id}', function (){
            return view('pages.general.user-profile');
        })->name('user');
    });

require __DIR__.'/settings.php';
