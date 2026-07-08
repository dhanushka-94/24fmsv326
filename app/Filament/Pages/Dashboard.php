<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $title = 'Dashboard';

    public function getHeading(): string
    {
        return 'Welcome back';
    }

    public function getSubheading(): ?string
    {
        $name = auth()->user()?->name;

        return $name
            ? "Hi {$name} — manage site content, review messages, and update branding from here."
            : 'Manage site content, review messages, and update branding from here.';
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\ContentOverviewStats::class,
            \App\Filament\Widgets\RecentContactSubmissions::class,
            \App\Filament\Widgets\QuickActions::class,
        ];
    }

    public function getColumns(): int|string|array
    {
        return 1;
    }
}
