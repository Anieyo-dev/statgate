@props(['player'])

<div class="card-albion-frame border border-gray-900 bg-albion-main p-4 rounded shadow-(--albion-card-shadow) w-full">
    {{-- <div class="bg-black/60 backdrop-blur-sm border border-orange-950/40 rounded-xl"> --}}
    <div class="flex">
        <div>
            <p>Player: {{ $player['Name'] }}</p>
            <p>Guild: {{ $player['GuildName'] }}</p></div>
        <div>
            <p>K/D: {{$player['KillFame']}} / {{$player['DeathFame']}}</p>
        </div>
    </div>
</div>