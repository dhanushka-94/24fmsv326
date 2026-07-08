<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Our Team';

    protected static ?string $modelLabel = 'team member';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\TextInput::make('role')->required()->maxLength(255),
                Forms\Components\TextInput::make('department')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('e.g. production')
                    ->helperText('Use direction, production, or post so members appear in the correct team section.'),
                Forms\Components\Textarea::make('bio')->rows(3)->columnSpanFull(),
                Forms\Components\FileUpload::make('photo')
                    ->label('Photo')
                    ->image()
                    ->disk('public')
                    ->directory('team')
                    ->visibility('public')
                    ->imageEditor()
                    ->maxSize(4096)
                    ->helperText('Upload a portrait photo. Use department keys: direction, production, or post.')
                    ->formatStateUsing(fn (?string $state): ?string => TeamMember::isStoredUpload($state) ? $state : null),
                Forms\Components\TextInput::make('imdb')->url()->label('IMDb URL')->maxLength(255),
                Forms\Components\TextInput::make('instagram')->url()->maxLength(255),
                Forms\Components\TextInput::make('linkedin')->url()->maxLength(255),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0)->required(),
                Forms\Components\Toggle::make('is_published')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Photo')
                    ->disk('public')
                    ->visibility('public')
                    ->getStateUsing(fn (TeamMember $record): ?string => TeamMember::isStoredUpload($record->photo) ? $record->photo : null)
                    ->defaultImageUrl(fn (TeamMember $record): ?string => $record->photoUrl())
                    ->circular(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('role')->searchable(),
                Tables\Columns\TextColumn::make('department')->badge(),
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
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
