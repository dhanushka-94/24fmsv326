<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    protected static string $layout = 'filament.layouts.auth';

    protected static string $view = 'filament.pages.auth.login';

    public function hasLogo(): bool
    {
        return false;
    }

    public function getHeading(): string | Htmlable
    {
        return 'Sign in';
    }

    public function getSubheading(): string | Htmlable | null
    {
        return '24 Frames content management';
    }

    /**
     * @return array<string, string>
     */
    public function getExtraBodyAttributes(): array
    {
        return [
            'class' => 'frames-auth-body',
        ];
    }

    protected function getEmailFormComponent(): Component
    {
        return parent::getEmailFormComponent()
            ->placeholder('admin@24frames.lk');
    }

    protected function getPasswordFormComponent(): Component
    {
        return parent::getPasswordFormComponent()
            ->placeholder('••••••••');
    }
}
