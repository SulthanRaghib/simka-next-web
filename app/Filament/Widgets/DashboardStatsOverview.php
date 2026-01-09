<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\Widget;

class DashboardStatsOverview extends Widget
{
    protected static ?int $sort = 1;

    // Use a custom view instead of the default StatsOverview view
    protected string $view = 'filament.widgets.dashboard-stats-overview';

    protected int|string|array $columnSpan = 'full';
}
