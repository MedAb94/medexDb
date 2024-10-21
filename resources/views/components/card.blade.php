<div {{ $attributes->merge(['class' => 'card']) }}>
    @if($header ?? null)
        <x-card-header > {{ $header }} </x-card-header>
    @endif
    <div class="card-body pt-0">
        {{$slot}}
    </div>
</div>

