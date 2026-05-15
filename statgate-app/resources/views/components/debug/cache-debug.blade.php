@props(['debug'])

{{-- Sekcja Debug --}}
<div class="mt-4 p-4 bg-gray-900 text-green-400 rounded-lg shadow-inner font-mono text-xs">
    <div class="flex items-center mb-2 border-b border-gray-700 pb-1">
        <span class="mr-2">🚀</span>
        <h3 class="font-bold uppercase">Redis & Cache Debug</h3>
    </div>
    
    <div class="grid grid-cols-2 gap-2">
        <div>Source: <span class="text-white">{{ $debug['source'] }}</span></div>
        <div>Key: <span class="text-yellow-500">{{ $debug['cache_key'] }}</span></div>
        <div>Status: <span class="text-yellow-500">{{ $debug['status'] }}</span></div>
    </div>

    @if(isset($player['debug']['redis_full_prefix']))
        <div class="mt-2 text-gray-500">
            Prefix: {{ $player['debug']['redis_full_prefix'] }}
        </div>
    @endif
</div>