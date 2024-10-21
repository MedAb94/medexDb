<button
    type="button"
    {{ $attributes->merge(['class' => 'btn btn-icon btn-info btn-sm'])}}
        data-toggle="tooltip"
        data-placement="top"
        title="imprimer"
        onclick="printObject('{{$url??''}}')"
>
    <x-icons.action action="print"></x-icons.action>
</button>
