<x-filament-panels::layout>
    <div class="flex justify-center relative ">
        <img class="pt-1" src="{{ asset('images/albion-main-2-crop.jpeg') }}" alt="Logo">
        <p class="absolute inset-x-0 top-8 flex justify-center text-6xl text-amber-400 text-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">Search Player</p>
        <div class="absolute inset-x-0 top-24 flex justify-center">
            @include('partials.albion-breadcrumb-abs', [
                'urls' => [
                '/albion/search-player' => 'Search Player'
                ]
            ])
        </div>
    </div>
    <div class="border-t-4 border-amber-400">
        <div class="flex">
            <div class="w-full">
                <livewire:albion-player-search />
                {{-- <x-cards.player-card :player="$items" /> --}}
                
                {{-- <h1 class="text-2xl font-bold mb-4 text-red-500">Dane z JSON</h1>
                
                <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-6">
                    <pre>{{ print_r($items, true) }}</pre>
                    {{-- Lub pętla @foreach --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>
</x-filament-panels::layout>