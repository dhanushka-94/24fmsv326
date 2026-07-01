<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use App\Support\Frames;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageBranding extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Logo & Branding';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.manage-branding';

    protected static ?string $title = 'Logo & Branding';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'logo_white' => $this->uploadableSetting('logo_white'),
            'logo_red' => $this->uploadableSetting('logo_red'),
            'favicon' => $this->uploadableSetting('favicon'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Site logos')
                    ->description('Upload new logos for the public website. PNG with transparent background recommended.')
                    ->schema([
                        Forms\Components\FileUpload::make('logo_white')
                            ->label('White logo')
                            ->image()
                            ->disk('public')
                            ->directory('branding')
                            ->visibility('public')
                            ->imageEditor()
                            ->helperText('Used in the header and loader.'),
                        Forms\Components\FileUpload::make('logo_red')
                            ->label('Red logo')
                            ->image()
                            ->disk('public')
                            ->directory('branding')
                            ->visibility('public')
                            ->imageEditor()
                            ->helperText('Used for accents and animated crossfade.'),
                        Forms\Components\FileUpload::make('favicon')
                            ->label('Favicon')
                            ->image()
                            ->disk('public')
                            ->directory('branding')
                            ->visibility('public')
                            ->helperText('Browser tab icon — red logo works well.'),
                    ])
                    ->columns(1),
                Forms\Components\Section::make('Current preview')
                    ->schema([
                        Forms\Components\Placeholder::make('preview_white')
                            ->label('White logo')
                            ->content(fn (): string => $this->previewLine('logo_white')),
                        Forms\Components\Placeholder::make('preview_red')
                            ->label('Red logo')
                            ->content(fn (): string => $this->previewLine('logo_red')),
                    ])
                    ->columns(2)
                    ->collapsed(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach (['logo_white', 'logo_red', 'favicon'] as $key) {
            $value = $data[$key] ?? null;

            if (is_array($value)) {
                $value = $value[0] ?? null;
            }

            if (filled($value)) {
                SiteSetting::set($key, $value);
            }
        }

        SiteSetting::flushCache();

        Notification::make()
            ->title('Branding saved')
            ->body('Logo changes are live on the website.')
            ->success()
            ->send();
    }

    protected function previewLine(string $key): string
    {
        $path = SiteSetting::get($key, config("frames.{$key}"));
        $url = Frames::mediaUrl($path);

        return $url ? $url : '—';
    }

    private function uploadableSetting(string $key): ?string
    {
        $value = SiteSetting::get($key);

        if (! $value || str_starts_with($value, 'http://') || str_starts_with($value, 'https://') || str_starts_with($value, '/')) {
            return null;
        }

        return $value;
    }
}
