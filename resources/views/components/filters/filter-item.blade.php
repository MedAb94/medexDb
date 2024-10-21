<div {{$attributes->merge(['class'=>'mb-5'])}}>
    <label class="form-label fw-semibold">{{$label}}:</label>
    <div>
       {!! $slot !!}
    </div>
</div>
