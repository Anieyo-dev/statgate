{{-- <x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts::app> --}}

<x-filament-panels::layout>
    {{-- @push('head')
        @vite(['resources/css/app.css'])
    @endpush --}}
    <img class="w-full pt-1" src="{{ asset('images/albion-main-2.jpeg') }}" alt="Logo">
    <div class="p-8">
            

        <div class="flex">
            <div class="w-[65%]">
                <livewire:albion-player-search />
                
                {{-- <x-cards.player-card :player="$items" /> --}}
                
                {{-- <h1 class="text-2xl font-bold mb-4 text-red-500">Dane z JSON</h1>
                
                <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-6">
                    <pre>{{ print_r($items, true) }}</pre>
                    {{-- Lub pętla @foreach --}}
                {{-- </div> --}}
            </div>

            <div class="flex flex-col items-center w-[35%]">
                @if($playerFromCache)
                    <h1>Cache</h1>
                    <x-cards.player-card :player="$playerFromCache['players'][0]" />
                @else
                    <div class="p-4 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded">
                        Noone was searched yet
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::layout>