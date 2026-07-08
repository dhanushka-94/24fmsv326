<x-filament-widgets::widget>
    <x-filament::section
        heading="Quick actions"
        description="Jump straight to common tasks."
        icon="heroicon-o-bolt"
    >
        <div class="frames-quick-actions">
            @foreach ($this->getActions() as $action)
                <a href="{{ $action['url'] }}" class="frames-quick-action">
                    <span class="frames-quick-action-icon" aria-hidden="true">
                        <x-filament::icon :icon="$action['icon']" class="h-5 w-5" />
                    </span>
                    <span class="frames-quick-action-copy">
                        <span class="frames-quick-action-label">{{ $action['label'] }}</span>
                        <span class="frames-quick-action-desc">{{ $action['description'] }}</span>
                    </span>
                    <x-filament::icon icon="heroicon-m-chevron-right" class="frames-quick-action-chevron h-4 w-4" />
                </a>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
