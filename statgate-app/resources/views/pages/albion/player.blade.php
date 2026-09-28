<x-filament-panels::layout>
  @php
    $id = request()->route('id');
  @endphp
  @include('partials.albion-breadcrumb', [
    'urls' => [
      '/albion/player/' . $id => 'Selected Player'
    ]
  ])
  <livewire:pages.albion-player :id="$id"/>
</x-filament-panels::layout>