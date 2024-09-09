<div class="form-check form-check-custom form-check-solid">
    <input
            {{$attributes->merge(['class'=>'form-check-input'])}}
            type="radio"
            id="{{$id}}"
            name="{{ $name??null }}"
            value="{{isset($name)?old($name, $value ?? ''):null }}"
    />
    @if(isset($label))
        <label class="form-check-label" for="${{$id}}">
            {!! $label !!}
        </label>
    @endif
</div>
