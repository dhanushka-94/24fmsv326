@props(['stage'])

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
