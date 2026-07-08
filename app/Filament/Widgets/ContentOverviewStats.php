<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ClientResource;
use App\Filament\Resources\ContactSubmissionResource;
use App\Filament\Resources\DirectorResource;
use App\Filament\Resources\PortfolioItemResource;
use App\Filament\Resources\TeamMemberResource;
use App\Models\Client;
use App\Models\ContactSubmission;
use App\Models\Director;
use App\Models\PortfolioItem;
use App\Models\TeamMember;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentOverviewStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $unread = ContactSubmission::query()->whereNull('read_at')->count();

        return [
            Stat::make('Clients', Client::query()->count())
                ->description(Client::query()->where('is_published', true)->count().' published on site')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('primary')
                ->url(ClientResource::getUrl()),
            Stat::make('Portfolio', PortfolioItem::query()->count())
                ->description(PortfolioItem::query()->where('is_published', true)->count().' live items')
                ->descriptionIcon('heroicon-m-film')
                ->color('primary')
                ->url(PortfolioItemResource::getUrl()),
            Stat::make('Team', TeamMember::query()->count())
                ->description(TeamMember::query()->where('is_published', true)->count().' visible members')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary')
                ->url(TeamMemberResource::getUrl()),
            Stat::make('Inbox', $unread > 0 ? $unread.' unread' : 'All caught up')
                ->description(ContactSubmission::query()->count().' total messages')
                ->descriptionIcon($unread > 0 ? 'heroicon-m-envelope' : 'heroicon-m-check-circle')
                ->color('primary')
                ->url(ContactSubmissionResource::getUrl()),
            Stat::make('Directors', Director::query()->count())
                ->description(Director::query()->where('is_published', true)->count().' on About page')
                ->descriptionIcon('heroicon-m-camera')
                ->color('primary')
                ->url(DirectorResource::getUrl()),
        ];
    }
}
