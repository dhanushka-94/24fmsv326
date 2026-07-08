<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContactSubmissionResource;
use App\Models\ContactSubmission;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentContactSubmissions extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Recent messages';

    protected static ?string $description = 'Latest contact form submissions from the website.';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactSubmission::query()->latest()->limit(5),
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->weight('semibold')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->copyable()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('message')
                    ->limit(40)
                    ->color('gray'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->since()
                    ->sortable(),
                Tables\Columns\TextColumn::make('read_at')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Read' : 'New')
                    ->color(fn ($state) => $state ? 'success' : 'warning'),
            ])
            ->paginated(false)
            ->emptyStateHeading('No messages yet')
            ->emptyStateDescription('Contact form submissions will appear here.')
            ->emptyStateIcon('heroicon-o-inbox')
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Open')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->url(fn (ContactSubmission $record): string => ContactSubmissionResource::getUrl('view', ['record' => $record])),
            ]);
    }
}
