<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\ManageBranding;
use App\Filament\Resources\ClientResource;
use App\Filament\Resources\PortfolioItemResource;
use App\Filament\Resources\TeamMemberResource;
use Filament\Widgets\Widget;

class QuickActions extends Widget
{
    protected static string $view = 'filament.widgets.quick-actions';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    /**
     * @return array<int, array{label: string, description: string, url: string, icon: string}>
     */
    public function getActions(): array
    {
        return [
            [
                'label' => 'Add client logo',
                'description' => 'Upload a brand for the homepage carousel.',
                'url' => ClientResource::getUrl('create'),
                'icon' => 'heroicon-o-building-office-2',
            ],
            [
                'label' => 'Add portfolio item',
                'description' => 'Publish a new film or commercial reel.',
                'url' => PortfolioItemResource::getUrl('create'),
                'icon' => 'heroicon-o-film',
            ],
            [
                'label' => 'Add team member',
                'description' => 'Update the team page with a new profile.',
                'url' => TeamMemberResource::getUrl('create'),
                'icon' => 'heroicon-o-user-plus',
            ],
            [
                'label' => 'Update branding',
                'description' => 'Change the site logo and favicon.',
                'url' => ManageBranding::getUrl(),
                'icon' => 'heroicon-o-photo',
            ],
        ];
    }
}
