<?php

use Livewire\Component;
use App\Http\Services\AlbionGameApiService;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\InteractsWithRedisCache;
use function Livewire\Volt\{mount, state};

new class extends Component
{
    public string $playerId = '';
    public string $server = 'eu'; // default EU
    public string $serverLang = '';
    public ?array $playerData = null;
    public ?array $coreStats = [];

    public array $tabs = [
        'pve' => 'PvE',
        'gathering' => 'Gathering',
        'crafting' => 'Crafting',
    ];

    public function getCoreStats()
    {
        if(isset($this->playerData))
        {
            $pd = $this->playerData['data']['response'];
            $totalFame = $pd['LifetimeStatistics']['PvE']['Total'] + 
                        $pd['LifetimeStatistics']['Gathering']['All']['Total'] + 
                        $pd['LifetimeStatistics']['Crafting']['Total'];
            $this->coreStats = [
                'Total Fame' => [
                    'value' => $totalFame,
                    'icon' => 'images/elements/core-icons/allfame.png'
                ],
                'Kill Fame' => [
                    'value' => $pd['KillFame'],
                    'icon' => 'images/elements/core-icons/kfame.png'
                ],
                'Death Fame' => [
                    'value' => $pd['DeathFame'],
                    'icon' => 'images/elements/core-icons/deathfame.png'
                ],
                'K/D Ratio' => [
                    'value' => $pd['FameRatio'],
                    'icon' => 'images/elements/core-icons/kd-ratio.png'
                ]
            ];
        }
    }

    public function getPveItemUrl(string $pveType)
    {
        return match ($pveType) {
            'Total'             => 'images/elements/pve-icons/earth.png',
            'Royal'             => 'images/elements/pve-icons/crown.png',
            'Outlands'          => 'images/elements/pve-icons/sword.png',
            'Avalon'            => 'images/elements/pve-icons/avalon.png',
            'Hellgate'          => 'images/elements/pve-icons/hellgate.png',
            'CorruptedDungeon'  => 'images/elements/pve-icons/corrupted-dungeon.png',
            'Mists'             => 'images/elements/pve-icons/mists.png',


        default => "",
        };
    }

    public function getGatheringItemUrl(string $gatherType)
    {
        return match ($gatherType) {
            'Fiber'  => 'https://render.albiononline.com/v1/item/T2_WOOD',
            'Hide'   => 'https://render.albiononline.com/v1/item/T2_HIDE',
            'Ore'    => 'https://render.albiononline.com/v1/item/T2_ORE',
            'Rock'   => 'https://render.albiononline.com/v1/item/T2_ROCK',
            'Wood'   => 'https://render.albiononline.com/v1/item/T2_WOOD',

        default => "",
        };
    }

    public function getServerName(string $server)
    {
        return match($server) {
            'eu' => 'Europe',
            'asia' => 'Asia',
            'america' => 'America',

        default => '',
        };
    }

    public function getCraftingItemUrl(string $craftType)
    {
        return match ($craftType) {
            'Total' => 'images/elements/pve-icons/earth.png',
            'Royal' => 'images/elements/pve-icons/crown.png',
            'Outlands' => 'images/elements/pve-icons/sword.png',
            'Avalon' => 'images/elements/pve-icons/avalon.png',

        default => "",
        };
    }

    public function getPlayerDetails(AlbionGameApiService $service)
    {
        $this->playerData = $service->getPlayerById($this->playerId, 'eu');
        $this->server = $this->playerData['data']['server'];
        $this->serverLang = $this->getServerName($this->server);

    }

    public function generatePDF()
    {
        return redirect()->route('guest.player.pdf', ['id' => $this->playerData['data']['response']['Id'], 'server' => $this->server]);
    }

    public function mount($id, AlbionGameApiService $service)
    {
        $this->playerId = $id;
        if($this->playerId)
        {
            $this->getPlayerDetails($service);
            $this->getCoreStats();
        }
    }
};
?>

<div class="text-white mt-4">
    <div class="flex flex-col">
        @if (isset($playerData['data']))
            <div class="flex flex-col cache-card-frame max-w-64 self-center">
                <h1 class=" font-bold text-5xl">{{$playerData['data']['response']['Name']}}</h1>
                <p class="text-(--font-albion-secondary) font-bold text-xl">{{$playerData['data']['response']['GuildName']}} </p>
            </div>
            
            <div class="cache-card-frame-bg  mt-2 ">
                <div x-data="{ activeTab: 'pve' }" class="bg-amber-100/70">
                    <x-filament::tabs contained>
                        <div class="flex flex-col-reverse sm:flex-row md:justify-between w-full">
                            <div class="flex justify-center sm:justify-left">
                                @foreach($tabs as $key => $label)
                                <x-filament::tabs.item
                                    alpine-active="activeTab === '{{ $key }}'"
                                    x-on:click="activeTab = '{{ $key }}'"
                                    
                                >
                                    {{ $label }}
                                </x-filament::tabs.item>
                                @endforeach
                            </div>
                            {{-- <p class="my-auto mr-4 text-2xl text-black font-bold">{{ $serverLang }}</p> --}}
                            <div class="mx-auto py-3 mb-2 sm:mb-0 sm:mx-0 sm:ml-auto flex items-center gap-1.5 px-3  bg-amber-950/40 border border-orange-500/50 rounded-md text-xs font-semibold text-orange-400 shadow-sm">
                                <svg class="w-3.5 h-3.5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                </svg>
                                <span class="uppercase tracking-wider">Europe</span>
                            </div>
                        </div>
                        <img class="rotate-180" src="{{ asset('images/elements/border-alone.png') }}" alt="">
                    </x-filament::tabs>
                    <div class="flex flex-col md:flex-row">
                        <div class="mt-4 p-6 rounded-xl md:w-1/2">
                        
                        <!-- Section: PvE -->
                        <div x-show="activeTab === 'pve'" x-transition class="flex flex-col items-center">
                            @php
                                $pveStats = $playerData['data']['response']['LifetimeStatistics']['PvE'];
                                arsort($pveStats);
                            @endphp
                            <h3 class="text-lg font-bold text-gray-900 mb-4 text-center border-b-2 border-red-500/50 w-1/3">PvE Fame</h3>
                            <div class="flex flex-wrap gap-y-3 justify-center">
                                @foreach ($pveStats as $pveDesc => $pveItem)
                                @php
                                    $pveUrl = asset( $this->getPveItemUrl($pveDesc) );
                                @endphp
                                <div class="first:w-full first:flex first:justify-center not-first:w-1/2 sm:not-first:w-1/3 md:not-first:w-1/2 lg:not-first:w-1/3 group text-center">
                                    <div class="border mx-2 group-first:w-1/2 lg:group-first:w-1/3 border-red-500/50 rounded-lg shadow-[0_0_9px_0_rgba(255,21,0,0.25)]  flex flex-col items-center" data-tooltip-target="tooltip-{{ $pveDesc }}">
                                        <img class="img-fluid loading w-8 mt-1" src="{{ $pveUrl }}">
                                        {{-- <span>{{ $pveDesc }}</span> --}}
                                        <span class="text-2xl font-bold text-amber-600 text-shadow-2xs mt-2">
                                            {{ number_format($pveItem ?? 0) }}
                                        </span>
                                        <div data-tooltip="tooltip-{{$pveDesc}}"
                                            class="absolute z-50 whitespace-normal break-words bg-(--albion-card-title-bg) rounded-lg py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">
                                            {{ $pveDesc }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Section: Gathering -->
                        <div x-show="activeTab === 'gathering'" x-transition class="flex flex-col items-center">
                            @php
                                $gathStats = $playerData['data']['response']['LifetimeStatistics']['Gathering'];
                            @endphp
                            <h3 class="text-lg font-bold text-gray-900 mb-4 text-center border-b-2 border-red-500/50 w-1/3">Gathering Fame</h3>
                            <div>
                                <div class=" my-2   ">
                                    <div class="flex justify-center items-center">
                                        {{-- <span class="mr-2">Total</span> --}}
                                        <span class="text-2xl font-bold text-amber-600 text-shadow-2xs ">
                                            {{ number_format($gathStats['All']['Total'] ?? 0) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-y-3 justify-center">
                                @foreach ($gathStats as $gathDesc => $gathItem)
                                    @if ($gathDesc !== 'All')
                                        <div class="w-1/2 sm:w-1/3 text-center">
                                            <div class="border mx-2 border-gray-400/50 rounded-lg shadow-lg flex flex-col">
                                                @php
                                                    $url = $this->getGatheringItemUrl($gathDesc);
                                                @endphp
                                                <img class="img-fluid loading" src="{{ $url }}">
                                                {{-- <span>{{ $gathDesc }}</span> --}}
                                                <div class="flex flex-col">
                                                    {{-- <span>Total</span> --}}
                                                    <span class="text-2xl font-bold text-amber-600 text-shadow-2xs mt-2">
                                                        {{ number_format($gathItem['Total'] ?? 0) }}
                                                    </span>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Section: Crafting -->
                        <div x-show="activeTab === 'crafting'" x-transition class="flex flex-col items-center">
                            @php
                                $craftStats = $playerData['data']['response']['LifetimeStatistics']['Crafting'];
                            @endphp
                            <h3 class="text-lg font-bold text-gray-900 mb-4 text-center border-b-2 border-red-500/50 w-2/3">Crafting Fame</h3>
                            <div class="">
                                <div class=" my-2   ">
                                    <div class="flex justify-center items-center">
                                        {{-- <span class="mr-2">Total</span> --}}
                                        <span class="text-2xl font-bold text-amber-600 text-shadow-2xs ">
                                            {{ number_format($craftStats['Total'] ?? 0) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-y-3 justify-center w-full">
                                @foreach ($craftStats as $craftDesc => $craftItem)
                                    @if ($craftDesc !== 'Total')
                                        <div class="w-1/3  text-center">
                                            <div class="border mx-2 border-gray-400/50 rounded-lg shadow-lg flex flex-col">
                                                @php
                                                    // $url = $this->getCraftingItemUrl($craftDesc);
                                                    $url = asset( $this->getCraftingItemUrl($craftDesc) );
                                                @endphp
                                                {{-- <img class="img-fluid loading" src="{{ $url }}"> --}}
                                                <img class="img-fluid loading w-8 mt-1 mx-auto" src="{{ $url }}">
                                                {{-- <span>{{ $gathDesc }}</span> --}}
                                                <div class="flex flex-col">
                                                    {{-- <span>Total</span> --}}
                                                    <span class="text-2xl font-bold text-amber-600 text-shadow-2xs mt-2">
                                                        {{ number_format($craftItem['Total'] ?? 0) }}
                                                    </span>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        

                        </div>
                        <div class="mt-4 p-6 flex flex-col items-center rounded-xl md:w-1/2">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 text-center border-b-2 border-red-500/50 w-1/3">Core Fame</h3>
                            <div class="flex flex-wrap gap-y-3 justify-center w-full">
                                @foreach ($coreStats as $pveDesc => $pveItem)
                                @php
                                    $pveUrl = asset( $pveItem['icon'] );
                                @endphp
                                <div class="first:w-full first:flex first:justify-center not-first:w-1/3 group text-center">
                                    <div class="border mx-2 group-first:w-1/3 border-red-500/50 rounded-lg shadow-[0_0_9px_0_rgba(255,21,0,0.25)]  flex flex-col items-center" data-tooltip-target="tooltip-{{ $pveDesc }}">
                                        <img class="img-fluid loading w-8 mt-1" src="{{ $pveUrl }}">
                                        {{-- <span>{{ $pveDesc }}</span> --}}
                                        <span class="text-2xl font-bold text-amber-600 text-shadow-2xs mt-2">
                                            {{ number_format($pveItem['value'] ?? 0) }}
                                        </span>
                                        <div data-tooltip="tooltip-{{$pveDesc}}"
                                            class="absolute z-50 whitespace-normal break-words bg-(--albion-card-title-bg) rounded-lg py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">
                                            {{ $pveDesc }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex justify-center md:justify-end">
                        <button
                        wire:click='generatePDF'
                        class="albion-btn albion-btn-main w-auto mb-2 mr-2 text-center ">
                        Check your PDF file
                        </button>
                    </div>
                </div>

                {{-- <div>
                    Here will be more stats / last active
                </div>

                <div>
                    Here will be last deaths and kills (permament - black strefes)
                </div>

                <div>
                    Wezmiemy topkę, i spróbujemy wyliczyć jakieś % ile brakuje do topki, może bedzie bez sensu to jeszcze pomyślimy
                </div> --}}
                
            </div>
        @endif

        
    
    </div>
    {{-- {{dd($playerData['data'])}} --}}
    @if(isset($playerData['debug']))
        <x-debug.cache-debug :debug="$playerData['debug']"/>
    @endif
</div>