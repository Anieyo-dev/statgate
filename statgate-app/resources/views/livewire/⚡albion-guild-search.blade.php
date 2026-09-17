<?php

use Livewire\Component;
use App\Http\Services\AlbionGameApiService;
use App\Traits\InteractsWithRedisCache;
use function Livewire\Volt\{mount, state};

new class extends Component
{
    use InteractsWithRedisCache;

    public string $guildName = '';
    public string $selectedServer = 'eu';
    public ?array $seGuild = null;
    public bool $notFound = false;
    public $guildsFromCache;

    public function searchWithCache(AlbionGameApiService $service)
    {
        $this->notFound = false;
        $this->seGuild = null;

        if(empty($this->guildName)) return;
        if(empty($this->selectedServer)) return;

        $data = $service->getSearchedElement('guild',$this->guildName, $this->selectedServer, true);

        if($data) {
            $this->guildFromRequest = $data;
        } else {
            $this->notFound = true;
        }
        $this->guildsFromCache = $this->getCache();
        $this->dispatch('guild-searched', data: $data);
    }

    public function getCache()
    {
        $lastSearched = config('cache.albion.prefix.guilds.last_searched');
        return $this->getLatestCacheByPrefix($lastSearched, 5);
    }

    public function mount() {
        
        $this->guildsFromCache = $this->getCache();
    }
};
?>

<div class="text-white">
    <div class="cache-card-frame shadow-2xl border rounded-lg duration-200 border-amber-300/20 hover:border-amber-300 shadow-(--albion-card-shadow)">
        <div class="pt-2 pl-2 bg-(--albion-card-title-bg) rounded-t-lg border-b border-amber-300/40 text-gray-300 font-bold text-2xl pb-2">Search guild</div>
        <div class="flex flex-col gap-2 px-4 py-6 items-center">
            <input 
                type="text" 
                wire:model="guildName" 
                wire:keydown.enter="searchWithCache"
                placeholder="Guild name..." 
                class="flex-1 rounded-md bg-(--albion-card-title-bg) border-1 py-1 px-2 border-zinc-800 focus:outline-1 focus:outline-amber-300 focus:outline-offset-2 dark:bg-zinc-900 text-gray-300"
            >

            <div class="flex items-center space-x-4 pt-2">
                <div class="inline-flex p-1 bg-[#1c231a] border border-amber-300/20 rounded-xl shadow-inner">
                    
                    <label class="relative group">
                        <input type="radio" name="server" value="eu" class="peer sr-only" checked wire:model.live="selectedServer">
                        <div class="px-6 py-2 rounded-lg text-sm font-bold uppercase tracking-wider cursor-pointer 
                                    text-gray-500 transition-all duration-200
                                    peer-checked:bg-[#2d3a2b] peer-checked:text-amber-400 peer-checked:shadow-sm
                                    group-hover:text-gray-300">
                            EU
                        </div>
                    </label>

                    <label class="relative group">
                        <input type="radio" name="server" value="na" class="peer sr-only" wire:model.live="selectedServer">
                        <div class="px-6 py-2 rounded-lg text-sm font-bold uppercase tracking-wider cursor-pointer 
                                    text-gray-500 transition-all duration-200
                                    peer-checked:bg-[#2d3a2b] peer-checked:text-amber-400 peer-checked:shadow-sm
                                    group-hover:text-gray-300">
                            NA
                        </div>
                    </label>

                    <label class="relative group">
                        <input type="radio" name="server" value="asia" class="peer sr-only" wire:model.live="selectedServer">
                        <div class="px-6 py-2 rounded-lg text-sm font-bold uppercase tracking-wider cursor-pointer 
                                    text-gray-500 transition-all duration-200
                                    peer-checked:bg-[#2d3a2b] peer-checked:text-amber-400 peer-checked:shadow-sm
                                    group-hover:text-gray-300">
                            Asia
                        </div>
                    </label>

                </div>
            </div>

            <div wire:loading class="mt-4 text-sm text-zinc-500">
                Łączenie z serwerem AMS...
            </div>

            <button wire:click="searchWithCache" class="mt-4 albion-btn albion-btn-main">
                Szukaj
            </button>
        </div>
        @if ($guildsFromCache)
            <div class="flex justify-center items-center flex-col">
                <div class="pt-2 pl-2 max-w-128 mb-4 bg-(--albion-card-title-bg) rounded-t-lg border-b border-amber-300/40 text-gray-300 font-bold text-2xl pb-2">Last Searched</div>
                @foreach ($guildsFromCache as $guildC)
                    @php
                        $guildData = $guildC['guilds'][0] ?? null;
                    @endphp
                    @if($guildData)
                        <x-cards.guild-cache-card :guildData="$guildData" />
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>