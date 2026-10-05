<?php

namespace App\Filament\Widgets;

use App\Models\Laptop;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Stok Laptop Ready', Laptop::where('status', 'available')->count())
                ->description('Unit siap dijual')
                ->color('success')
                ->icon('heroicon-o-computer-desktop'),
        ];
    }
}