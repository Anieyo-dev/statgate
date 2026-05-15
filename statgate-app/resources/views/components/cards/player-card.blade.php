@props(['player'])

<div class="border bg-albion-main p-4 rounded shadow">
    <p>Player: {{ $player['Name'] }}</p>
    <p>Guild: {{ $player['GuildName'] }}</p>
</div>