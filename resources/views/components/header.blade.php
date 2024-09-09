<div {{ $attributes->merge(['class' => 'row my-4']) }}>
    @if(isset($title))
        <div class="col-sm-6">
            <h2 class="header">{{ $title }}</h2>
        </div>
    @endif
    <div class="{{ isset($title) ? 'col-sm-6' : 'col-12' }}">
        <div class="d-flex justify-content-end">
            {{ $slot }}
        </div>
    </div>
</div>
