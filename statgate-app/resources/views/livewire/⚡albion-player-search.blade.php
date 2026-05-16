<?php

// use Livewire\Volt\Component;
use Livewire\Component;
use App\Http\Services\AlbionGameApiService;
use App\Traits\InteractsWithRedisCache;
use function Livewire\Volt\{mount, state};

new class extends Component {
    use InteractsWithRedisCache;

    public string $playerId = '';
    public string $selectedServer = 'eu';
    public ?array $player = null;
    public bool $notFound = false;
    public $playersFromCache;

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
        $this->playersFromCache = $this->getCache();
    }

    public function getCache()
    {
        $lastSearched = config('cache.albion.prefix.players.last_searched');
        return $this->getLatestCacheByPrefix($lastSearched, 5);
    }

    public function mount() {
        
        $this->playersFromCache = $this->getCache();
    }
};
?>

<div class="py-10 px-8 bg-albion-main  w-full flex ">
    <div class="w-[25%] card-albion-frame border rounded-lg duration-200 border-amber-300/20 hover:border-amber-300 shadow-(--albion-card-shadow)">
        <div class="pt-2 pl-2 bg-(--albion-card-title-bg) rounded-t-lg border-b border-amber-300/40 text-gray-300 font-bold text-2xl pb-2">Search player</div>
        <div class="flex flex-col gap-2 px-4 py-6 items-center">
            <input 
                type="text" 
                wire:model="playerId" 
                wire:keydown.enter="searchWithCache"
                placeholder="Player name..." 
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

        <div class="flex flex-col items-center h-64 overflow-y-auto">
            <div class="w-full pt-2 pl-2 bg-(--albion-card-title-bg) rounded-t-lg border-b border-amber-300/40 text-gray-300 font-bold text-2xl pb-2">
                Last Searched
            </div>
            @if(isset($playersFromCache))
                @foreach($playersFromCache as $player)
                    @if ($player != null)
                        <x-cards.player-cache-card :player="$player['players'][0]" />
                    @endif
                @endforeach
            @else
                <div class="p-4 border bg-amber-950/40 border-amber-900/60 text-amber-300 rounded">
                    Noone was searched yet
                </div>
            @endif
        </div>
    </div>

    <div class="w-full pl-12 text-gray-300 ">
        <span class="text-3xl font-bold">FIND ANY PLAYER ANYWHERE</span>
        <div class="min-h-32">
            @if($player && isset($player['data']['players'][0]))
                <div class="mt-4">
                    <x-cards.player-card :player="$player['data']['players'][0]" />
                </div>
        
                @if(isset($player['debug']))
                    <x-debug.cache-debug :debug="$player['debug']" />
                @endif
            @else
                <span class="text-gray-300/90">Here you will see main properties of your character</span>
            @endif
        </div>
        @if($notFound)
        <div class="mt-4 text-red-500 text-sm">
            Nie znaleziono takiego hultaja w Albionie.
        </div>
        @endif

        
    </div>
</div>