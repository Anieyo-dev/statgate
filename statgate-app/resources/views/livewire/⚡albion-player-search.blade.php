<?php

use Livewire\Component;
use App\Http\Services\AlbionGameApiService;

new class extends Component {
    public string $playerId = '';
    public string $selectedServer = 'eu';
    public ?array $player = null;
    public bool $notFound = false;

    public function searchWithCache(AlbionGameApiService $service)
    {
        $this->notFound = false;
        $this->player = null;

        if(empty($this->playerId)) return;
        if(empty($this->selectedServer)) return;

        $data = $service->getPlayerStats($this->playerId, $this->selectedServer, true);

        if($data) {
            $this->player = $data;
        } else {
            $this->notFound = true;
        }
    }
};
?>

<div class="p-4 border bg-albion-main dark:border-zinc-800 rounded-xl absolute top-100">
    <div class="flex flex-col gap-2 pt-2 pb-2">
        <input 
            type="text" 
            wire:model="playerId" 
            wire:keydown.enter="search"
            placeholder="Player name..." 
            class="flex-1 rounded-lg border-1 py-1 px-2 border-zinc-800 focus:border-zinc-600 dark:bg-zinc-900 text-white"
        >

        <label for="server" class="block text-sm font-medium text-gray-400 mb-1">Select server</label>
        
        <div class="flex items-center space-x-4">
            <div class="inline-flex p-1 bg-[#1c231a] border border-[#2d3a2b] rounded-xl shadow-inner">
                
                <label class="relative group">
                    <input type="radio" name="server" value="eu" class="peer sr-only" checked wire:model.live="selectedServer">
                    <div class="px-6 py-2 rounded-lg text-sm font-bold uppercase tracking-wider cursor-pointer 
                                text-gray-500 transition-all duration-200
                                peer-checked:bg-[#2d3a2b] peer-checked:text-green-400 peer-checked:shadow-sm
                                group-hover:text-gray-300">
                        EU
                    </div>
                </label>

                <label class="relative group">
                    <input type="radio" name="server" value="na" class="peer sr-only" wire:model.live="selectedServer">
                    <div class="px-6 py-2 rounded-lg text-sm font-bold uppercase tracking-wider cursor-pointer 
                                text-gray-500 transition-all duration-200
                                peer-checked:bg-[#2d3a2b] peer-checked:text-green-400 peer-checked:shadow-sm
                                group-hover:text-gray-300">
                        NA
                    </div>
                </label>

                <label class="relative group">
                    <input type="radio" name="server" value="asia" class="peer sr-only" wire:model.live="selectedServer">
                    <div class="px-6 py-2 rounded-lg text-sm font-bold uppercase tracking-wider cursor-pointer 
                                text-gray-500 transition-all duration-200
                                peer-checked:bg-[#2d3a2b] peer-checked:text-green-400 peer-checked:shadow-sm
                                group-hover:text-gray-300">
                        Asia
                    </div>
                </label>

            </div>
        </div>

        <button wire:click="searchWithCache" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
            Szukaj
        </button>
    </div>

    <div wire:loading class="mt-4 text-sm text-zinc-500">
        Łączenie z serwerem AMS...
    </div>

@if($player && isset($player['data']['players'][0]))
        <div class="mt-6">
             <x-cards.player-card :player="$player['data']['players'][0]" />
        </div>
    
    @if(isset($player['debug']))
        <x-debug.cache-debug :debug="$player['debug']" />
    @endif

@endif
@if($notFound)
        <div class="mt-4 text-red-500 text-sm">
            Nie znaleziono takiego hultaja w Albionie.
        </div>
    @endif
</div>