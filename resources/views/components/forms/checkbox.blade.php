

<div class="form-check">
    <input
            {{$attributes->merge(['class'=>'form-check-input'])}}
            type="checkbox"
            id="{{$id}}"
            name="{{ $name??null }}"
            value="{{isset($name)?old($name, $value ?? ''):null }}"
    />
    @if(isset($label))
        <label class="form-check-label text-dark" for="${{$id}}">
            {!! $label !!}
        </label>
    @endif
</div>

