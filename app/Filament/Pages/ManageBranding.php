<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
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
            'logo' => $this->uploadableSetting('logo'),
            'favicon' => $this->uploadableSetting('favicon'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Site logo')
                    ->description('Upload the master 24 Frames logo used across the website and admin panel.')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->label('Site logo')
                            ->image()
                            ->disk('public')
                            ->directory('branding')
                            ->visibility('public')
                            ->imageEditor()
                            ->helperText('Recommended: PNG on black background, 1024px wide.'),
                        Forms\Components\ViewField::make('preview_logo')
                            ->label('Current logo')
                            ->view('filament.forms.branding-preview')
                            ->viewData(['key' => 'logo', 'label' => 'Site logo', 'variant' => 'logo']),
                    ])
                    ->columns(1),
                Forms\Components\Section::make('Favicon')
                    ->description('Small icon shown in browser tabs and bookmarks.')
                    ->icon('heroicon-o-globe-alt')
                    ->schema([
                        Forms\Components\FileUpload::make('favicon')
                            ->label('Favicon')
                            ->image()
                            ->disk('public')
                            ->directory('branding')
                            ->visibility('public')
                            ->helperText('Square PNG works best. Defaults to the site logo if not set.'),
                        Forms\Components\ViewField::make('preview_favicon')
                            ->label('Current favicon')
                            ->view('filament.forms.branding-preview')
                            ->viewData(['key' => 'favicon', 'label' => 'Favicon', 'variant' => 'favicon']),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $logo = $this->normalizeUpload($data['logo'] ?? null);
        $favicon = $this->normalizeUpload($data['favicon'] ?? null);

        if (filled($logo)) {
            foreach (['logo', 'logo_white', 'logo_red'] as $key) {
                SiteSetting::set($key, $logo);
            }
        }

        if (filled($favicon)) {
            SiteSetting::set('favicon', $favicon);
        }

        SiteSetting::flushCache();

        Notification::make()
            ->title('Branding saved')
            ->body('Logo changes are live on the website.')
            ->success()
            ->send();
    }

    private function uploadableSetting(string $key): ?string
    {
        $value = SiteSetting::get($key);

        if (! $value || str_starts_with($value, 'http://') || str_starts_with($value, 'https://') || str_starts_with($value, '/')) {
            return null;
        }

        return $value;
    }

    private function normalizeUpload(mixed $value): ?string
    {
        if (is_array($value)) {
            $value = $value[0] ?? null;
        }

        return filled($value) ? (string) $value : null;
    }
}
