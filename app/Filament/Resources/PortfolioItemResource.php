<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioItemResource\Pages;
use App\Models\PortfolioItem;
use App\Support\Frames;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortfolioItemResource extends Resource
{
    protected static ?string $model = PortfolioItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Portfolio';

    protected static ?string $modelLabel = 'portfolio item';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required()->maxLength(255),
                Forms\Components\TextInput::make('category')->maxLength(255),
                Forms\Components\Textarea::make('description')->rows(3)->columnSpanFull(),
                Forms\Components\TextInput::make('thumbnail_url')
                    ->label('Thumbnail URL')
                    ->url()
                    ->maxLength(2048),
                Forms\Components\FileUpload::make('thumbnail_upload')
                    ->label('Upload thumbnail')
                    ->image()
                    ->disk('public')
                    ->directory('portfolio')
                    ->visibility('public')
                    ->imageEditor()
                    ->dehydrated(false)
                    ->afterStateUpdated(function ($state, Forms\Set $set): void {
                        if (filled($state)) {
                            $path = is_array($state) ? ($state[0] ?? null) : $state;
                            $set('thumbnail_url', $path);
                        }
                    }),
                Forms\Components\TextInput::make('youtube_url')->url()->required()->label('YouTube URL'),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0)->required(),
                Forms\Components\Toggle::make('is_published')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail_url')
                    ->label('Thumb')
                    ->getStateUsing(fn (PortfolioItem $record): ?string => Frames::mediaUrl($record->thumbnail_url))
                    ->square(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\IconColumn::make('is_published')->boolean(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolioItems::route('/'),
            'create' => Pages\CreatePortfolioItem::route('/create'),
            'edit' => Pages\EditPortfolioItem::route('/{record}/edit'),
        ];
    }
}
