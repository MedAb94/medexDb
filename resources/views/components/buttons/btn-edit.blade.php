<button type="button"
    {{ $attributes->merge(['class' => 'btn btn-sm btn-primary'])}}
>
    <span class="indicator-label">
        <x-icons.action action="save"/>
        {{$slot}}
    </span>
    <span class="indicator-progress">
        <span class="spinner-border spinner-border-sm align-middle ms-2">
        </span>
    </span>
</button>
