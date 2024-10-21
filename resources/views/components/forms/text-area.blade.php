<div class="form-group mt-2">
    @if(isset($label))
        <label class="@if(isset($isRequired)) required @endif fs-6 fw-semibold mb-2">
            {!! $label !!}
        </label>
    @endif
    <textarea name="{{ $name??null }}" {{$attributes->merge(['class'=>'form-control'])}}>{!! old($name, $value ?? '') !!}</textarea>
</div>
