@props(['player'])

<div class="card-albion-frame border border-gray-900 p-4 rounded shadow-(--albion-card-shadow) w-full hover:translate-x-3 duration-200 hover:cursor-pointer">
    {{-- <div class="bg-black/60 backdrop-blur-sm border border-orange-950/40 rounded-xl"> --}}
    <div class="flex w-full">
        <div class="flex flex-col">
            <div class="flex items-center">
                <img class="w-12" src="{{asset('images/avatars/albion-avatar-1.png')}}" alt="">
                <p class="ml-2"> {{ $player['Name'] }}</p>
            </div>
            <div class="flex items-center">
                <img class="w-12" src="{{asset('images/icons/shield-image.png')}}" alt="">
                <p>{{ $player['GuildName'] }}</p>
            </div>
        </div>
        <div class="flex items-end ml-auto">
            <p>K/D: {{$player['KillFame']}} / {{$player['DeathFame']}}</p>
        </div>
    </div>
</div>