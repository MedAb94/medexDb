<div class="form-group">
    @if(isset($label))
        <label class="@if(isset($isRequired)) required @endif fs-6 fw-semibold mb-2">
            {!! $label !!}
        </label>
    @endif
<input
        {{$attributes->merge(['class'=>'form-control'])}}
        name="{{ $name??null }}"
        value="{{ old($name, $value ?? '') }}"
/>
</div>
