@props(['player'])

{{-- <div class="border border-gray-900 bg-albion-main p-4 rounded shadow-(--albion-card-shadow) w-full"> --}}
<div class="w-full bg-amber-200/10 border border-orange-950/40 hover:bg-amber-100/50 hover:cursor-pointer">
  <div class="flex text-white p-4">
    <div class="flex items-center">
        <img class="w-12" src="{{asset('images/avatars/albion-avatar-1.png')}}" alt="">
        <p class="ml-2"> {{ $player['Name'] }}</p>
        {{-- <p>Guild: {{ $player['GuildName'] }}</p> --}}
    </div>
    <div class="flex items-end justify-end w-full">
      <p>K/D: {{$player['KillFame']}} / {{$player['DeathFame']}}</p>
    </div>
  </div>
</div>