<?php

use Livewire\Component;
use function Livewire\Volt\on;

new class extends Component
{
    public string $name = '1';
    public array $dataL = [];
    //
    // W Volcie eventy rejestruje się w tablicy $listeners
    protected $listeners = [
        'player-searched' => 'handle'
    ];

    public function handle($data) {
        $this->dataL = $data['data']['guilds'][0];
    }
};
?>

<div>
    @if($dataL && isset($dataL))
        <div class="card-albion-frame flex">
        <h1>Guild: {{$dataL['Name']}}</h1>
        <div class="flex flex-col ml-auto">
            <p>Kill Fame : 0</p>
            <p>Death Fame : 6000</p>
        </div>
    </div>
    @endif
</div>