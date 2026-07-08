<x-filament-panels::page>
    <form wire:submit="save" class="frames-branding-page space-y-6">
        {{ $this->form }}

        <div class="frames-form-actions">
            <x-filament::button type="submit" size="lg" icon="heroicon-m-check">
                Save branding
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
