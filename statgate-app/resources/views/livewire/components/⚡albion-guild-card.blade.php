<?php

use Livewire\Component;
use function Livewire\Volt\on;

new class extends Component
{
    public string $name = '1';
    public array $dataL = [];
    public array $debug = [];
    
    protected $listeners = [
        'guild-searched' => 'handle'
    ];

    public function handle($data) {
        $this->dataL = $data['data']['guilds'][0];
        if(isset($data['debug'])){
            $this->debug = $data['debug'];
        }
    }
};
?>

<div>
    @if($dataL && isset($dataL))
        <div class="card-albion-frame flex">
        <h1>Guild: {{$dataL['Name']}}</h1>
        <div class="flex flex-col ml-auto">
            <p>KF/DF: {{$dataL['KillFame']}} / {{$dataL['DeathFame']}}</p>
            {{-- <p>DF : 6000</p> --}}
        </div>
        @if(isset($debug))
            <x-debug.cache-debug :debug="$debug" />
        @endif
    </div>
    @endif
</div>