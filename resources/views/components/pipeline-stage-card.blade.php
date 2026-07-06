@props(['stage', 'variant' => 'default'])

@if ($variant === 'flow')
    <div class="pipeline-flow-card-inner">
        <h3 class="pipeline-flow-title">{{ $stage['title'] }}</h3>
        <ul class="pipeline-flow-list">
            @foreach ($stage['items'] as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
@elseif ($variant === 'compact')
    <ul class="pipeline-flow-list pipeline-flow-list--compact">
        @foreach ($stage['items'] as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
@else
    <div class="pipeline-card h-full">
        <div class="pipeline-card-head">
            <span class="pipeline-card-stage">{{ $stage['stage'] }}</span>
            <h3 class="pipeline-card-title">{{ $stage['title'] }}</h3>
        </div>
        <ul class="pipeline-card-list">
            @foreach ($stage['items'] as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
@endif
