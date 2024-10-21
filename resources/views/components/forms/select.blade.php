<div class="form-group">
    @if(isset($label))
        <label class="@if(isset($isRequired)) required @endif fs-6 fw-semibold mb-2">
            @if(isset($icon))
                <span class="{{ $icon }}"></span>
            @endif
            {!! $label !!}
        </label>
    @endif
    <select
        data-allow-clear="true"
        {{--data-width="100%"
        data-live-search="true"--}}
        {{--        data-control="select2"--}}

        {{-- @if(!isset($attributes['data-dropdown-parent']))
             data-dropdown-parent="#main-modal"
         @endif--}}
        {{$attributes->merge(['class' => 'form-select form-control select_pk'])}}
        name="{{$name??''}}" data-placeholder="{!! $placeholder??'Selectionez' !!}">
        <option></option>
        {{$slot}}
    </select>
</div>
