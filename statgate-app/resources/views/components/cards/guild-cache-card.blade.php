@props(['guildData'])

<div class="cache-card-frame border flex min-w-64 max-w-64 hover:cursor-pointer hover:bg-gray-500/10 duration-300">
  <div class="flex items-center">
      <img class="w-10" src="{{asset('images/icons/shield-image.png')}}" alt="">
      <p class="ml-2">{{ $guildData['Name'] }}</p>
  </div>
  {{-- <div class="flex flex-col ml-auto">
    <p>KF/DF: 5000/10000</p>
    {{-- <p>Death Fame : 6000</p> --}}
  {{-- </div> --}}
</div>