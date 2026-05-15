<?php

namespace App\Livewire;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PlayerStatsWidget extends StatsOverviewWidget
{
    // Określamy szerokość widgetu (np. na całą szerokość lub połowę)
    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.player-stats-widget';

    // Tutaj wrzucasz swoje "testowe dane"
    public function getPlayerData(): array
    {
        return [
            'nickname' => 'Liquidator_99',
            'level' => 42,
            'class' => 'Fullstack Mage',
            'health' => 85,
            'mana' => 120,
            'last_seen' => now()->format('H:i'),
        ];
    }
}
