@props(['player'])

{{-- <div class="border border-gray-900 bg-albion-main p-4 rounded shadow-(--albion-card-shadow) w-full"> --}}
<a href="{{ route('guest.player', $player['Id']) }}">
  <div class="w-full border border-gray-700/80 hover:translate-x-[5%] duration-300 hover:cursor-pointer my-2 rounded-xl">
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
</a>