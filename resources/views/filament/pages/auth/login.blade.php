<div class="frames-auth-card">
  <div class="frames-auth-brand">
    <a href="{{ route('home') }}" class="frames-auth-logo-link" aria-label="24 Frames — back to site">
      <x-site-logo size="lg" class="mx-auto" />
    </a>

    <p class="frames-auth-label">Admin</p>
    <h1 class="frames-auth-title">{{ $this->getHeading() }}</h1>
    @if ($subheading = $this->getSubheading())
      <p class="frames-auth-subtitle">{{ $subheading }}</p>
    @endif
  </div>

  {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}

  <x-filament-panels::form id="form" wire:submit="authenticate" class="frames-auth-form">
    {{ $this->form }}

    <x-filament-panels::form.actions
      :actions="$this->getCachedFormActions()"
      :full-width="$this->hasFullWidthFormActions()"
    />
  </x-filament-panels::form>

  {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}
</div>
