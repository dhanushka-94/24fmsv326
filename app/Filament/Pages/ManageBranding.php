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
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->label('Site logo')
                            ->image()
                            ->disk('public')
                            ->directory('branding')
                            ->visibility('public')
                            ->imageEditor()
                            ->helperText('Recommended: PNG on black background, 1024px wide.'),
                        Forms\Components\FileUpload::make('favicon')
                            ->label('Favicon')
                            ->image()
                            ->disk('public')
                            ->directory('branding')
                            ->visibility('public')
                            ->helperText('Browser tab icon. Defaults to the site logo if not set.'),
                    ])
                    ->columns(1),
                Forms\Components\Section::make('Current preview')
                    ->schema([
                        Forms\Components\Placeholder::make('preview_logo')
                            ->label('Site logo')
                            ->content(fn (): string => $this->previewLine('logo')),
                        Forms\Components\Placeholder::make('preview_favicon')
                            ->label('Favicon')
                            ->content(fn (): string => $this->previewLine('favicon')),
                    ])
                    ->columns(2)
                    ->collapsed(),
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

    private function normalizeUpload(mixed $value): ?string
    {
        if (is_array($value)) {
            $value = $value[0] ?? null;
        }

        return filled($value) ? (string) $value : null;
    }
}
